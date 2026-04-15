<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Edit Contact Page | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Edit Contact Page" action="{{ route('admin.pages.updateContactPage') }}">
            @method('patch')
            <x-form.element.input1 name="form_heading1" label="Form Heading" type="text" :value="$data['form_heading1'] ?? ''" div="1" />
            <x-form.element.input1 name="form_paragraph1" label="Form Paragraph" type="textarea" :value="$data['form_paragraph1'] ?? ''" div="1" />
            <x-form.element.input1 name="map_embad_url" label="Map Embed URL" type="textarea" :value="$data['map_embad_url'] ?? ''" div="1" />
            <x-form.element.input1 name="working_hour" label="Working Hour" type="text" :value="$data['working_hour'] ?? ''" div="1" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
