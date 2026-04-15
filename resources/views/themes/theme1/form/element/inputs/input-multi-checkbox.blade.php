{{-- input-multi-checkbox.tsx: h-4 w-4 accent-secondary --}}
@php
    $mcVal = old($name, $value);
    $mcSelected = is_array($mcVal)
        ? array_map('strval', $mcVal)
        : ($mcVal !== null && $mcVal !== '' ? [strval($mcVal)] : []);
@endphp
<div class="mb-4 space-y-1">
    <label for="{{ $name }}" class="{{ $labelClass }}">
        {{ $label }}{!! $requiredMark !!}
    </label>
    <div class="flex flex-col gap-2 rounded-div border-2 border-input-border bg-input-bg p-3 transition-colors focus-within:border-secondary/60 focus-within:bg-input-focused-bg">
        @foreach (($options ?? []) as $option)
            @php
                $optVal = (string) (is_object($option) ? ($option->id ?? $option->value ?? $option) : $option);
                $optTitle = (string) (is_object($option) ? ($option->title ?? $option->name ?? $optVal) : $option);
            @endphp
            <label class="flex cursor-pointer select-none items-center gap-2 text-foreground">
                <input
                    type="checkbox"
                    name="{{ $name }}[]"
                    value="{{ $optVal }}"
                    class="h-4 w-4 cursor-pointer accent-secondary"
                    {{ in_array($optVal, $mcSelected, true) ? 'checked' : '' }}
                    {{ $attributes }}
                >
                <span>{{ $optTitle }}</span>
            </label>
        @endforeach
    </div>
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
