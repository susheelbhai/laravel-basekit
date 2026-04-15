<x-layout.admin.app>
    <x-slot name="head">
        <title> View Product | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="View Product Detail">
            <x-table.element.tbody>
            <x-table.element.tr>
                <x-table.element.th data="Title"/>
                <x-table.element.td :data="$data['title']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Slug"/>
                <x-table.element.td :data="$data['slug']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="SKU"/>
                <x-table.element.td :data="$data['sku']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Category ID"/>
                <x-table.element.td :data="$data['product_category_id']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Short Description"/>
                <x-table.element.td :data="$data['short_description']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Description"/>
                <x-table.element.td :data="$data['description']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Long Description 2"/>
                <x-table.element.td :data="$data['long_description2']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Long Description 3"/>
                <x-table.element.td :data="$data['long_description3']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Features"/>
                <x-table.element.td :data="$data['features']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Price"/>
                <x-table.element.td :data="$data['price']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Original Price"/>
                <x-table.element.td :data="$data['original_price']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="MRP"/>
                <x-table.element.td :data="$data['mrp']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Stock"/>
                <x-table.element.td :data="$data['stock']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Manage Stock"/>
                <x-table.element.td :data="$data['manage_stock'] ? 'Yes' : 'No'"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Status"/>
                <x-table.element.td :data="$data['is_active'] ? 'Active' : 'Not Active'"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Featured"/>
                <x-table.element.td :data="$data['is_featured'] ? 'Yes' : 'No'"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Meta Title"/>
                <x-table.element.td :data="$data['meta_title']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Meta Description"/>
                <x-table.element.td :data="$data['meta_description']"/>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.th data="Images"/>
                <x-table.element.td>
                    @foreach ($data['images'] as $img)
                        <img src="{{ $img }}" class="mr-1 inline-block h-16 w-16 rounded-div object-cover" alt="">
                    @endforeach
                </x-table.element.td>
            </x-table.element.tr>
            <x-table.element.tr>
                <x-table.element.td colspan="2">
                    <div class="py-3">
                        <a href="{{ route('admin.product.edit', $data['id']) }}"
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
