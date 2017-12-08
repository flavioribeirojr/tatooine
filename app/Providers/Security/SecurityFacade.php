<?php

namespace App\Providers\Security;

use Illuminate\Support\Facades\Facade;

class SecurityFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \App\Providers\Security\Security::class;
    }
}