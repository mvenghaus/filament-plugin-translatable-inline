<?php

declare(strict_types=1);

namespace Mvenghaus\FilamentPluginTranslatableInline\Forms\Components;

use Filament\Forms\Components\Component;

class Translatable extends Component
{
    protected string $view = 'filament-plugin-translatable-inline::forms.components.translatable';

    final public function __construct(
        Component $baseComponent,
        array $schema = []
    ) {
        $this->schema($schema);

        $this->statePath($baseComponent->getName());
    }

    public static function make(Component $component): static
    {
        $components = collect(self::getTranslatableLocales())
            ->map(fn (string $locale) => self::cloneComponent($component, $locale))
            ->toArray();

        $static = app(static::class, [
            'baseComponent' => $component,
            'schema' => $components,
        ]);
        $static->configure();

        return $static;
    }

    private static function cloneComponent(Component $component, string $locale): Component
    {
        return (clone $component)
            ->label("{$component->getLabel()} ({$locale})")
            ->statePath($locale);
    }

    public static function getTranslatableLocales(): array
    {
        return filament('spatie-laravel-translatable')->getDefaultLocales();
    }

    public function getMainComponent(): Component
    {
        return $this->getChildComponents()[0];
    }

    public function getSubComponents(): array
    {
        $subComponents = $this->getChildComponents();
        array_shift($subComponents);

        return $subComponents;
    }

    public function isLocaleStateEmpty(string $locale): bool
    {
        return empty($this->getState()[$locale]);
    }

    public function onlyMainLocaleRequired(): self
    {
        collect($this->childComponents)
            ->filter(fn (Component $component, int $index) => $index !== 0)
            ->map(fn (Component $component) => $component->required(false));

        return $this;
    }
}
