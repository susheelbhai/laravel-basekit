<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Editor Form | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Editor Form" :action="route('admin.forms.simple.store')" submitName="Save">
            @method('patch')
            <x-form.element.input1 name="ckeditor" label="CK Editor" type="editor" div="1" data-editor="ckeditor" />
            <x-form.element.input1 name="tinymce" label="TinyMCE" type="editor" div="1" />
            <x-form.element.input1 name="textarea" label="Textarea" type="textarea" div="1" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
