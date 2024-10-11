<?php

namespace Tschucki\TranslateJetstream;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tschucki\TranslateJetstream\Commands\TranslateJetstreamCommand;

class TranslateJetstreamServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('translate-jetstream')
            ->hasConfigFile()
            ->hasCommand(TranslateJetstreamCommand::class);
    }
}
