<x-layout.admin.app>
    <x-slot name="head">
        <title> All Portfolio | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="All Portfolios" :addUrl="route('admin.portfolio.create')">
            <x-table.element.thead>
                <x-table.element.tr>
                    <x-table.element.th data="Name" />
                    <x-table.element.th data="Url" />
                    <x-table.element.th data="Logo" />
                    <x-table.element.th data="Status" />
                    <x-table.element.th data="Action" />
                </x-table.element.tr>
            </x-table.element.thead>

            <x-table.element.tbody>
                @forelse ($data as $i)
                    <x-table.element.tr>
                        <x-table.element.td :data="$i['name']" />
                        <x-table.element.td :data="$i['url']" />
                        <x-table.element.td>
                            <img src="{{ asset($i->logo) }}" class="h-8 w-auto rounded-div object-contain" alt="">
                        </x-table.element.td>
                        <x-table.element.td :data="$i->is_active == 1 ? 'Active' : 'Not Active'" />
                        <x-table.element.td>
                            <a href="{{ route('admin.portfolio.show', $i->id) }}" class="inline-flex items-center gap-2 text-primary hover:underline">
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