{{-- input-date-range-picker.tsx: fields {{ $name }}_from and {{ $name }}_to --}}
@php
    $fromVal = old($name . '_from', '');
    $toVal = old($name . '_to', '');
@endphp
<div class="mb-4 space-y-1">
    @if ($label)
        <span class="{{ $labelClass }} block">{{ $label }}{!! $requiredMark !!}</span>
    @endif
    <div class="flex flex-wrap gap-2">
        <input type="date" name="{{ $name }}_from" class="{{ $inputBase }}" value="{{ $fromVal }}" {{ $attributes }}>
        <input type="date" name="{{ $name }}_to" class="{{ $inputBase }}" value="{{ $toVal }}">
    </div>
    @error($name . '_from')
        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
    @error($name . '_to')
        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
    @error($name)
        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
