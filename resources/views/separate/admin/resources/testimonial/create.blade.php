<x-layout.admin.app>
    <x-slot name="head">
        <title> Add Testimonial | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Add Testimonial" action="{{ route('admin.testimonial.store') }}">
            <x-form.element.input1 name="name" label="Name" type="text" required="required" div="1" />
            <x-form.element.input1 name="designation" label="designation" type="text" required="required" div="1" />
            <x-form.element.input1 name="organisation" label="organisation" type="text" required="required" div="1" />
            <x-form.element.input1 name="message" label="message" type="textarea" required="required" div="1" />
            <x-form.element.input1 name="is_active" label="Status" type="switch" :value="1" />
            <x-form.element.input-img name="image" :value="asset('images/testimonials/'.'dummy.png')" label="Profile Pic" type="image" div="4" ratio="125" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
