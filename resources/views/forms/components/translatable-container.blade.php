<div>
    <style>
        .translate-svg-color {
            fill: #000;
        }
        html.dark .translate-svg-color {
            fill: #fff;
        }
    </style>
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

        <div class="flex items-center gap-1.5 cursor-pointer select-none mt-2"
             @click="handleOpenState()"
        >
            <div x-show="!open" class="translate-svg-color">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" xml:space="preserve" width="24px" height="24px"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:none;} </style> <path d="M9,18l7-6L9,6V18z"></path> <rect class="st0" width="24" height="24"></rect> <rect class="st0" width="24" height="24"></rect> </g></svg>
            </div>

            <div x-show="open" class="translate-svg-color">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" xml:space="preserve" width="24px" height="24px"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:none;} </style> <path d="M6.5,8.5l6,7l6-7H6.5z"></path> <rect class="st0" width="24" height="24"></rect> <rect class="st0" width="24" height="24"></rect> </g></svg>
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
            <div class="mt-4 p-4">
                {{ $getChildComponentContainer('additional') }}
            </div>
        </div>
    </div>
</div>