<?php

use Ahrengot\RolesAndPermissions\Enums\Permission;
use Ahrengot\RolesAndPermissions\Enums\UserRole;

// config for Ahrengot/RolesAndPermissions
return [
    UserRole::Admin->value => [
        'permissions' => [
            Permission::ViewAdminPanel->value,
            Permission::CreateApiTokens->value,
        ],
    ],
    UserRole::User->value => [
        'permissions' => [
            Permission::CreateApiTokens->value,
        ],
    ],
];
