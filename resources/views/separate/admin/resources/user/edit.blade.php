<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit User | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Edit User" action="{{ route('admin.user.update', $data->id) }}" method="POST" submitName="Save">
            @method('patch')
            <x-form.element.input1 name="name" label="Name" type="text" required="required" :value="old('name', $data->name ?? '')" div="1" />
            <x-form.element.input1 name="email" label="Email" type="email" required="required" :value="old('email', $data->email ?? '')" div="1" />
            <x-form.element.input1 name="phone" label="Phone" type="text" required="required" :value="old('phone', $data->phone ?? '')" div="1" />

            <x-form.element.input-img name="profile_pic" :value="$data['profile_pic']" label="Profile Pic" type="image" div="6" ratio="125" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
