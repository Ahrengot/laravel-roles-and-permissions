<?php

namespace Ahrengot\RolesAndPermissions;

use Illuminate\Support\Facades\Artisan;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
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
            ->name('roles-and-permissions')
            ->hasConfigFile('permissions')
            ->hasMigration('add_role_to_users')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->startWith(function (InstallCommand $command) {
                        $this->publishStubs($command);
                    })
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->endWith(function (InstallCommand $command) {

                        $command->newLine();
                        $command->info('Remember to update your User model with the provided HasPermissions trait and an enum cast for the role column.');
                    });
            });
    }

    public function bootingPackage()
    {
        $this->publishes([
            $this->package->basePath('../resources/stubs/Enums/UserRole.php.stub') => base_path('app/Enums/UserRole.php'),
            $this->package->basePath('../resources/stubs/Permissions/Permission.php.stub') => base_path('app/Permissions/Permission.php'),
        ], "{$this->package->shortName()}-stubs");

        $this->publishes([
            $this->package->basePath('../resources/stubs/Tests/Feature/Permissions/UserPermissionsTest.php.stub') => base_path('tests/Feature/Permissions/UserPermissionsTest.php'),
        ], "{$this->package->shortName()}-tests");
    }

    public function publishStubs(InstallCommand $command): void
    {
        Artisan::call('vendor:publish', [
            '--tag' => [
                "{$this->package->shortName()}-stubs",
                "{$this->package->shortName()}-tests",
            ],
        ], $command->getOutput());
    }
}
