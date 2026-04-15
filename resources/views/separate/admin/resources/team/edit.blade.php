<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit Team Member | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Edit Team Member" action="{{ route('admin.team.update', $data->id) }}" method="POST" submitName="Save">
            @method('patch')
            <x-form.element.input1 name="name" label="Name" type="text" required="required" :value="old('name', $data->name ?? '')" div="1" />
            <x-form.element.input1 name="designation" label="Designation" type="text" required="required" :value="old('designation', $data->designation ?? '')" div="1" />
            <x-form.element.input1 name="is_active" label="Active" type="switch" :value="old('is_active', $data->is_active ?? 1)" div="1" />
            <x-form.element.input-img name="image" label="Replace Image" type="image" :value="$data['image'] ?? ''" div="1" ratio="125" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
