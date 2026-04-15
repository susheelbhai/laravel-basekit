{{-- input-hidden.tsx: Input only (no wrapper) --}}
<input type="hidden" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}" {{ $attributes }}>
@include($__formTheme . '.form.element.inputs.partials.field-error')
