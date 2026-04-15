<x-layout.user.app>

    <x-slot name="head">
        <title>{{ config('app.name') }}</title>
    </x-slot>
    @relativeInclude('_hero')
    @relativeInclude('_about')
    @relativeInclude('_service')
    @relativeInclude('_feature')
    @relativeInclude('_project')
    @relativeInclude('_team')
    @relativeInclude('_testimonial')
    @relativeInclude('_newsletter')
    @relativeInclude('_client')
</x-layout.user.app>