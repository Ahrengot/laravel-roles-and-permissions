<?php

namespace Ahrengot\RolesAndPermissions\Traits;

use Ahrengot\RolesAndPermissions\Exceptions\MissingPermissionsConfigException;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasPermissions
{
    protected array $temporaryPermissions = [];

    /**
     * Returns the permissions for this model
     *
     * @throws MissingPermissionsConfigException
     */
    protected function permissionsConfig(): array
    {
        if (! config()->has('permissions.roles.'.$this->role->value)) {
            throw new MissingPermissionsConfigException($this->role->value);
        }

        return config('permissions.roles')[$this->role->value];
    }

    public function permissions(): Attribute
    {
        return Attribute::get(
            fn () => collect($this->temporaryPermissions)->merge($this->permissionsConfig())
        )->withoutObjectCaching();
    }

    /**
     * Grants temporary permissions which is useful for
     * testing authorization and policies
     */
    public function grantTemporaryPermission(string $permission): void
    {
        $this->temporaryPermissions[] = $permission;
    }
}
