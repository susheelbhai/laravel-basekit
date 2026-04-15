<x-layout.admin.app>
    <x-slot name="head">
        <title> Create Role | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Create Role" action="{{ route('admin.role.store') }}" method="POST" submitName="Save">
            <x-form.element.input1 name="name" label="Role Name" type="text" required="required" :value="old('name','')" div="1" />

            <div class="col-span-12">
                <div class="text-sm font-medium text-foreground">Permissions</div>
                <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach (($permissions ?? []) as $p)
                        <label class="flex items-center gap-2 text-sm">
                            <input
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $p->id }}"
                                class="h-4 w-4 rounded border border-input"
                                {{ in_array((string) $p->id, (array) old('permissions', []), true) ? 'checked' : '' }}
                            >
                            <span>{{ $p->title ?? $p->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('permissions')
                    <x-form.validation-error :value="$message" />
                @enderror
            </div>
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
