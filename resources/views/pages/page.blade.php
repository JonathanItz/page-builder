@php
    $showNav = (
            (isset($settings['showNav']) && $settings['showNav'] !== false)
            ||
            ! isset($settings['showNav'])
        )
        &&
        ! $allPages->isEmpty() && $allPages->count() > 1;
@endphp

@push('header-scripts')
    <style>
        :root {
            --brand-color: {{$settings['brandColor']}};
            --brand-contrast-color: {{getContrastColor($settings['brandColor'])}}
        }
    </style>

    <link rel="stylesheet" href="{{asset('/assets/images/css/patterns.css')}}">
@endpush

<x-app-layout
:showNavigation="false"
backgroundColor="bg-white"
:title="$page->title"
theme="{{isset($settings['theme']) ?$settings['theme']:''}}"
pattern="{{isset($settings['backgroundPattern']) ?$settings['backgroundPattern']:''}}"
>
    @if ($showNav)
        <nav x-data="{ open: false }" class="px-6 pt-4 lg:px-8">
            <div class="space-x-2 font-medium mx-auto max-w-2xl hidden md:block">
                @foreach ($allPages as $nav)
                    <a
                    href="{{route('page', [$uniqueId, $nav['slug']])}}"
                    wire:navigate
                    class="
                    dark:text-white
                    hover:bg-gray-100 transition-colors
                    rounded-md px-2 py-1
                    dark:hover:bg-slate-600
                    @if($nav['slug'] === $slug)
                        bg-gray-100 dark:bg-slate-700
                    @endif
                    "
                    >
                        {{$nav['title']}}
                    </a>
                @endforeach
            </div>

            <div class="flex justify-end md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden mt-2">
                <div class="flex flex-col gap-2 font-medium mx-auto max-w-2xl">
                    @foreach ($allPages as $nav)
                        <a
                        href="{{route('page', [$uniqueId, $nav['slug']])}}"
                        wire:navigate
                        class="
                        dark:text-white
                        hover:bg-gray-100 transition-colors
                        rounded-md px-2 py-1
                        dark:hover:bg-slate-600
                        @if($nav['slug'] === $slug)
                            bg-gray-100 dark:bg-slate-700
                        @endif
                        "
                        >
                            {{$nav['title']}}
                        </a>
                    @endforeach
                </div>
            </div>
        </nav>
    @endif

    <div class="py-16 md:py-24 px-6 lg:px-8 {{$showNav ?'min-h-[calc(100vh-40px)]':'min-h-screen'}}">
        <div class="mx-auto max-w-2xl text-base leading-7 text-gray-700 dark:text-white prose">
            @if ($page['content'])
                @foreach ($page['content'] as $content)
                    @includeIf('components.template-parts.'.$content['type'])
                @endforeach
            @endif
        </div>
    </div>

    @includeIf('pages.footer')
</x-app-layout>
