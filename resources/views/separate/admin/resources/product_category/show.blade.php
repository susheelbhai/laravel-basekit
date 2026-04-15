<x-layout.admin.app>
    <x-slot name="head">
        <title> View Product Category | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="View Product Category Detail">
            <x-table.element.tbody>
                <x-table.element.tr>
                    <x-table.element.th data="Title" />
                    <x-table.element.td :data="$data['title'] ?? ($data->title ?? '')" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Slug" />
                    <x-table.element.td :data="$data['slug'] ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Description" />
                    <x-table.element.td :data="$data['description'] ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Position" />
                    <x-table.element.td :data="$data['position'] ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Meta Title" />
                    <x-table.element.td :data="$data['meta_title'] ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Meta Description" />
                    <x-table.element.td :data="$data['meta_description'] ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Icon" />
                    <x-table.element.td>
                        <img src="{{ $data['icon_thumb'] ?? '' }}" class="h-16 w-16 rounded-div object-cover" alt="">
                    </x-table.element.td>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Status" />
                    <x-table.element.td :data="($data['is_active'] ?? false) ? 'Active' : 'Not Active'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Featured" />
                    <x-table.element.td :data="($data['is_featured'] ?? false) ? 'Yes' : 'No'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.td colspan="2">
                        <div class="py-3">
                            <a href="{{ route('admin.product_category.edit', $data['id']) }}"
                                class="inline-flex h-9 items-center justify-center rounded-div bg-primary px-4 text-sm font-medium text-primary-foreground hover:bg-primary/90">
                                Edit Detail
                            </a>
                        </div>
                    </x-table.element.td>
                </x-table.element.tr>
            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>
