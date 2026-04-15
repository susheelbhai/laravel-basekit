{{-- input-textarea.tsx --}}
<div class="mb-4 space-y-1">
    <label for="{{ $name }}" class="{{ $labelClass }}">
        {{ $label }}{!! $requiredMark !!}
    </label>
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="5"
        class="{{ $textareaBase }}"
        placeholder="{{ $placeholder }}"
        {{ $required }}
        {{ $attributes }}
    >{{ old($name, $value) }}</textarea>
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
