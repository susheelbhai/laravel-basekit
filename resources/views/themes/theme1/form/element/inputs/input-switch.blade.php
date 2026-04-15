{{-- input-switch.tsx: role=switch button, green-500 when on --}}
@php
    $switchOn = old($name, $value) == 1 || old($name, $value) === true || old($name, $value) === '1';
    $__sid = 'sw_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
@endphp
<div class="mb-4 space-y-1">
    <label for="{{ $name }}" class="{{ $labelClass }}">
        {{ $label }}{!! $requiredMark !!}
    </label>
    <div class="space-y-2">
        <input type="hidden" name="{{ $name }}" id="{{ $__sid }}_hidden" value="{{ $switchOn ? '1' : '0' }}">
        <button
            type="button"
            id="{{ $__sid }}_btn"
            role="switch"
            aria-checked="{{ $switchOn ? 'true' : 'false' }}"
            class="relative inline-flex h-8 w-24 cursor-pointer items-center rounded-full transition-colors focus:outline-none {{ $switchOn ? 'bg-green-500' : 'bg-input-border' }}"
        >
            <span
                id="{{ $__sid }}_thumb"
                class="inline-block h-8 w-8 transform rounded-full bg-input-bg transition-transform {{ $switchOn ? 'translate-x-16' : 'translate-x-0' }}"
            ></span>
        </button>
    </div>
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
<script>
    (function() {
        var btn = document.getElementById('{{ $__sid }}_btn');
        var hid = document.getElementById('{{ $__sid }}_hidden');
        var thumb = document.getElementById('{{ $__sid }}_thumb');
        if (!btn || !hid || !thumb) return;
        btn.addEventListener('click', function() {
            var on = hid.value === '1';
            var next = on ? '0' : '1';
            hid.value = next;
            btn.setAttribute('aria-checked', next === '1' ? 'true' : 'false');
            btn.classList.toggle('bg-green-500', next === '1');
            btn.classList.toggle('bg-input-border', next !== '1');
            thumb.classList.toggle('translate-x-16', next === '1');
            thumb.classList.toggle('translate-x-0', next !== '1');
        });
    })();
</script>
