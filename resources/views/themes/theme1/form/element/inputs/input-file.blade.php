{{-- input-file.tsx: h-32 w-150 → w-full max-w-2xl; drag border-blue-500 bg-blue-100 --}}
@php
    $__fid = 'f_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
@endphp
<div class="mb-4 space-y-1">
    <label for="{{ $__fid }}_ctl" class="{{ $labelClass }}">
        {{ $label }}{!! $requiredMark !!}
    </label>
    <div class="space-y-2">
        <input
            id="{{ $__fid }}_ctl"
            name="{{ $name }}"
            type="file"
            class="hidden"
            {{ $required }}
            {{ $attributes }}
            onchange="(function(el){var z=document.getElementById('{{ $__fid }}_zone'); if(!z)return; var t=z.querySelector('[data-file-label]'); if(el.files&&el.files[0]){t.textContent='Selected File: '+el.files[0].name;} else {t.textContent='Drag & drop or click to upload';}})(this)"
        >
        <div
            id="{{ $__fid }}_zone"
            role="button"
            tabindex="0"
            onclick="document.getElementById('{{ $__fid }}_ctl').click()"
            onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();document.getElementById('{{ $__fid }}_ctl').click();}"
            ondragover="event.preventDefault(); this.classList.add('border-blue-500','bg-blue-100');"
            ondragleave="event.preventDefault(); this.classList.remove('border-blue-500','bg-blue-100');"
            ondrop="event.preventDefault(); this.classList.remove('border-blue-500','bg-blue-100'); var inp=document.getElementById('{{ $__fid }}_ctl'); var f=event.dataTransfer.files; if(f&&f[0]){var d=new DataTransfer(); d.items.add(f[0]); inp.files=d.files; inp.dispatchEvent(new Event('change'));}"
            class="relative flex h-32 w-full max-w-2xl cursor-pointer items-center justify-center overflow-hidden rounded-div border-2 border-dashed border-input-border bg-input-bg transition-colors hover:bg-input-focused-bg"
        >
            <div class="text-center text-foreground">
                <p class="text-sm font-medium" data-file-label>
                    @if (old($name, $value))
                        Uploaded File: {{ old($name, $value) }}
                    @else
                        Drag & drop or click to upload
                    @endif
                </p>
            </div>
        </div>
    </div>
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
