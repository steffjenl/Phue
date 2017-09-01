<?php

namespace Phue\Console\Commands;

use Illuminate\Console\Command;

class CreateUser extends Command
{
    protected $signature = 'phue:create-user {ipaddress?}';

    protected $description = 'Authentication / Creating a User
                               {ipaddress : The IP address from the Hue Bridge}';

    public function handle()
    {
        // get ip address from config file
        $ipadress = config('phue.ip');


        $arguments = $this->arguments();

        if (!empty($arguments['ipaddress'])) {
            $ipadress = config('phue.ip');
        }

        if (empty($ipadress)) {
            $this->error('No IP address found!');
            exit;
        }

        $client = new \Phue\Client($ipadress);

        $this->info("Testing connection to bridge at {$client->getHost()}");

        try {
            $client->sendCommand(
                new \Phue\Command\Ping
            );
        } catch (\Phue\Transport\Exception\ConnectionException $e) {
            $this->error("Issue connecting to bridge");
            exit(1);
        }

        $this->info("Attempting to create user:");
        $this->info("Press the Bridge's button!");
        $this->info("Waiting.");

        // Try X times to create user
        $maxTries = 30;
        for ($i = 1; $i <= $maxTries; ++$i) {
            try {
                $response = $client->sendCommand(
                    new \Phue\Command\CreateUser
                );

                $this->info("\n\nSuccessfully created new user: {$response->username}");
                break;
            } catch (\Phue\Transport\Exception\LinkButtonException $e) {
                $this->warning(" . ");
            } catch (Exception $e) {
                $this->error("\n\nFailure to create user . Please try again!\nReason: {$e->getMessage()} \n\n");
                break;
            }
            sleep(1);
        }
    }
}
