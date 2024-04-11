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
            <div
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
                    <div class="shadow inline-block rounded-md">
                        <input type="text" id="color-picker" class="color-picker">
                    </div>
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
                
                    <div class="grid grid-cols-6 gap-4">
                        @foreach ($possiblePatterns as $pattern)
                            <div>
                                <input type="radio" id="{{$pattern}}" value="{{$pattern}}" class="peer hidden" wire:model="backgroundPattern">
                                <label for="{{$pattern}}" class="
                                @if($pattern === 'white')
                                    bg-white
                                @elseif($pattern === 'gray')
                                    bg-gray-800
                                @else
                                    {{$pattern}}
                                @endif
                                block cursor-pointer w-full py-12 shadow-xl rounded-xl peer-checked:ring-2 peer-checked:ring-cyan-600
                                "></label>
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
