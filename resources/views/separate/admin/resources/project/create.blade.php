<x-layout.admin.app>
    <x-slot name="head">
        <title> Create Project | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Create Project" action="{{ route('admin.project.store') }}" method="POST" submitName="Save">
            <x-form.element.input1 name="title" label="Title" type="text" required="required" :value="old('title','')" div="1" />
            <x-form.element.input1 name="author" label="Author" type="text" :value="old('author','')" div="1" />
            <x-form.element.input1 name="tags" label="Tags" type="tags" :value="old('tags','')" div="1" />

            <x-form.element.input1 name="short_description" label="Short Description" type="textarea" :value="old('short_description','')" div="1" />
            <x-form.element.input1 name="long_description1" label="Long Description 1" type="editor" :value="old('long_description1','')" div="1" />
            <x-form.element.input1 name="long_description2" label="Long Description 2" type="editor" :value="old('long_description2','')" div="1" />
            <x-form.element.input1 name="long_description3" label="Long Description 3" type="editor" :value="old('long_description3','')" div="1" />
            <x-form.element.input1 name="highlighted_text1" label="Highlighted Text 1" type="editor" :value="old('highlighted_text1','')" div="1" />
            <x-form.element.input1 name="highlighted_text2" label="Highlighted Text 2" type="editor" :value="old('highlighted_text2','')" div="1" />

            <x-form.element.input1 name="ad_url" label="Ad URL" type="url" :value="old('ad_url','')" div="1" />
            <x-form.element.input1 name="views" label="Views" type="number" :value="old('views',0)" div="1" />
            <x-form.element.input1 name="is_active" label="Active" type="switch" :value="old('is_active',1)" div="1" />

            <div class="col-span-12">
                <label for="ad_img" class="text-sm font-medium text-foreground">Ad Image</label>
                <input id="ad_img" name="ad_img" type="file"
                    class="mt-1 block w-full rounded-input border border-input bg-input-bg px-3 py-2 text-sm text-input-text file:mr-4 file:rounded-div file:border-0 file:bg-muted file:px-3 file:py-2 file:text-sm file:font-medium">
            </div>

            <div class="col-span-12">
                <label for="images" class="text-sm font-medium text-foreground">Images</label>
                <input id="images" name="images[]" type="file" multiple
                    class="mt-1 block w-full rounded-input border border-input bg-input-bg px-3 py-2 text-sm text-input-text file:mr-4 file:rounded-div file:border-0 file:bg-muted file:px-3 file:py-2 file:text-sm file:font-medium">
            </div>
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
