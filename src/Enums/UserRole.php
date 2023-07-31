<?php

namespace Ahrengot\RolesAndPermissions\Enums;

use Illuminate\Contracts\Support\Arrayable;

enum UserRole: string implements Arrayable
{
    case Admin = 'admin';
    case User = 'user';

    public function description(): string
    {
        return match ($this) {
            self::Admin => __('Admin'),
            self::User => __('User'),
        };
    }

    public function toArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(
                fn (UserRole $u) => [$u->value => $u->description()]
            )->all();
    }
}
