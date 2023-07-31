<?php

namespace Ahrengot\RolesAndPermissions\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasPermissions
{
    protected array $temporaryPermissions = [];

    /**
     * Returns the permissions for this model
     */
    protected function permissionsConfig(): array
    {
        return config('user-permissions')[$this->role->value]['permissions'];
    }

    public function permissions(): Attribute
    {
        return Attribute::get(
            fn () => collect($this->temporaryPermissions)->merge($this->permissionsConfig())
        );
    }

    /**
     * Grants temporary permissions without saving to the database.
     * This is really only used for testing policies
     */
    public function grantPermission(string $permission): void
    {
        $this->temporaryPermissions[] = $permission;
    }
}
