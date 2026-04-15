{{-- input-default.tsx --}}
<div class="mb-4 space-y-1">
    <label for="{{ $name }}" class="{{ $labelClass }}">
        {{ $label }}{!! $requiredMark !!}
    </label>
    <input
        id="{{ $name }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        class="{{ $inputBase }}"
        {{ $required }}
        {{ $attributes }}
    >
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
