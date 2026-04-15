<x-layout.admin.app>
    <x-slot name="head">
        <title> Create Team Member | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Create Team Member" action="{{ route('admin.team.store') }}" method="POST" submitName="Save">
            <x-form.element.input1 name="name" label="Name" type="text" required="required" :value="old('name','')" div="1" />
            <x-form.element.input1 name="designation" label="Designation" type="text" required="required" :value="old('designation','')" div="1" />
            <x-form.element.input1 name="is_active" label="Active" type="switch" :value="old('is_active',1)" div="1" />
            <x-form.element.input1 name="image" label="Image" type="image" div="1" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
