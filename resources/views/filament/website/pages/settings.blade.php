<x-filament-panels::page>
    {{-- <label for="color">Color</label> --}}

    <div class="grid gap-y-2">
        <label for="background">
            <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                Background
            </span>
        </label>
    
        <div class="grid grid-cols-4">

        </div>
    </div>

    <x-filament::button wire:click="openNewUserModal">
        Save Settings
    </x-filament::button>
</x-filament-panels::page>
