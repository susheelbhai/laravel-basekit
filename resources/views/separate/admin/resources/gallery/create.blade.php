<x-layout.admin.app>
    <x-slot name="head">
        <title> Create Gallery | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Create Gallery" action="{{ route('admin.gallery.store') }}" method="POST" submitName="Save">
            <x-form.element.input1 name="title" label="Title" type="text" required="required" :value="old('title','')" div="1" />
            <x-form.element.input1 name="description" label="Description" type="textarea" :value="old('description','')" div="1" />

            <div class="col-span-12">
                <label for="images" class="text-sm font-medium text-foreground">Images</label>
                <input
                    id="images"
                    name="images[]"
                    type="file"
                    multiple
                    class="mt-1 block w-full rounded-input border border-input bg-input-bg px-3 py-2 text-sm text-input-text file:mr-4 file:rounded-div file:border-0 file:bg-muted file:px-3 file:py-2 file:text-sm file:font-medium"
                >
                @error('images')
                    <x-form.validation-error :value="$message" />
                @enderror
            </div>
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
