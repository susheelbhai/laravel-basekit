<x-layout.user.app>
    <x-slot name="head">
        <title>About Us | {{ config('app.name') }}</title>
    </x-slot>

    @relativeInclude('_about')
</x-layout.user.app>
