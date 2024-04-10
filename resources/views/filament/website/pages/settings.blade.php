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

        <x-filament::input.wrapper x-show="activeTab === 'tab1'" class="p-6">
            <div
            x-init="
                pickr = Pickr.create({
                    el: '.color-picker',
                    theme: 'monolith', // or 'monolith', or 'nano'
                    default: '{{$brandColor}}',
                    components: {
                        preview: true,
                        interaction: {hex: true,rgba: true,hsla: true,hsva: true,cmyk: true,input: true,clear: true,save: true}
                    }
                })

                pickr.on('save', function(color) {
                    $wire.brandColor = color.toHEXA().toString()
                })
            "
            >
                <label for="background">
                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                        Brand Color
                    </span>
                </label>
            
                <input type="text" class="color-picker">
            </div>

            <x-filament::button wire:click="submitColors" class="mt-8">
                Save Settings
            </x-filament::button>
        </x-filament::input.wrapper>
    </div>
</x-filament-panels::page>
