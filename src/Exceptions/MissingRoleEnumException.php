<?php

namespace Ahrengot\RolesAndPermissions\Exceptions;

class MissingRoleEnumException extends \Exception
{
    public function __construct(string $modelClass)
    {
        parent::__construct(
            message: "No `role` enum defined on  '{$modelClass}'"
        );
    }
}
