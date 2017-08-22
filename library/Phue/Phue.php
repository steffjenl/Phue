<?php

namespace Phue;

class Phue
{
    private $client;

    public function __construct($ip = '', $username = '')
    {
        if (empty(config('phue.ip',$ip)))
        {
            throw new \Exception("IP Address not found in config");
        }

        if (empty(config('phue.username',$username)))
        {
            throw new \Exception("Username not found in config");
        }

        $client = new \Phue\Client(config('phue.ip',$ip),config('phue.username',$username));

        try
        {
            $client->sendCommand(new \Phue\Command\Ping);
        }
        catch (\Phue\Transport\Exception\ConnectionException $e)
        {
            throw new \Exception("Can't connect to hue bridge");
        }

        return $client;
    }

    public function connect($ip = '', $username = '')
    {
        if (empty(config('phue.ip',$ip)))
        {
            throw new \Exception("IP Address not found in config");
        }

        if (empty(config('phue.username',$username)))
        {
            throw new \Exception("Username not found in config");
        }

        $client = new \Phue\Client(config('phue.ip',$ip),config('phue.username',$username));

        try
        {
            $client->sendCommand(new \Phue\Command\Ping);
        }
        catch (\Phue\Transport\Exception\ConnectionException $e)
        {
            throw new \Exception("Can't connect to hue bridge");
        }

        return $client;
    }
}
