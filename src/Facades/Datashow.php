<?php
/**
 * Created by PhpStorm.
 * User: rr891c
 * Date: 5/10/2019
 * Time: 22:54
 */

namespace Aitzgorri\Datashow\Facades;


use Illuminate\Support\Facades\Facade;

class Datashow extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Datashow';
    }
}