<?php

declare(strict_types=1);

namespace Mvenghaus\FilamentPluginTranslatableInline;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentPluginTranslatableInlineServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-plugin-translatable-inline';

    public static string $viewNamespace = 'filament-plugin-translatable-inline';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name);

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }
}
