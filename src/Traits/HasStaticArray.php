<?php

namespace Ahrengot\RolesAndPermissions\Traits;

use Ahrengot\RolesAndPermissions\Contracts\Describable;

trait HasStaticArray
{
    /**
     * Returns an associative array of keys and descriptions.
     * Useful for dropdowns etc.
     *
     * @return array<array-key, string>
     */
    public static function asArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(
                fn (Describable $enum) => [$enum->value => $enum->description()]
            )->all();
    }
}
