<div>
    <style>
        .translate-svg-color {
            fill: #000;
        }
        html.dark .translate-svg-color {
            fill: #fff;
        }
    </style>
    <div x-data="{ open : false }">
        <div>
            {{ $getChildComponentContainer('main') }}
        </div>

        <div class="flex items-center cursor-pointer select-none mt-2"
             @click="open = !open"
        >
            <div x-show="!open" class="translate-svg-color">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" xml:space="preserve" width="24px" height="24px"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:none;} </style> <path d="M9,18l7-6L9,6V18z"></path> <rect class="st0" width="24" height="24"></rect> <rect class="st0" width="24" height="24"></rect> </g></svg>
            </div>

            <div x-show="open" class="translate-svg-color">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" xml:space="preserve" width="24px" height="24px"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:none;} </style> <path d="M6.5,8.5l6,7l6-7H6.5z"></path> <rect class="st0" width="24" height="24"></rect> <rect class="st0" width="24" height="24"></rect> </g></svg>
            </div>

            @foreach($getTranslatableLocales() as $locale)
                <div class="text-sm px-1 @if(!$isLocaleStateEmpty($locale)) font-bold @endif">
                    {{ Str::upper($locale) }}
                </div>
            @endforeach
        </div>

        <div class="mt-4 p-4"
             x-show="open"
        >
            {{ $getChildComponentContainer('additional') }}
        </div>
    </div>
</div>
