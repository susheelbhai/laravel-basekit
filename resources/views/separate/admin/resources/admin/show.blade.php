<x-layout.admin.app>
    <x-slot name="head">
        <title> Admin Detail | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="Admin Detail">
            <x-table.element.tbody>
                <x-table.element.tr>
                    <x-table.element.th data="Name" />
                    <x-table.element.td :data="$data->name ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Email" />
                    <x-table.element.td :data="$data->email ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Phone" />
                    <x-table.element.td :data="$data->phone ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Profile Pic" />
                    <x-table.element.td>
                        @php
                            $thumb = method_exists($data, 'getFirstMediaUrl') ? $data->getFirstMediaUrl('profile_pic', 'thumb') : '';
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
                            <a href="{{ route('admin.admin.edit', $data->id) }}"
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
