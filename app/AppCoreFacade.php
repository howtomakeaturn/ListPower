<?php

namespace App;

use Illuminate\Support\Facades\Facade;
use App\AppCore as RealAppCore;

class AppCoreFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RealAppCore::class;
    }
}
