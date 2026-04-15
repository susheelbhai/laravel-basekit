<x-layout.admin.app>
    <x-slot name="head">
        <title> Notifications | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="Notifications">
            <x-table.element.thead>
                <x-table.element.tr>
                    <x-table.element.th data="Title" />
                    <x-table.element.th data="Date" />
                    <x-table.element.th data="Status" />
                    <x-table.element.th data="Open" />
                </x-table.element.tr>
            </x-table.element.thead>

            <x-table.element.tbody>
                @forelse ($data as $n)
                    <x-table.element.tr>
                        <x-table.element.td :data="$n->data['title'] ?? ($n->data['message'] ?? 'Notification')" />
                        <x-table.element.td :data="optional($n->created_at)->format('Y-m-d H:i')" />
                        <x-table.element.td :data="$n->read_at ? 'read' : 'unread'" />
                        <x-table.element.td>
                            <a href="{{ route('admin.notification.show', $n->id) }}" class="inline-flex items-center gap-2 text-primary hover:underline">
                                Open
                            </a>
                        </x-table.element.td>
                    </x-table.element.tr>
                @empty
                    <x-table.element.tr>
                        <x-table.element.td colspan="4" data="No Notifications" />
                    </x-table.element.tr>
                @endforelse
            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>
