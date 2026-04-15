<x-layout.admin.app>
    <x-slot name="head">
        <title> View Service | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="View Service Detail">
            <x-table.element.tbody>

            <x-table.element.tr>
                <x-table.element.th data="Title"/>
                <x-table.element.td :data="$data->title"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Category"/>
                <x-table.element.td :data="$data->category"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Short Description"/>
                <x-table.element.td :data="$data->short_description"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Long Description 1"/>
                <x-table.element.td > {!! $data->long_description1 !!} </x-table.element.td>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Long Description 2"/>
                <x-table.element.td > {!! $data->long_description2 !!} </x-table.element.td>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Long Description 3"/>
                <x-table.element.td > {!! $data->long_description3 !!} </x-table.element.td>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Image"/>
                <x-table.element.td>
                    <img src="{{ asset($data->display_img) }}" class="h-16 w-16 rounded-div object-cover" alt="">
                </x-table.element.td>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Status"/>
                <x-table.element.td :data="($data->is_active) ? 'Active' : 'Not Active'"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.td colspan="2">
                    <div class="py-3">
                        <a href="{{ route('admin.service.edit', $data['id']) }}"
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
