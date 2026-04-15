<x-layout.admin.app>
    <x-slot name="head">
        <title> Projects | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="Projects" :addUrl="route('admin.project.create')">
            <x-table.element.thead>
                <x-table.element.tr>
                    <x-table.element.th data="Title" />
                    <x-table.element.th data="Author" />
                    <x-table.element.th data="Thumbnail" />
                    <x-table.element.th data="Status" />
                    <x-table.element.th data="View" />
                </x-table.element.tr>
            </x-table.element.thead>
            <x-table.element.tbody>
                @forelse ($data as $i)
                    <x-table.element.tr>
                        <x-table.element.td :data="$i['title'] ?? ''" />
                        <x-table.element.td :data="$i['author'] ?? '-'" />
                        <x-table.element.td>
                            @if (!empty($i['thumbnail']))
                                <img src="{{ $i['thumbnail'] }}" class="h-8 w-8 rounded-div object-cover" alt="">
                            @else
                                <span class="text-sm text-muted-foreground">-</span>
                            @endif
                        </x-table.element.td>
                        <x-table.element.td :data="($i['is_active'] ?? 0) ? 'Active' : 'Not Active'" />
                        <x-table.element.td>
                            <a href="{{ route('admin.project.show', $i['id']) }}" class="inline-flex items-center gap-2 text-primary hover:underline">
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
