<div>
    <div
            x-data="{
                open: false,
                init() {
                    document.addEventListener('livewire:initialized', () => {
                        this.open = Boolean($refs.additionalContainer.querySelector(':invalid'));
                    })
                },
                handleOpenState() {
                    this.open = !this.open;
                    if (!this.open) {
                        this.open = Boolean($refs.additionalContainer.querySelector(':invalid'));
                    }
                }
        }"
            @form-validation-error.window="
                $nextTick(() => {
                    if ($refs.additionalContainer.querySelector('[data-validation-error]')) {
                        open = true;
                    }
                });
        "
    >
        <div>
            {{ $getChildComponentContainer('main') }}
        </div>

        <div class="flex items-center gap-1.5 cursor-pointer select-none my-2"
             @click="handleOpenState()"
        >
            <div x-show="!open">
                <x-filament::icon icon="heroicon-c-chevron-right" class="h-5 w-5 text-gray-500 dark:text-gray-400"/>
            </div>

            <div x-show="open">
                <x-filament::icon icon="heroicon-c-chevron-down" class="h-5 w-5 text-gray-500 dark:text-gray-400"/>
            </div>

            @foreach($getTranslatableLocales() as $locale)
                <div class="text-xs rounded-full p-1 shadow-sm ring-2 ring-inset ring-gray-950/10 dark:ring-white/20"
                     @if (!$isLocaleStateEmpty($locale))
                         style="border: 1px forestgreen solid"
                        @endif
                >
                    <div class="px-1">{{ $locale }}</div>
                </div>
            @endforeach
        </div>

        <div x-ref="additionalContainer"
             x-show="open"
        >
            <div class="p-4">
                {{ $getChildComponentContainer('additional') }}
            </div>
        </div>
    </div>
</div>