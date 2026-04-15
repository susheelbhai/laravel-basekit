<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Image Form | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Image Form" :action="route('admin.forms.simple.store')" submitName="Save">
            @method('patch')
            <x-form.element.input1 name="image" label="Image" type="image" div="1" />
            <x-form.element.input1 name="images" label="Multi Image" type="images" div="1" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
