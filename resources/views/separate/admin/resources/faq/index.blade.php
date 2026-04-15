<x-layout.admin.app>
    <x-slot name="head">
        <title> FAQs | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="FAQs" :addUrl="route('admin.faq.create')">
            <x-table.element.thead>
                <x-table.element.tr>
                    <x-table.element.th data="Question" />
                    <x-table.element.th data="Category" />
                    <x-table.element.th data="Status" />
                    <x-table.element.th data="View" />
                </x-table.element.tr>
            </x-table.element.thead>

            <x-table.element.tbody>
                @forelse ($data as $i)
                    <x-table.element.tr>
                        <x-table.element.td :data="$i->question ?? ''" />
                        <x-table.element.td :data="$i->category?->title ?? ($i->category?->name ?? '-')" />
                        <x-table.element.td :data="$i->is_active ? 'Active' : 'Not Active'" />
                        <x-table.element.td>
                            <a href="{{ route('admin.faq.show', $i->id) }}" class="inline-flex items-center gap-2 text-primary hover:underline">
                                View
                            </a>
                        </x-table.element.td>
                    </x-table.element.tr>
                @empty
                    <x-table.element.tr>
                        <x-table.element.td colspan="4" data="No Data Found" />
                    </x-table.element.tr>
                @endforelse
            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>
