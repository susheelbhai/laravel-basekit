<x-layout.admin.app>
    <x-slot name="head">
        <title> Roles | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="Roles" :addUrl="route('admin.role.create')">
            <x-table.element.thead>
                <x-table.element.tr>
                    <x-table.element.th data="Role" />
                    <x-table.element.th data="Permissions" />
                    <x-table.element.th data="Edit" />
                </x-table.element.tr>
            </x-table.element.thead>

            <x-table.element.tbody>
                @forelse (($data ?? []) as $r)
                    <x-table.element.tr>
                        <x-table.element.td :data="$r->name ?? '-'" />
                        <x-table.element.td>
                            <div class="flex flex-wrap gap-2">
                                @foreach (($r->permissions ?? []) as $p)
                                    <span class="inline-flex items-center rounded-div bg-muted px-2 py-1 text-xs text-foreground">
                                        {{ $p->name }}
                                    </span>
                                @endforeach
                            </div>
                        </x-table.element.td>
                        <x-table.element.td>
                            <a href="{{ route('admin.role.edit', $r->id) }}" class="inline-flex items-center gap-2 text-primary hover:underline">
                                Edit
                            </a>
                        </x-table.element.td>
                    </x-table.element.tr>
                @empty
                    <x-table.element.tr>
                        <x-table.element.td colspan="3" data="No Data Found" />
                    </x-table.element.tr>
                @endforelse
            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>

