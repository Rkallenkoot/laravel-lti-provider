<?php

declare(strict_types=1);

namespace Swis\Laravel\LtiProvider;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Swis\Laravel\LtiProvider\Commands\DeleteExpiredLtiNonces;

class LtiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('lti-service-provider')
            ->hasMigrations(
                '2023_10_26_100000_add_client_table',
                '2023_10_26_200000_add_lti_tables'
            )
            ->publishesServiceProvider('LtiServiceProvider')
            ->hasConfigFile('lti-provider')
            ->hasCommand(DeleteExpiredLtiNonces::class)
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToStarRepoOnGitHub('swisnl/laravel-lti-provider');
            });
    }
}
