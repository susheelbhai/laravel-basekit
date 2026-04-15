<x-layout.admin.app>
    <x-slot name="head">
        <title> Edit FAQ | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <x-form.type.standard title="Edit FAQ" action="{{ route('admin.faq.update', $data->id) }}" method="POST" submitName="Save">
            @method('patch')

            <div class="col-span-12">
                <label for="faq_category_id" class="text-sm font-medium text-foreground">Category</label>
                <select
                    id="faq_category_id"
                    name="faq_category_id"
                    class="mt-1 block w-full rounded-input border border-input bg-input-bg px-3 py-2 text-sm text-input-text placeholder:text-input-placeholder focus:outline-none focus:ring-2 focus:ring-ring"
                    required
                >
                    <option value="">Choose...</option>
                    @foreach (($categories ?? []) as $c)
                        @php
                            $selected = (string) old('faq_category_id', $data->faq_category_id) === (string) $c->id;
                        @endphp
                        <option value="{{ $c->id }}" {{ $selected ? 'selected' : '' }}>
                            {{ $c->title ?? $c->name }}
                        </option>
                    @endforeach
                </select>
                @error('faq_category_id')
                    <x-form.validation-error :value="$message" />
                @enderror
            </div>

            <x-form.element.input1 name="question" label="Question" type="text" required="required" :value="old('question', $data->question ?? '')" div="1" />
            <x-form.element.input1 name="answer" label="Answer" type="editor" required="required" :value="old('answer', $data->answer ?? '')" div="1" />
            <x-form.element.input1 name="is_active" label="Active" type="switch" :value="old('is_active', $data->is_active ?? 1)" div="1" />
        </x-form.type.standard>
    </x-admin.page>
</x-layout.admin.app>
