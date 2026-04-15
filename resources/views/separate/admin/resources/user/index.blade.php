<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> All Users | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="User Data">

            <x-table.element.thead>
                <x-table.element.tr>
                    <x-table.element.th data="Name" />
                    <x-table.element.th data="Email" />
                    <x-table.element.th data="Phone" />
                    <x-table.element.th data="Photo" />
                    <x-table.element.th data="Action" />
                </x-table.element.tr>
            </x-table.element.thead>

            <x-table.element.tbody>
                @forelse ($data as $i)
                    <x-table.element.tr>
                        <x-table.element.td :data="$i['name']" />
                        <x-table.element.td :data="$i['email']" />
                        <x-table.element.td :data="$i['phone']" />
                        <x-table.element.td>
                            <img src="{{ $i['profile_pic_thumb'] }}" class="h-8 w-8 rounded-div object-cover" alt="">
                        </x-table.element.td>
                        <x-table.element.td>
                            <a href="{{ route('admin.user.show', $i['id']) }}" class="inline-flex items-center gap-2 text-primary hover:underline">
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
