<x-layout.admin.app>
    <x-slot name="head">
        <title> Admins | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="Admins" :addUrl="route('admin.admin.create')">
            <x-table.element.thead>
                <x-table.element.tr>
                    <x-table.element.th data="Name" />
                    <x-table.element.th data="Email" />
                    <x-table.element.th data="Phone" />
                    <x-table.element.th data="Photo" />
                    <x-table.element.th data="View" />
                </x-table.element.tr>
            </x-table.element.thead>
            <x-table.element.tbody>
                @forelse ($data as $i)
                    <x-table.element.tr>
                        <x-table.element.td :data="$i['name'] ?? ''" />
                        <x-table.element.td :data="$i['email'] ?? ''" />
                        <x-table.element.td :data="$i['phone'] ?? ''" />
                        <x-table.element.td>
                            @if (!empty($i['profile_pic_thumb']))
                                <img src="{{ $i['profile_pic_thumb'] }}" class="h-8 w-8 rounded-div object-cover" alt="">
                            @else
                                <span class="text-sm text-muted-foreground">-</span>
                            @endif
                        </x-table.element.td>
                        <x-table.element.td>
                            <a href="{{ route('admin.admin.show', $i['id']) }}" class="inline-flex items-center gap-2 text-primary hover:underline">
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
