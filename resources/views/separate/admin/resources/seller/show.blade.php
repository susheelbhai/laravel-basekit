<x-layout.admin.app>
    <x-slot name="head">
        <title> View Seller | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="View seller Detail">
            <x-table.element.tbody>
            <x-table.element.tr>
                <x-table.element.th data="Name"/>
                <x-table.element.td :data="$data->name"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Email"/>
                <x-table.element.td :data="$data->email"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Phone"/>
                <x-table.element.td :data="$data->phone"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Image"/>
                <x-table.element.td>
                    <img src="{{ $data->getFirstMediaUrl('profile_pic', 'thumb') }}" class="h-16 w-16 rounded-div object-cover" alt="">
                </x-table.element.td>
            </x-table.element.tr>
                
            <x-table.element.tr>
                <x-table.element.td colspan="2">
                    <div class="py-3">
                        <a href="{{ route('admin.seller.edit', $data['id']) }}"
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
