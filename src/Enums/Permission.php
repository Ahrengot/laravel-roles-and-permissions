<?php

namespace Ahrengot\RolesAndPermissions\Enums;

use Ahrengot\RolesAndPermissions\Contracts\Describable;

enum Permission implements Describable
{
    case AccessAdminPanel;

    case CreateApiTokens;

    public function description(): string
    {
        return match ($this) {
            self::AccessAdminPanel => __('Grants access to the admin panel'),
            self::CreateApiTokens => __('Create new API tokens'),
        };
    }
}
