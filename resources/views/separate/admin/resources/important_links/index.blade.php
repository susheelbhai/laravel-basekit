<x-layout.admin.app>
    <x-slot name="head">
        <title> All Important Link  | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="All Link" :addUrl="route('admin.important_links.create')">
            <x-table.element.thead>
                <x-table.element.tr>
                    <x-table.element.th data="Name" />
                    <x-table.element.th data="Href" />
                    <x-table.element.th data="Status" />
                    <x-table.element.th data="Action" />
                </x-table.element.tr>
            </x-table.element.thead>

            <x-table.element.tbody>
                @forelse ($data as $i)
                    <x-table.element.tr>
                        <x-table.element.td :data="$i['name']" />
                        <x-table.element.td :data="$i['href']" />
                        <x-table.element.td :data="$i['is_active'] == 1 ? 'Active' : 'Not Active'" />
                        <x-table.element.td>
                            <a href="{{ route('admin.important_links.show', $i->id) }}" class="inline-flex items-center gap-2 text-primary hover:underline">
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