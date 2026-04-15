<x-layout.admin.app>
    <x-slot name="head">
        <title> View Testimonial | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="Testimonial Detail">
            <x-table.element.tbody>

            <x-table.element.tr>
                <x-table.element.th data="Name"/>
                <x-table.element.td :data="$data->name"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="designation"/>
                <x-table.element.td :data="$data->designation"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="organisation"/>
                <x-table.element.td :data="$data->organisation"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Image"/>
                <x-table.element.td>
                    <img src="{{ asset($data->image) }}" class="h-16 w-16 rounded-div object-cover" alt="">
                </x-table.element.td>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="message"/>
                <x-table.element.td :data="$data->message"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Status"/>
                <x-table.element.td :data="($data->is_active) ? 'Active' : 'Not Active'"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.td colspan="2">
                    <div class="py-3">
                        <a href="{{ route('admin.testimonial.edit', $data['id']) }}"
                           class="inline-flex h-9 items-center justify-center rounded-div bg-primary px-4 text-sm font-medium text-primary-foreground hover:bg-primary/90">
                            Edit Detail
                        </a>
                    </div>
                </x-table.element.td>
            </x-table.element.tr>

            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>
