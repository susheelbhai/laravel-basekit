<x-layout.admin.app>
    <x-slot name="head">
        <title> Create Slider | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Create Slider" action="{{ route('admin.slider1.store') }}" method="POST" submitName="Save">
            <x-form.element.input1 name="heading1" label="Heading 1" type="text" required="required" :value="old('heading1','')" div="1" />
            <x-form.element.input1 name="heading2" label="Heading 2" type="text" :value="old('heading2','')" div="1" />
            <x-form.element.input1 name="paragraph1" label="Paragraph 1" type="textarea" :value="old('paragraph1','')" div="1" />
            <x-form.element.input1 name="paragraph2" label="Paragraph 2" type="textarea" :value="old('paragraph2','')" div="1" />

            <x-form.element.input1 name="btn_name" label="Button Name" type="text" :value="old('btn_name','')" div="1" />
            <x-form.element.input1 name="btn_url" label="Button URL" type="url" :value="old('btn_url','')" div="1" />
            <x-form.element.input1 name="btn_target" label="Button Target" type="text" :value="old('btn_target','')" div="1" />

            <x-form.element.input1 name="is_active" label="Active" type="switch" :value="old('is_active',1)" div="1" />

            <div class="col-span-12">
                <label for="image1" class="text-sm font-medium text-foreground">Image 1</label>
                <input id="image1" name="image1" type="file" required
                    class="mt-1 block w-full rounded-input border border-input bg-input-bg px-3 py-2 text-sm text-input-text file:mr-4 file:rounded-div file:border-0 file:bg-muted file:px-3 file:py-2 file:text-sm file:font-medium">
            </div>
            <div class="col-span-12">
                <label for="image2" class="text-sm font-medium text-foreground">Image 2</label>
                <input id="image2" name="image2" type="file"
                    class="mt-1 block w-full rounded-input border border-input bg-input-bg px-3 py-2 text-sm text-input-text file:mr-4 file:rounded-div file:border-0 file:bg-muted file:px-3 file:py-2 file:text-sm file:font-medium">
            </div>
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
