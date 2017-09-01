<?php

namespace Phue\Console\Commands;

use Illuminate\Console\Command;

class LightFinder extends Command
{
    protected $signature = 'phue:light-finder';

    protected $description = 'Scanning / registering new lights';

    public function handle()
    {
        try {
            $client = (new \Phue\Phue())->connect();
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }


        $this->info("Testing connection to bridge at {$client->getHost()}");

        try {
            $client->sendCommand(
                new \Phue\Command\Ping
            );
        } catch (\Phue\Transport\Exception\ConnectionException $e) {
            $this->error("Issue connecting to bridge");
            exit(1);
        }

        // Quit if user is not authenticated
        if (!$client->sendCommand(new \Phue\Command\IsAuthorized)) {
            $this->info("{$client->getUsername()} is not authenticated with the bridge. Aborting.");

            exit(1);
        }

        // Start light scan,
        $client->sendCommand(
            new \Phue\Command\StartLightScan
        );

        $this->info("Scanning for lights. Turn at least one light off, then on...");

        // Found lights
        // TODO $lights = [];

        $lights = array();

        do {
            $response = $client->sendCommand(
                new \Phue\Command\GetNewLights
            );

            // Don't continue if the scan isn't active
            if (!$response->isScanActive()) {
                break;
            }

            // Iterate through each found light
            foreach ($response->getLights() as $lightId => $lightName) {
                // Light already found in poll
                if (isset($lights[$lightId])) {
                    continue;
                }

                $lights[$lightId] = $lightName;

                $this->info("Found: Light #{$lightId}, {$lightName}");
            }
        } while(true);
        $this->info("Done scanning");
    }
}
