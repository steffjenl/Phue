<?php
/**
 * Phue: Philips Hue PHP Client
 *
 * @author    Michael Squires <sqmk@php.net>
 * @copyright Copyright (c) 2012 Michael K. Squires
 * @license   http://github.com/sqmk/Phue/wiki/License
 */
namespace Phue\Command;

use Phue\Client;
use Phue\Rule;

/**
 * Get light by id command
 */
class GetSensorById implements CommandInterface
{

    /**
     * Sensor Id
     *
     * @var string
     */
    protected $sensorid;

    /**
     * Constructs a command
     *
     * @param int $sensorid
     *            Sensor Id
     */
    public function __construct($sensorid)
    {
        $this->sensorid = (int) $sensorid;
    }

    /**
     * Send command
     *
     * @param Client $client
     *            Phue Client
     *
     * @return Sensor Sensor object
     */
    public function send(Client $client)
    {
        // Get response
        $attributes = $client->getTransport()->sendRequest(
            "/api/{$client->getUsername()}/sensors/{$this->sensorid}"
        );
        
        return new Sensor($this->sensorid, $attributes, $client);
    }
}
