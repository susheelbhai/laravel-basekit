<x-layout.admin.app>
    <x-slot name="head">
        <title> Create Product | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Create Product" action="{{ route('admin.product.store') }}" method="POST" submitName="Save">
            <x-form.element.input1 name="seller_id" label="Seller ID" type="number" :value="old('seller_id','')" div="1" />

            <div class="col-span-12">
                <label for="product_category_id" class="text-sm font-medium text-foreground">Category</label>
                <select
                    id="product_category_id"
                    name="product_category_id"
                    class="mt-1 block w-full rounded-input border border-input bg-input-bg px-3 py-2 text-sm text-input-text placeholder:text-input-placeholder focus:outline-none focus:ring-2 focus:ring-ring"
                    required
                >
                    <option value="">Choose...</option>
                    @foreach (($categories ?? []) as $c)
                        <option value="{{ $c->id }}" {{ (string) old('product_category_id') === (string) $c->id ? 'selected' : '' }}>
                            {{ $c->title }}
                        </option>
                    @endforeach
                </select>
                @error('product_category_id')
                    <x-form.validation-error :value="$message" />
                @enderror
            </div>

            <x-form.element.input1 name="title" label="Title" type="text" required="required" :value="old('title','')" div="1" />
            <x-form.element.input1 name="slug" label="Slug" type="text" :value="old('slug','')" div="1" />
            <x-form.element.input1 name="sku" label="SKU" type="text" :value="old('sku','')" div="1" />

            <x-form.element.input1 name="short_description" label="Short Description" type="textarea" :value="old('short_description','')" div="1" />
            <x-form.element.input1 name="description" label="Description" type="editor" :value="old('description','')" div="1" />
            <x-form.element.input1 name="long_description2" label="Long Description 2" type="editor" :value="old('long_description2','')" div="1" />
            <x-form.element.input1 name="long_description3" label="Long Description 3" type="editor" :value="old('long_description3','')" div="1" />

            <x-form.element.input1 name="features" label="Features" type="tags" :value="old('features','')" div="1" />

            <x-form.element.input1 name="price" label="Price" type="number" :value="old('price',0)" div="1" />
            <x-form.element.input1 name="original_price" label="Original Price" type="number" :value="old('original_price',0)" div="1" />
            <x-form.element.input1 name="mrp" label="MRP" type="number" :value="old('mrp',0)" div="1" />

            <x-form.element.input1 name="stock" label="Stock" type="number" :value="old('stock',0)" div="1" />
            <x-form.element.input1 name="manage_stock" label="Manage Stock" type="switch" :value="old('manage_stock',1)" div="1" />

            <x-form.element.input1 name="images" label="Images" type="images" div="1" />


            <x-form.element.input1 name="is_active" label="Active" type="switch" :value="old('is_active',1)" div="1" />
            <x-form.element.input1 name="is_featured" label="Featured" type="switch" :value="old('is_featured',0)" div="1" />

            <x-form.element.input1 name="meta_title" label="Meta Title" type="text" :value="old('meta_title','')" div="1" />
            <x-form.element.input1 name="meta_description" label="Meta Description" type="textarea" :value="old('meta_description','')" div="1" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
