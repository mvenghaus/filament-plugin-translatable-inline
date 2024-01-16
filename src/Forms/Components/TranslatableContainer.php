<?php

declare(strict_types=1);

namespace Mvenghaus\FilamentPluginTranslatableInline\Forms\Components;

use Filament\Forms\Components\Component;
use Filament\Forms\ComponentContainer;
use Illuminate\Support\Collection;

class TranslatableContainer extends Component
{
    protected string $view = 'filament-plugin-translatable-inline::forms.components.translatable-container';

    protected Component $baseComponent;
    protected bool $onlyMainLocaleRequired = false;

    final public function __construct(array $schema = [])
    {
        $this->schema($schema);

        $this->baseComponent = collect($schema)->first();
        $this->statePath($this->baseComponent->getName());
    }

    public static function make(Component $component): static
    {
        $static = app(static::class, [
            'schema' => [$component]
        ]);
        $static->configure();

        return $static;
    }

    public function getChildComponentContainers(bool $withHidden = false): array
    {
        $locales = $this->getTranslatableLocales();

        $containers = [];

        $containers['main'] = ComponentContainer::make($this->getLivewire())
            ->parentComponent($this)
            ->components([$this->cloneComponent($this->baseComponent, $locales->first())]);

        $containers['additional'] = ComponentContainer::make($this->getLivewire())
            ->parentComponent($this)
            ->components(
                $locales
                    ->filter(fn(string $locale, int $index) => $index !== 0)
                    ->map(
                        fn(string $locale): Component => $this->cloneComponent($this->baseComponent, $locale)
                            ->clearAfterStateUpdatedHooks()
                            ->required(!$this->onlyMainLocaleRequired)
                    )
                    ->all()
            );

        return $containers;
    }

    public function cloneComponent(Component $component, string $locale): Component
    {
        return $component
            ->getClone()
            ->label("{$component->getLabel()} ({$locale})")
            ->statePath($locale);
    }

    public function getTranslatableLocales(): Collection
    {
        return collect(filament('spatie-laravel-translatable')->getDefaultLocales());
    }

    public function isLocaleStateEmpty(string $locale): bool
    {
        return empty($this->getState()[$locale]);
    }

    public function onlyMainLocaleRequired(): self
    {
        $this->onlyMainLocaleRequired = true;

        return $this;
    }
}
