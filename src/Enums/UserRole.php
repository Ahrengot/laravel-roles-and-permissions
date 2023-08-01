<?php

namespace Ahrengot\RolesAndPermissions\Enums;

use Ahrengot\RolesAndPermissions\Contracts\Describable;
use Illuminate\Contracts\Support\Arrayable;

enum UserRole: string implements Arrayable, Describable
{
    case Admin = 'admin';
    case User = 'user';

    /**
     * Returns a human-readable version of the role
     */
    public function description(): string
    {
        return match ($this) {
            self::Admin => __('Admin'),
            self::User => __('User'),
        };
    }

    /**
     * Returns an associative array of role keys and human-readable names.
     * Useful for dropdowns etc.
     */
    public function toArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(
                fn (UserRole $u) => [$u->value => $u->description()]
            )->all();
    }
}
