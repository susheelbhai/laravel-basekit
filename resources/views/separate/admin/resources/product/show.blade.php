<x-layout.admin.app>
    <x-slot name="head">
        <title> Product Detail | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="Product Detail">
            <x-table.element.tbody>
                <x-table.element.tr>
                    <x-table.element.th data="Title" />
                    <x-table.element.td :data="$data['title'] ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Slug" />
                    <x-table.element.td :data="$data['slug'] ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Seller ID" />
                    <x-table.element.td :data="$data['seller_id'] ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Category ID" />
                    <x-table.element.td :data="$data['product_category_id'] ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="SKU" />
                    <x-table.element.td :data="$data['sku'] ?? '-'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Short Description" />
                    <x-table.element.td :data="$data['short_description'] ?? '-'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Description" />
                    <x-table.element.td>
                        @if (!empty($data['description']))
                            <div class="prose prose-sm max-w-none dark:prose-invert">{!! $data['description'] !!}</div>
                        @else
                            <span class="text-sm text-muted-foreground">-</span>
                        @endif
                    </x-table.element.td>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Price" />
                    <x-table.element.td :data="$data['price'] ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="MRP" />
                    <x-table.element.td :data="$data['mrp'] ?? '-'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Stock" />
                    <x-table.element.td :data="$data['stock'] ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Manage Stock" />
                    <x-table.element.td :data="($data['manage_stock'] ?? 0) == 1 ? 'yes' : 'no'" />
                </x-table.element.tr>

                <x-table.element.tr>
                    <x-table.element.th data="Thumbnail" />
                    <x-table.element.td>
                        @if (!empty($data['images']) && count($data['images']) > 0)
                            <img src="{{ $data['images'][0] }}" class="h-32 w-32 rounded-div object-cover" alt="">
                        @else
                            <span class="text-sm text-muted-foreground">-</span>
                        @endif
                    </x-table.element.td>
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
                    <x-table.element.th data="Active" />
                    <x-table.element.td :data="($data['is_active'] ?? 0) == 1 ? 'active' : 'inactive'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Featured" />
                    <x-table.element.td :data="($data['is_featured'] ?? 0) == 1 ? 'yes' : 'no'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Meta Title" />
                    <x-table.element.td :data="$data['meta_title'] ?? '-'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Meta Description" />
                    <x-table.element.td :data="$data['meta_description'] ?? '-'" />
                </x-table.element.tr>

                <x-table.element.tr>
                    <x-table.element.td colspan="2">
                        <div class="py-3">
                            <a href="{{ route('admin.product.edit', $data['id']) }}"
                                class="inline-flex h-9 items-center justify-center rounded-div bg-primary px-4 text-sm font-medium text-primary-foreground hover:bg-primary/90">
                                Edit Product
                            </a>
                        </div>
                    </x-table.element.td>
                </x-table.element.tr>
            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>
