<x-layout.admin.app>
    <x-slot name="head">
        <title> FAQ Detail | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="FAQ Detail">
            <x-table.element.tbody>
                <x-table.element.tr>
                    <x-table.element.th data="Question" />
                    <x-table.element.td :data="$data->question ?? ''" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Answer" />
                    <x-table.element.td>
                        @if (!empty($data->answer))
                            <div class="prose prose-sm max-w-none dark:prose-invert">{!! $data->answer !!}</div>
                        @else
                            <span class="text-sm text-muted-foreground">-</span>
                        @endif
                    </x-table.element.td>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Status" />
                    <x-table.element.td :data="$data->is_active ? 'Active' : 'Not Active'" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.td colspan="2">
                        <div class="py-3">
                            <a href="{{ route('admin.faq.edit', $data->id) }}"
                                class="inline-flex h-9 items-center justify-center rounded-div bg-primary px-4 text-sm font-medium text-primary-foreground hover:bg-primary/90">
                                Edit FAQ
                            </a>
                        </div>
                    </x-table.element.td>
                </x-table.element.tr>
            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>
