<x-layout.admin.app>
    <x-slot name="head">
        <title> Create Permission | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Create Permission" action="{{ route('admin.permission.store') }}" method="POST" submitName="Save">
            <x-form.element.input1 name="name" label="Permission Name" type="text" required="required" :value="old('name','')" div="1" />

            <div class="col-span-12">
                <div class="text-sm font-medium text-foreground">Roles</div>
                <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach (($roles ?? []) as $r)
                        <label class="flex items-center gap-2 text-sm">
                            <input
                                type="checkbox"
                                name="roles[]"
                                value="{{ $r->id }}"
                                class="h-4 w-4 rounded border border-input"
                                {{ in_array((string) $r->id, (array) old('roles', []), true) ? 'checked' : '' }}
                            >
                            <span>{{ $r->title ?? $r->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('roles')
                    <x-form.validation-error :value="$message" />
                @enderror
            </div>
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
