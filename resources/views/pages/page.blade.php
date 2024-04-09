<x-app-layout :showNavigation="false">
    <div class="bg-white px-6 py-24 lg:px-8 min-h-screen">
        <div class="mx-auto max-w-2xl text-base leading-7 text-gray-700 prose">
            @if ($page['content'])
                @foreach ($page['content'] as $content)
                    @includeIf('components.template-parts.'.$content['type'])
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
