<?php

namespace Ahrengot\RolesAndPermissions\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ahrengot\RolesAndPermissions\RolesAndPermissions
 */
class RolesAndPermissions extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Ahrengot\RolesAndPermissions\RolesAndPermissions::class;
    }
}
