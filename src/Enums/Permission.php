<?php

namespace Ahrengot\RolesAndPermissions\Enums;

enum Permission: string
{
    case ViewAdminPanel = 'admin_panel.view';

    case CreateApiTokens = 'api_tokens.create';
}
