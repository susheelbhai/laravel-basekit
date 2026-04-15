<x-layout.admin.app>
    <x-slot name="head">
        <title> View User Query | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="View User Query">
            <x-table.element.tbody>

            <x-table.element.tr>
                <x-table.element.th data="Name" />
                <x-table.element.td :data="$data->name" />
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="email" />
                <x-table.element.td :data="$data->email" />
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="phone" />
                <x-table.element.td :data="$data->phone" />
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="subject" />
                <x-table.element.td :data="$data->subject" />
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="message" />
                <x-table.element.td :data="$data->message" />
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Status" />
                <x-table.element.td :data="$data->is_active ? 'Active' : 'Not Active'" />
            </x-table.element.tr>
            <x-table.element.tr>
                <form action="{{ route('admin.userQuery.update', $data->id) }}" method="post">
                    @method('patch')
                    @csrf
                    <x-table.element.td colspan="1">
                        <select name="status"
                            class="flex h-9 w-full rounded-div border border-input bg-background px-3 py-1 text-sm shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring">
                            <option value=""> Select Status *</option>
                            @foreach ($statuses as $i)
                                <option value="{{ $i->id }}" @if ($i->id == $data->status_id) selected @endif>
                                    {{ $i->name }} </option>
                            @endforeach
                        </select>
                    </x-table.element.td>
                    <x-table.element.td colspan="1">
                        <button type="submit"
                            class="inline-flex h-9 items-center justify-center rounded-div bg-primary px-4 text-sm font-medium text-primary-foreground hover:bg-primary/90">
                            Submit
                        </button>
                    </x-table.element.td>
                </form>
            </x-table.element.tr>

            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>
