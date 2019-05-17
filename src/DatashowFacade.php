<?php

namespace Aitzgorri\Datashow;

use Illuminate\Support\Facades\Facade;

class DatashowFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'datashow';
    }
}