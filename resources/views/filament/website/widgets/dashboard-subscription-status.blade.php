<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    @if ($hasAccess)
                        <a href="{{route('filament.website.resources.pages.index')}}">Start Creating <x-heroicon-o-arrow-right-circle class="h-7 w-7 inline" /></a>
                    @else
                        Looks like you don't have access
                    @endif
                </h2>

                @if ($hasTrial)
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        You have {{$trialTimeLeft}} days left in your trial.
                    </p>
                @endif

                <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                    Manage your subscription <b><a href="/billing">here</a></b>
                </p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
