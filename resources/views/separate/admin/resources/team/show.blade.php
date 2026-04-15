<x-layout.admin.app>
    <x-slot name="head">
        <title> Team Member | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="Team Member Detail">
            <x-table.element.tbody>
                <x-table.element.tr>
                    <x-table.element.th data="Name" />
                    <x-table.element.td :data="$data->name ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Designation" />
                    <x-table.element.td :data="$data->designation ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Status" />
                    <x-table.element.td :data="$data->is_active ? 'Active' : 'Not Active'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Image" />
                    <x-table.element.td>
                        @php
                            $thumb = method_exists($data, 'getFirstMediaUrl') ? $data->getFirstMediaUrl('image', 'thumb') : '';
                        @endphp
                        @if ($thumb)
                            <img src="{{ $thumb }}" class="h-16 w-16 rounded-div object-cover" alt="">
                        @else
                            <span class="text-sm text-muted-foreground">-</span>
                        @endif
                    </x-table.element.td>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.td colspan="2">
                        <div class="py-3">
                            <a href="{{ route('admin.team.edit', $data->id) }}"
                                class="inline-flex h-9 items-center justify-center rounded-div bg-primary px-4 text-sm font-medium text-primary-foreground hover:bg-primary/90">
                                Edit
                            </a>
                        </div>
                    </x-table.element.td>
                </x-table.element.tr>
            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>
