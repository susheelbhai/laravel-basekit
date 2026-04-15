<x-layout.user.app>
    <x-slot name="head">
        <title>Dashboard | {{ config('app.name') }}</title>
    </x-slot>

    @include('user.pages.home._hero')
    @include('user.pages.home._about')
    @include('user.pages.home._service')
    @include('user.pages.home._feature')
    @include('user.pages.home._project')
    @include('user.pages.home._team')
    @include('user.pages.home._testimonial')
    @include('user.pages.home._newsletter')
    @include('user.pages.home._client')
</x-layout.user.app>
