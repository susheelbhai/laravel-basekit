<x-layout.user.app>
    <x-slot name="head">
        <title>Blogs | {{ config('app.name') }}</title>
    </x-slot>

    @relativeInclude('_blogs')
</x-layout.user.app>
