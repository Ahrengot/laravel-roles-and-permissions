<?php

namespace Ahrengot\RolesAndPermissions\Enums;

use Ahrengot\RolesAndPermissions\Contracts\Comparable;
use Ahrengot\RolesAndPermissions\Contracts\Describable;
use Ahrengot\RolesAndPermissions\Contracts\StaticArrayable;
use Ahrengot\RolesAndPermissions\Traits\HasStaticArray;
use Ahrengot\RolesAndPermissions\Traits\IsComparableEnum;

enum UserRole: string implements StaticArrayable, Describable, Comparable
{
    use HasStaticArray, IsComparableEnum;

    case Admin = 'admin';
    case User = 'user';

    public function description(): string
    {
        return match ($this) {
            self::Admin => __('Admin'),
            self::User => __('User'),
        };
    }
}
