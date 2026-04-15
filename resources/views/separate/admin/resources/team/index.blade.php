<x-layout.admin.app>
    <x-slot name="head">
        <title> Team | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="Team" :addUrl="route('admin.team.create')">
            <x-table.element.thead>
                <x-table.element.tr>
                    <x-table.element.th data="Name" />
                    <x-table.element.th data="Designation" />
                    <x-table.element.th data="Image" />
                    <x-table.element.th data="Status" />
                    <x-table.element.th data="View" />
                </x-table.element.tr>
            </x-table.element.thead>
            <x-table.element.tbody>
                @forelse ($data as $i)
                    <x-table.element.tr>
                        <x-table.element.td :data="$i['name'] ?? ''" />
                        <x-table.element.td :data="$i['designation'] ?? ''" />
                        <x-table.element.td>
                            @if (!empty($i['image_thumb']))
                                <img src="{{ $i['image_thumb'] }}" class="h-8 w-8 rounded-div object-cover" alt="">
                            @else
                                <span class="text-sm text-muted-foreground">-</span>
                            @endif
                        </x-table.element.td>
                        <x-table.element.td :data="($i['is_active'] ?? 0) == 1 ? 'Active' : 'Not Active'" />
                        <x-table.element.td>
                            <a href="{{ route('admin.team.show', $i['id']) }}" class="inline-flex items-center gap-2 text-primary hover:underline">
                                View
                            </a>
                        </x-table.element.td>
                    </x-table.element.tr>
                @empty
                    <x-table.element.tr>
                        <x-table.element.td colspan="5" data="No Data Found" />
                    </x-table.element.tr>
                @endforelse
            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>
