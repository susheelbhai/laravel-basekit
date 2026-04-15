{{-- No dedicated TSX; same pattern as input-default.tsx + plugin class --}}
<div class="mb-4 space-y-1">
    <label for="{{ $name }}" class="{{ $labelClass }}">{{ $label }}{!! $requiredMark !!}</label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="text"
        class="as_colorpicker {{ $inputBase }}"
        value="{{ old($name, $value) }}"
        {{ $required }}
        {{ $attributes }}
    >
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
