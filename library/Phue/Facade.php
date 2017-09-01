<?php
namespace Phue;

/**
 * Class Facade
 *
 * @category  DevOps
 * @package   Phue
 * @author    Stephan Eizinga <stephan.eizinga@gmail.com>
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * @var  $ip
     */
    private $ip;
    /**
     * @var  $username
     */
    private $username;
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'phue';
    }

    /**
     * getClient
     *
     * @return Client
     */
    protected static function getClient()
    {
        return (new Phue())->getClient();
    }

    /**
     * getLights
     *
     * @return Light[]
     */
    protected static function getLights()
    {
        return (new Phue())->getClient()->getLights();
    }

    /**
     * getLightById
     *
     * @param $id
     *
     * @return Light[]
     */
    protected static function getLightById($id)
    {
        return (new Phue())->getClient()->getLightById($id);
    }

    /**
     * getGroups
     *
     * @return Group[]
     */
    protected static function getGroups()
    {
        return (new Phue())->getClient()->getGroups();
    }

    /**
     * getGroupById
     *
     * @param $id
     *
     * @return Group
     */
    protected static function getGroupById($id)
    {
        return (new Phue())->getClient()->getGroupById($id);
    }

    /**
     * setWakeUpLightOnLight
     *
     * @param     $id
     * @param int $transitiontime
     *
     * @return mixed
     */
    protected static function setWakeUpLightOnLight($id, $transitiontime = 60)
    {
        return (new Phue())->getClient()->getLightById($id)->setWakeUpLight($transitiontime);
    }

    /**
     * setWakeUpLightOnGroup
     *
     * @param     $id
     * @param int $transitiontime
     *
     * @return Group
     */
    protected static function setWakeUpLightOnGroup($id, $transitiontime = 60)
    {
        return (new Phue())->getClient()->getGroupById($id)->setWakeUpLight($transitiontime);
    }
}
