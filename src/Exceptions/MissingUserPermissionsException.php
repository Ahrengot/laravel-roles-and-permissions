<?php

namespace Ahrengot\RolesAndPermissions\Exceptions;

use Ahrengot\RolesAndPermissions\Traits\HasPermissions;

class MissingUserPermissionsException extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            message: 'No permissions property on model. Remember to add '.HasPermissions::class
        );
    }
}
