<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit Admin | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Edit Admin" action="{{ route('admin.admin.update', $data->id) }}" method="POST" submitName="Save">
            @method('patch')
            <x-form.element.input1 name="name" label="Name" type="text" required="required" :value="old('name', $data->name ?? '')" div="1" />
            <x-form.element.input1 name="dob" label="DOB" type="date" :value="old('dob', $data->dob ?? '')" div="1" />
            <x-form.element.input1 name="address" label="Address" type="textarea" :value="old('address', $data->address ?? '')" div="1" />
            <x-form.element.input1 name="city" label="City" type="text" :value="old('city', $data->city ?? '')" div="1" />
            <x-form.element.input1 name="state" label="State" type="text" :value="old('state', $data->state ?? '')" div="1" />
            <x-form.element.input1 name="email" label="Email" type="email" required="required" :value="old('email', $data->email ?? '')" div="1" />
            <x-form.element.input1 name="phone" label="Phone" type="text" required="required" :value="old('phone', $data->phone ?? '')" div="1" />

            <div class="col-span-12">
                <label for="profile_pic" class="text-sm font-medium text-foreground">Replace Profile Pic</label>
                <input id="profile_pic" name="profile_pic" type="file"
                    class="mt-1 block w-full rounded-input border border-input bg-input-bg px-3 py-2 text-sm text-input-text file:mr-4 file:rounded-div file:border-0 file:bg-muted file:px-3 file:py-2 file:text-sm file:font-medium">
            </div>

            <div class="col-span-12">
                <div class="text-sm font-medium text-foreground">Roles</div>
                <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach (($roles ?? []) as $r)
                        @php
                            $checked = in_array((string) $r->id, (array) old('roles', $data->roles?->pluck('id')?->map(fn ($x) => (string) $x)->all() ?? []), true);
                        @endphp
                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" name="roles[]" value="{{ $r->id }}" class="h-4 w-4 rounded border border-input" {{ $checked ? 'checked' : '' }}>
                            <span>{{ $r->title ?? $r->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="col-span-12">
                <div class="text-sm font-medium text-foreground">Permissions</div>
                <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach (($permissions ?? []) as $p)
                        @php
                            $checked = in_array((string) $p->id, (array) old('permissions', $data->permissions?->pluck('id')?->map(fn ($x) => (string) $x)->all() ?? []), true);
                        @endphp
                        <label class="flex items-center gap-2 text-sm">
                            <input type="checkbox" name="permissions[]" value="{{ $p->id }}" class="h-4 w-4 rounded border border-input" {{ $checked ? 'checked' : '' }}>
                            <span>{{ $p->title ?? $p->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
