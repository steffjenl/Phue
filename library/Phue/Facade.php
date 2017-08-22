<?php
namespace Phue;

class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'phue';
    }

    protected static function connect($ip = '', $username = '')
    {
        return (new Phue($ip = '', $username = ''))->getClient();
    }
}
