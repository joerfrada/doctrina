<?php

namespace App\Facades\WebServices;

use Illuminate\Support\Facades\Facade;

class WebServiceFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'WebService';
    }
}