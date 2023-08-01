<?php

namespace Ahrengot\RolesAndPermissions\Traits;

trait IsComparableEnum
{
    /**
     * Determines if this enum matches another
     *
     * @param  mixed  $other enum value or instance
     */
    public function is(mixed $other): bool
    {
        if (is_string($other)) {
            return $this->value === $other;
        }

        return $this->name === $other->name;
    }

    /**
     * Determines if this enum does not match another
     *
     * @param  mixed  $other enum value or instance
     */
    public function isNot(mixed $other): bool
    {
        return ! $this->is($other);
    }
}
