@php
    $radioOptions = [
        (object) ['title' => 'Option 1', 'value' => 'option1'],
        (object) ['title' => 'Option 2', 'value' => 'option2'],
        (object) ['title' => 'Option 3', 'value' => 'option3'],
    ];
    $multicheckboxOptions = [
        (object) ['title' => 'Check 1', 'value' => 'c1'],
        (object) ['title' => 'Check 2', 'value' => 'c2'],
        (object) ['title' => 'Check 3', 'value' => 'c3'],
    ];
@endphp
<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Select Form | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Select / Choice / Tags" :action="route('admin.forms.simple.store')" submitName="Save">
            @method('patch')
            <x-form.element.input1 name="radio" label="Radio Options" type="radio" :options="$radioOptions" :value="old('radio', 'option1')" div="1" />
            <x-form.element.input1 name="select" label="Select" type="select" :options="$states ?? []" div="1" />
            <x-form.element.input1 name="multiselect" label="Multi Select" type="multiselect" :options="$states ?? []" div="1" />
            <x-form.element.input1 name="checkbox" label="Checkbox (Single)" type="checkbox" :value="old('checkbox', 0)" div="1" />
            <x-form.element.input1 name="multicheckbox" label="Multi Checkbox" type="multicheckbox" :options="$multicheckboxOptions" div="1" />
            <x-form.element.input1 name="tags" label="Tag" type="tags" div="1" />
            <x-form.element.input1 name="switch" label="Switch" type="switch" :value="old('switch', 1)" div="1" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
