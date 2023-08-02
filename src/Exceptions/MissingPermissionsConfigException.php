<?php

namespace Ahrengot\RolesAndPermissions\Exceptions;

class MissingPermissionsConfigException extends \Exception
{
    public function __construct(string $userRole)
    {
        parent::__construct(
            message: "No permissions defined for user role '{$userRole}'. Make sure you added that user role to your permissions configuration."
        );
    }
}
