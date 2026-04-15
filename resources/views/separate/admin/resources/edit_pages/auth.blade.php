<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Edit Auth Page | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Edit Auth Page" action="{{ route('admin.pages.updateAuthPage') }}">
            @method('patch')
            <x-form.element.input-img name="side_image" label="Side Image" type="photo" :value="asset($data['side_image'] ?? '')" div="4" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
