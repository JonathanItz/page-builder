<x-filament-panels::page>
    <!-- One of the following themes -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/> <!-- 'classic' theme --> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/monolith.min.css"/> <!-- 'monolith' theme -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css"/> <!-- 'nano' theme --> --}}

    <!-- Modern or es5 bundle -->
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.es5.min.js"></script>

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
                Tab 2
            </x-filament::tabs.item>
        
            <x-filament::tabs.item
                alpine-active="activeTab === 'tab3'"
                x-on:click="activeTab = 'tab3'"
            >
                Tab 3
            </x-filament::tabs.item>
        </x-filament::tabs>

        <x-filament::input.wrapper x-show="activeTab === 'tab1'" class="p-6 !ring-1 !ring-gray-200">
            <div
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
            
                <input type="text" id="color-picker" class="color-picker">
            </div>

            <div class="mt-8">
                <style>
                    .setting-container {
                        --brand-color: {{$brandColor}};
                    }
    
                    .polka {
                        background-color: #ffffff;
                        opacity: 0.8;
                        background-image: radial-gradient(var(--brand-color) 0.8px, #ffffff 0.8px);
                        background-size: 16px 16px;
                    }
    
                    .polka2 {
                        background-color: #ffffff;
                        opacity: 0.8;
                        background-image:  radial-gradient(var(--brand-color) 0.8px, transparent 0.8px), radial-gradient(var(--brand-color) 0.8px, #ffffff 0.8px);
                        background-size: 32px 32px;
                        background-position: 0 0,16px 16px;
                    }
                </style>

                <div>
                    <label for="background-pattern" class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                        Background Pattern
                    </label>
                
                    <div class="grid grid-cols-6 gap-4">
                        <div>
                            <input type="radio" id="white" value="white" class="peer hidden" wire:model="backgroundPatter">
                            <label for="white" class="bg-white block cursor-pointer w-full py-12 shadow-xl rounded-xl peer-checked:ring-2 peer-checked:ring-cyan-600"></label>
                        </div>

                        <div>
                            <input type="radio" id="polka" value="polka" class="peer hidden" wire:model="backgroundPatter">
                            <label for="polka" class="polka cursor-pointer block w-full py-12 shadow-xl rounded-xl peer-checked:ring-2 peer-checked:ring-cyan-600"></label>
                        </div>

                        <div>
                            <input type="radio" id="polka2" value="polka2" class="peer hidden" wire:model="backgroundPatter">
                            <label for="polka2" class="polka2 cursor-pointer block w-full py-12 shadow-xl rounded-xl peer-checked:ring-2 peer-checked:ring-cyan-600"></label>
                        </div>
                    </div>    
                </div>
            </div>

            <x-filament::button wire:click="submitColors" class="mt-8">
                Save Settings
            </x-filament::button>
        </x-filament::input.wrapper>
    </div>
</x-filament-panels::page>
