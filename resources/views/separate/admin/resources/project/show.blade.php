{{-- Mirrors resources/js/pages/admin/resources/project/show.tsx --}}
<x-layout.admin.app>
    <x-slot name="head">
        <title> Project Detail | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-table.type.responsive title="Project Detail">
            <x-table.element.tbody>
                <x-table.element.tr>
                    <x-table.element.th data="Title" />
                    <x-table.element.td :data="$data->title" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Author" />
                    <x-table.element.td :data="$data->author" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Tags" />
                    <x-table.element.td :data="$data->tags" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Ad URL" />
                    <x-table.element.td :data="$data->ad_url" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Views" />
                    <x-table.element.td :data="$data->views" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Highlighted Text 1" />
                    <x-table.element.td>
                        <div>{!! $data->highlighted_text1 !!}</div>
                    </x-table.element.td>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Highlighted Text 2" />
                    <x-table.element.td>
                        <div>{!! $data->highlighted_text2 !!}</div>
                    </x-table.element.td>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Short Description" />
                    <x-table.element.td :data="$data->short_description" />
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Long Description 1" />
                    <x-table.element.td>
                        <div>{!! $data->long_description1 !!}</div>
                    </x-table.element.td>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Long Description 2" />
                    <x-table.element.td>
                        <div>{!! $data->long_description2 !!}</div>
                    </x-table.element.td>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Long Description 3" />
                    <x-table.element.td>
                        <div>{!! $data->long_description3 !!}</div>
                    </x-table.element.td>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Gallery" />
                    <x-table.element.td>
                        @php
                            $gallery = collect($data->images ?? []);
                        @endphp
                        @if ($gallery->isNotEmpty())
                            <div class="flex flex-wrap gap-2">
                                @foreach ($gallery as $img)
                                    <img src="{{ is_array($img) ? ($img['url'] ?? '') : ($img->url ?? '') }}" alt="" width="160" class="rounded-div object-cover" />
                                @endforeach
                            </div>
                        @else
                            -
                        @endif
                    </x-table.element.td>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Ad Image" />
                    <x-table.element.td>
                        <img src="{{ $data->ad_img }}" alt="" width="320" class="max-w-full rounded-div object-contain" />
                    </x-table.element.td>
                </x-table.element.tr>
                <x-table.element.tr>
                    <x-table.element.th data="Status" />
                    <x-table.element.td :data="$data->is_active == 1 ? 'active' : 'inactive'" />
                </x-table.element.tr>

                <x-table.element.tr>
                    <x-table.element.td colspan="2">
                        <div class="py-3">
                            <a href="{{ route('admin.project.edit', $data->id) }}"
                                class="inline-flex h-9 items-center justify-center rounded-div bg-primary px-4 text-sm font-medium text-primary-foreground hover:bg-primary/90">
                                Edit
                            </a>
                        </div>
                    </x-table.element.td>
                </x-table.element.tr>
            </x-table.element.tbody>
        </x-table.type.responsive>
    </x-admin.page>
</x-layout.admin.app>
