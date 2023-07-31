<?php

namespace Ahrengot\RolesAndPermissions;

use Ahrengot\RolesAndPermissions\Commands\RolesAndPermissionsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RolesAndPermissionsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-roles-and-permissions')
            ->hasConfigFile()
            ->hasViews()
            ->hasCommand(RolesAndPermissionsCommand::class);
            ->hasMigration('add_role_to_users');
    }
}
