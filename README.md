# Translatable Inline

This is an addon to [Spatie Translatable](https://filamentphp.com/plugins/filament-spatie-translatable) that allows you to edit your translation directly below the field. 

This approach offers several advantages:

- Faster editing of your translations
- Detecting fields that can be translated is much easier to see
- You can quickly see which translations are missing

## Screenshots

![Screenshot](https://github.com/mvenghaus/filament-plugin-translatable-inline/blob/main/docs/images/screenshot.png)

## Requirements

You need the latest version of Filament v3.

This package is based on:
- [Spatie Laravel Translatable](https://github.com/spatie/laravel-translatable)
- [Filament Spatie Translatable Plugin](https://github.com/filamentphp/spatie-laravel-translatable-plugin)

You don't need to install them separately, it's handled via dependencies. If you already use the Filament Spatie Translatable Plugin and want to migrate, see [Migrate Section](#migrate). 

## Installation

Install the package via composer:

```bash
composer require mvenghaus/filament-plugin-translatable-inline:"^3.0"
```

### Configuration

Since it is based on the Spatie plugin, it must be registered as described in the [documentation](https://github.com/filamentphp/spatie-laravel-translatable-plugin).

> **_NOTE:_** It is important that you don't add the traits and the header action to your form resource pages, or it won't work! Only the trait "Translatable" in your resource is required!

Instead of having a locale switcher in a dropdown above, you add a container for each translatable field.

**Before**
```php
<?php

...

    public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->maxLength(255)
                        ->required()
                    ,

...
```

**After**
```php
<?php

...

use Mvenghaus\FilamentPluginTranslatableInline\Forms\Components\TranslatableContainer;

...

    public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    TranslatableContainer::make(
                        Forms\Components\TextInput::make('title')
                            ->maxLength(255)
                            ->required()
                    )->onlyMainLocaleRequired() // optional
                    ,

...
```

For each field that can be translated, simply repeat this process, and you'll be done.

> **_NOTE:_** You don't have to globally choose between inline or dropdown. Instead, you can choose an option on each page. For instance, it makes sense to have the dropdown in the list view and then use the inline version when editing.

### Options

#### onlyMainLocaleRequired

Sometimes you might want the field to be required, but only for the primary language. For example, if you set the TextInput to 'required,' it applies to all language variants. This is where this option comes into play. It removes the 'required' validation for all other languages except the primary one.

## Usage

### Empty translations

![Screenshot](https://github.com/mvenghaus/filament-plugin-translatable-inline/blob/main/docs/images/screenshot.png)

As you can see in the screenshot, the field "Title" is not bolded for "ES". That means that this translation is empty.