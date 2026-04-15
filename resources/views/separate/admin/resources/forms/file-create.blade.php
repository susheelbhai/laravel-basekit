<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>File Form | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="File Form" :action="route('admin.forms.simple.store')" submitName="Save">
            @method('patch')
            <x-form.element.input1 name="file" label="File" type="file" div="1" />
            <x-form.element.input1 name="files" label="Multi File" type="files" div="1" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
