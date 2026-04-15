<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Simple Form | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Simple Form" :action="route('admin.forms.simple.store')" submitName="Save">
            @method('patch')
            <x-form.element.input1 name="text" label="Text" type="text" div="1" />
            <x-form.element.input1 name="number" label="Number" type="number" div="1" />
            <x-form.element.input1 name="email" label="Email" type="email" div="1" />
            <x-form.element.input1 name="password" label="Password" type="password" div="1" />
            <x-form.element.input1 name="tel" label="Phone" type="tel" div="1" />
            <x-form.element.input1 name="hidden_field" label="Hidden Field" type="hidden" :value="old('hidden_field', 'hidden-value')" div="1" />
            <x-form.element.input1 name="default_input" label="Default Input (fallback)" type="default" div="1" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
