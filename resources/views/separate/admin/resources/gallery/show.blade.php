<x-layout.admin.app>
    <x-slot name="head">
        <title> Gallery Detail | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="Gallery Detail">
            <x-table.element.tbody>
                <x-table.element.tr>
                    <x-table.element.th data="Title" />
                    <x-table.element.td :data="$data['title'] ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Description" />
                    <x-table.element.td :data="$data['description'] ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Gallery" />
                    <x-table.element.td>
                        @if (!empty($data['images']) && count($data['images']) > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach ($data['images'] as $img)
                                    <img src="{{ $img }}" class="h-20 w-20 rounded-div object-cover" alt="">
                                @endforeach
                            </div>
                        @else
                            <span class="text-sm text-muted-foreground">-</span>
                        @endif
                    </x-table.element.td>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.td colspan="2">
                        <div class="py-3">
                            <a href="{{ route('admin.gallery.edit', $data['id']) }}"
                                class="inline-flex h-9 items-center justify-center rounded-div bg-primary px-4 text-sm font-medium text-primary-foreground hover:bg-primary/90">
                                Edit Gallery
                            </a>
                        </div>
                    </x-table.element.td>
                </x-table.element.tr>
            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>
