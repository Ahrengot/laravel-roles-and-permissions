<?php

namespace Ahrengot\RolesAndPermissions\Enums;

use Ahrengot\RolesAndPermissions\Contracts\Describable;

enum Permission: string implements Describable
{
    case AccessAdminPanel = 'admin_panel.access';

    case CreateApiTokens = 'api_tokens.create';

    /**
     * Returns a human-readable version of the permission
     */
    public function description(): string
    {
        return match ($this) {
            self::AccessAdminPanel => __('Grants access to the admin panel'),
            self::CreateApiTokens => __('Create new API tokens'),
        };
    }
}
