<?php

namespace Phue\Console\Commands;

use Illuminate\Console\Command;

class ListLights extends Command
{
    protected $signature = 'phue:list-lights';

    protected $description = 'Create a permission';

    public function handle()
    {
        try
        {
            $client = (new \Phue\Phue())->connect();
        }
        catch (\Exception $exception)
        {
            $this->error($exception->getMessage());
        }


    }
}
