<x-layout.admin.app>
    <x-slot name="head">
        <title> Product Enquiries | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="Product Enquiries">
            <x-table.element.thead>
                <x-table.element.tr>
                    <x-table.element.th data="ID" />
                    <x-table.element.th data="Product" />
                    <x-table.element.th data="Name" />
                    <x-table.element.th data="Phone" />
                    <x-table.element.th data="Status" />
                    <x-table.element.th data="View" />
                </x-table.element.tr>
            </x-table.element.thead>

            <x-table.element.tbody>
                @forelse ($data as $i)
                    <x-table.element.tr>
                        <x-table.element.td :data="$i->id" />
                        <x-table.element.td :data="$i->product?->title ?? '-'" />
                        <x-table.element.td :data="$i->name ?? '-'" />
                        <x-table.element.td :data="$i->phone ?? '-'" />
                        <x-table.element.td :data="$i->status ?? '-'" />
                        <x-table.element.td>
                            <a href="{{ route('admin.productEnquiry.show', $i->id) }}" class="inline-flex items-center gap-2 text-primary hover:underline">
                                View
                            </a>
                        </x-table.element.td>
                    </x-table.element.tr>
                @empty
                    <x-table.element.tr>
                        <x-table.element.td colspan="6" data="No Data Found" />
                    </x-table.element.tr>
                @endforelse
            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>
