<x-filament-panels::page>
    <!-- One of the following themes -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/> <!-- 'classic' theme --> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/monolith.min.css"/> <!-- 'monolith' theme -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css"/> <!-- 'nano' theme --> --}}

    <!-- Modern or es5 bundle -->
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.es5.min.js"></script> --}}

    <div
    x-data="{ activeTab: 'tab1' }"
    class="setting-container"
    >
        <x-filament::tabs label="Content tabs" class="mb-8">
            <x-filament::tabs.item
                alpine-active="activeTab === 'tab1'"
                x-on:click="activeTab = 'tab1'"
            >
                Styles
            </x-filament::tabs.item>
        
            <x-filament::tabs.item
                alpine-active="activeTab === 'tab2'"
                x-on:click="activeTab = 'tab2'"
            >
                Details
            </x-filament::tabs.item>
        
            {{-- <x-filament::tabs.item
                alpine-active="activeTab === 'tab3'"
                x-on:click="activeTab = 'tab3'"
            >
                Tab 3
            </x-filament::tabs.item> --}}
        </x-filament::tabs>

        <x-filament::section x-show="activeTab === 'tab1'" class="">
            <div>
                <label for="showNav" class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                    Hide/Show Nav Links
                </label>

                <div x-data="{active: {{$showNav?'true':'false' }}}">
                    <!-- Enabled: "bg-cyan-600", Not Enabled: "bg-gray-200" -->
                    <button
                    x-on:click="
                    $wire.showNav = ! active
                    active = ! active
                    "
                    x-bind:class="active?'bg-cyan-600':'bg-gray-200'"
                    id="showNav" type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-cyan-600 focus:ring-offset-2" role="switch" aria-checked="false">
                        <span class="sr-only">Use setting</span>
                        <!-- Enabled: "translate-x-5", Not Enabled: "translate-x-0" -->
                        <span x-bind:class="active?'translate-x-5':'translate-x-0'" class="translate-x-0 pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out">
                            <!-- Enabled: "opacity-0 duration-100 ease-out", Not Enabled: "opacity-100 duration-200 ease-in" -->
                            <span
                            x-bind:class="active?'opacity-0 duration-100 ease-out':'opacity-100 duration-200 ease-in'"
                            class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity" aria-hidden="true">
                                <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 12 12">
                                <path d="M4 8l2-2m0 0l2-2M6 6L4 4m2 2l2 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <!-- Enabled: "opacity-100 duration-200 ease-in", Not Enabled: "opacity-0 duration-100 ease-out" -->
                            <span
                            x-bind:class="active?'opacity-100 duration-200 ease-in':'opacity-0 duration-100 ease-out'"
                            class="absolute inset-0 flex h-full w-full items-center justify-center transition-opacity" aria-hidden="true">
                                <svg class="h-3 w-3 text-cyan-600" fill="currentColor" viewBox="0 0 12 12">
                                <path d="M3.707 5.293a1 1 0 00-1.414 1.414l1.414-1.414zM5 8l-.707.707a1 1 0 001.414 0L5 8zm4.707-3.293a1 1 0 00-1.414-1.414l1.414 1.414zm-7.414 2l2 2 1.414-1.414-2-2-1.414 1.414zm3.414 2l4-4-1.414-1.414-4 4 1.414 1.414z" />
                                </svg>
                            </span>
                        </span>
                    </button>
                </div>
            </div>

            <div
            class="mt-8"
            wire:ignore
            x-init="
                pickr = Pickr.create({
                    el: '.color-picker',
                    theme: 'monolith', // 'classic' 'monolith', or 'nano'
                    default: '{{$brandColor}}',
                    components: {
                        hue: true,
                        preview: true,
                        interaction: {hex: true,rgba: true,hsla: true,hsva: true,cmyk: true,input: true,clear: true,save: true}
                    }
                })

                pickr.on('save', function(color) {
                    brandColor = color.toHEXA().toString()
                    $wire.brandColor = brandColor
                    document.querySelector('.setting-container').style.cssText = '--brand-color: '+brandColor+'';
                })
            "
            >
                <label for="color-picker" class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                    Brand Color
                </label>
            
                <div>
                    <div class="shadow inline-block rounded-xl" style="width: calc((100% / 6) - 1rem)">
                        <input type="text" id="color-picker" class="color-picker">
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <label for="background-pattern" class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                    Background Theme
                </label>
            
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                    @foreach ($possibleThemes as $theme)
                        <div>
                            <input type="radio" id="{{$theme}}" value="{{$theme}}" class="peer hidden" wire:model="theme">
                            <label for="{{$theme}}" class="
                            @if($theme === 'white')
                                bg-white
                            @elseif($theme === 'dark')
                                bg-slate-800
                            @endif
                            block cursor-pointer w-full py-14 shadow-xl rounded-xl peer-checked:ring-2 peer-checked:ring-cyan-600
                            "></label>
                        </div>
                    @endforeach
                </div>    
            </div>

            <div class="mt-8">
                <style>
                    .setting-container {
                        --brand-color: {{$brandColor}};
                    }
                </style>

                <link rel="stylesheet" href="{{asset('/assets/images/css/patterns.css')}}">

                <div>
                    <label for="background-pattern" class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                        Background Pattern
                    </label>
                
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                        @foreach ($possiblePatterns as $pattern)
                            <div>
                                <input type="radio" id="{{$pattern}}" value="{{$pattern}}" class="peer hidden" wire:model="backgroundPattern">
                                <label for="{{$pattern}}" class="
                                @if($pattern)
                                    {{$pattern}}
                                @endif
                                block cursor-pointer w-full py-14 shadow-xl rounded-xl peer-checked:ring-2 peer-checked:ring-cyan-600 relative
                                "
                                x-bind:class="$wire.theme === 'light' ?'bg-white':'bg-slate-800 text-white'"
                                >
                                    @if ($pattern === 'blank')
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 absolute left-1/2 top1/2 -translate-x-1/2 -translate-y-1/2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>                                      
                                    @endif
                                </label>
                            </div>
                        @endforeach
                    </div>    
                </div>
            </div>

            @if ($errors->any())
                <div class="text-sm text-red-600 mt-6">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <x-filament::button wire:click="submitStyles" class="mt-8">
                Save Settings
            </x-filament::button>
        </x-filament::section>
    </div>
</x-filament-panels::page>
