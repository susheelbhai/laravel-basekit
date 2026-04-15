<x-layout.admin.app>
    <x-slot name="head">
        <title> All Blog | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="All Blogs" :addUrl="route('admin.blog.create')">
            <x-table.element.thead>
                <x-table.element.tr>
                    <x-table.element.th data="Title" />
                    <x-table.element.th data="Category" />
                    <x-table.element.th data="Description" />
                    <x-table.element.th data="Image" />
                    <x-table.element.th data="Status" />
                    <x-table.element.th data="Action" />
                </x-table.element.tr>
            </x-table.element.thead>

            <x-table.element.tbody>
                @forelse ($data as $i)
                    <x-table.element.tr>
                        <x-table.element.td :data="$i['title']" />
                        <x-table.element.td :data="$i['category']" />
                        <x-table.element.td :data="$i['short_description']" />
                        <x-table.element.td>
                            <img src="{{ $i['display_img'] }}" class="h-8 w-8 rounded-div object-cover" alt="">
                        </x-table.element.td>
                        <x-table.element.td>
                            @if ($i['is_active'] == 1)
                                <x-ui.badge title="Active" type="primary" />
                            @else
                                <x-ui.badge title="Not Active" type="danger" />
                            @endif
                        </x-table.element.td>
                        <x-table.element.td>
                            <a href="{{ route('admin.blog.show', $i['id']) }}" class="inline-flex items-center gap-2 text-primary hover:underline">
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