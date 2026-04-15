<x-layout.admin.app>
    <x-slot name="head">
        <title> Product Enquiry | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="Product Enquiry Detail">
            <x-table.element.tbody>
                <x-table.element.tr>
                    <x-table.element.th data="ID" />
                    <x-table.element.td :data="$data->id ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Product" />
                    <x-table.element.td :data="$data->product?->title ?? '-'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Name" />
                    <x-table.element.td :data="$data->name ?? '-'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Email" />
                    <x-table.element.td :data="$data->email ?? '-'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Phone" />
                    <x-table.element.td :data="$data->phone ?? '-'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Message" />
                    <x-table.element.td :data="$data->message ?? '-'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Status" />
                    <x-table.element.td :data="$data->status ?? '-'" />
                </x-table.element.tr>

                <x-table.element.tr>
                    <x-table.element.td colspan="2">
                        <x-form.type.standard title="Update Status" action="{{ route('admin.productEnquiry.update', $data->id) }}" method="POST" submitName="Update">
                            @method('patch')
                            <div class="col-span-12">
                                <label for="status" class="text-sm font-medium text-foreground">Status</label>
                                <input id="status" name="status" type="text"
                                    class="mt-1 block w-full rounded-input border border-input bg-input-bg px-3 py-2 text-sm text-input-text placeholder:text-input-placeholder focus:outline-none focus:ring-2 focus:ring-ring"
                                    value="{{ old('status', $data->status ?? '') }}" required>
                                @error('status')
                                    <x-form.validation-error :value="$message" />
                                @enderror
                            </div>
                        </x-form.type.standard>
                    </x-table.element.td>
                </x-table.element.tr>
            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>
