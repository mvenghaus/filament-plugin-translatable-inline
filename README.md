# Translatable Inline

This is an addon to [Spatie Translatable](https://filamentphp.com/plugins/filament-spatie-translatable) that allows you to edit your translation directly below the field. 

This approach offers several advantages:

- Faster editing of your translations
- Detecting fields that can be translated is much easier to see
- You can quickly see which translations are missing

## Requirements

You need the latest version of Filament v3.

This package is based on:
- [Spatie Laravel Translatable](https://github.com/spatie/laravel-translatable)
- [Filament Spatie Translatable Plugin](hhttps://github.com/filamentphp/spatie-laravel-translatable-plugin)

You don't need to install them separately, it's handled via dependencies. If you already use the Filament Spatie Translatable Plugin and want to migrate, see [Migrate Section](#migrate). 

## Installation

Install the package via composer:

```bash
composer require mvenghaus/filament-plugin-translatable-inline:"^3.0"
```

