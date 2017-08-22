<?php

namespace Phue\Console\Commands;

use Illuminate\Console\Command;

class BridgeFinder extends Command
{
    protected $signature = 'phue:bridge-finder';

    protected $description = 'Finding your Bridge';

    public function handle()
    {
        $this->info("Philips Hue Bridge Finder");
        $this->info("Checking meethue.com if the bridge has phoned home:");

        $response = file_get_contents('http://www.meethue.com/api/nupnp');

        if ($response === false) {
            $this->info("\tRequest failed. Ensure that you have internet connection.");
            exit(1);
        }

        $this->info("Request succeeded");

        $bridges = json_decode($response);

        $this->info("Number of bridges found: ", count($bridges));

        foreach ($bridges as $key => $bridge) {
            $this->info("\tBridge #" .  ++$key);
            $this->info("\t\tID: " . $bridge->id);
            $this->info("\t\tInternal IP Address: " . $bridge->internalipaddress);
            $this->info("\t\tMAC Address: " .  (!empty($bridge->macaddress) ? $bridge->macaddress : 'unknown'));
        }
    }
}
