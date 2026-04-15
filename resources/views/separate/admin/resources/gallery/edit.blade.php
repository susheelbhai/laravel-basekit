<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit Gallery | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Edit Gallery" action="{{ route('admin.gallery.update', $data['id']) }}" method="POST" submitName="Save">
            @method('patch')
            <x-form.element.input1 name="title" label="Title" type="text" required="required" :value="old('title', $data['title'] ?? '')" div="1" />
            <x-form.element.input1 name="description" label="Description" type="textarea" :value="old('description', $data['description'] ?? '')" div="1" />

            <div class="col-span-12">
                <label class="text-sm font-medium text-foreground">Existing Images</label>
                @if (!empty($data['images']) && count($data['images']) > 0)
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach ($data['images'] as $img)
                            <img src="{{ $img }}" class="h-20 w-20 rounded-div object-cover" alt="">
                        @endforeach
                    </div>
                @else
                    <div class="mt-2 text-sm text-muted-foreground">-</div>
                @endif
            </div>

            <div class="col-span-12">
                <label for="images" class="text-sm font-medium text-foreground">Add Images</label>
                <input
                    id="images"
                    name="images[]"
                    type="file"
                    multiple
                    class="mt-1 block w-full rounded-input border border-input bg-input-bg px-3 py-2 text-sm text-input-text file:mr-4 file:rounded-div file:border-0 file:bg-muted file:px-3 file:py-2 file:text-sm file:font-medium"
                >
            </div>
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
