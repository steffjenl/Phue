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
class GetSceneById implements CommandInterface
{

    /**
     * Scene Id
     *
     * @var string
     */
    protected $sceneid;

    /**
     * Constructs a command
     *
     * @param int $sceneid
     *            Scene Id
     */
    public function __construct($sceneid)
    {
        $this->sceneid = (int) $sceneid;
    }

    /**
     * Send command
     *
     * @param Client $client
     *            Phue Client
     *
     * @return Scene Scene object
     */
    public function send(Client $client)
    {
        // Get response
        $attributes = $client->getTransport()->sendRequest(
            "/api/{$client->getUsername()}/scenes/{$this->sceneid}"
        );
        
        return new Scene($this->sceneid, $attributes, $client);
    }
}
