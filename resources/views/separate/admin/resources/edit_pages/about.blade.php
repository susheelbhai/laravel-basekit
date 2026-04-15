<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Edit About Page | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Edit About Page" action="{{ route('admin.pages.updateAboutPage') }}">
            @method('patch')
            <x-form.element.input1 name="para1" label="Paragraph 1" type="editor" :value="$data['para1'] ?? ''" div="1" />
            <x-form.element.input1 name="para2" label="Paragraph 2" type="editor" :value="$data['para2'] ?? ''" div="1" />
            <x-form.element.input1 name="objective" label="Objective" type="editor" :value="$data['objective'] ?? ''" div="1" />
            <x-form.element.input1 name="mission" label="Mission" type="editor" :value="$data['mission'] ?? ''" div="1" />
            <x-form.element.input1 name="vision" label="Vision" type="editor" :value="$data['vision'] ?? ''" div="1" />
            <x-form.element.input1 name="founder_message" label="Founder Message" type="editor" :value="$data['founder_message'] ?? ''" div="1" />

            <x-form.element.input-img name="founder_image" label="Founder Image" type="photo" :value="asset($data['founder_image'] ?? '')" div="4" />
            <x-form.element.input-img name="banner" label="Banner" type="photo" :value="asset($data['banner'] ?? '')" div="4" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
