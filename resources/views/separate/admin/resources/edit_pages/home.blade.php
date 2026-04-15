<x-layout.admin.app>

    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Edit Home Page | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Edit Home Page" action="{{ route('admin.pages.updateHomePage') }}">
            @method('patch')
            <x-form.element.input1 name="banner_heading" label="Banner Heading" type="textarea"
                :value="$data['banner_heading'] ?? ''" div="1" />
            <x-form.element.input1 name="banner_description" label="Banner Description" type="editor"
                :value="$data['banner_description'] ?? ''" div="1" />
            <x-form.element.input-img name="banner_image" label="Banner Image" type="photo"
                :value="$data['banner_image'] ?? ''" div="4" />
            <x-form.element.input1 name="about_heading" label="About Heading" type="textarea"
                :value="$data['about_heading'] ?? ''" div="1" />
            <x-form.element.input1 name="about_description" label="About Description" type="editor"
                :value="$data['about_description'] ?? ''" div="1" />
            <x-form.element.input-img name="about_image" label="About Image" type="photo"
                :value="$data['about_image'] ?? ''" div="4" />
            <x-form.element.input1 name="why_us_heading" label="Why Us Heading" type="textarea"
                :value="$data['why_us_heading'] ?? ''" div="1" />
            <x-form.element.input1 name="why_us_description" label="Why Us Description" type="editor"
                :value="$data['why_us_description'] ?? ''" div="1" />
            <x-form.element.input-img name="why_us_image" label="Why Us Image" type="photo"
                :value="$data['why_us_image'] ?? ''" div="4" />
        </x-form.type.standard>

        <div class="mt-10 flex items-center justify-between gap-3">
            <div>
                <div class="text-base font-semibold">Banner Slider</div>
                <div class="mt-1 text-sm text-muted-foreground">Dimension: 1738 × 720</div>
            </div>
            <a href="{{ route('admin.slider1.create') }}"
                class="inline-flex h-9 items-center justify-center rounded-div bg-primary px-4 text-sm font-medium text-primary-foreground hover:bg-primary/90">
                Add New
            </a>
        </div>

    </x-admin.page>

</x-layout.admin.app>
