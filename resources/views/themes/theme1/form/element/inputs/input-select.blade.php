{{-- input-select.tsx --}}
<div class="mb-4 space-y-1">
    <label for="{{ $name }}" class="{{ $labelClass }}">
        {{ $label }}{!! $requiredMark !!}
    </label>
    @include($__formTheme . '.form.element.inputs.partials.help-tooltip')
    <select id="{{ $name }}" name="{{ $name }}" class="{{ $selectBase }}" {{ $required }} {{ $attributes }}>
        <option value="">Select an option</option>
        @foreach (($options ?? []) as $item)
            @php
                if (is_array($item)) {
                    $optValue = $item['id'] ?? $item['value'] ?? '';
                    $optLabel = $item['title'] ?? $item['name'] ?? $item['label'] ?? $optValue;
                } elseif (is_object($item)) {
                    $optValue = $item->id ?? $item->value ?? $item;
                    $optLabel = $item->title ?? $item->name ?? $optValue;
                } else {
                    $optValue = $item;
                    $optLabel = $item;
                }
            @endphp
            <option value="{{ $optValue }}" {{ (string) $optValue === (string) old($name, $value) ? 'selected' : '' }}>
                {{ $optLabel }}
            </option>
        @endforeach
    </select>
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
