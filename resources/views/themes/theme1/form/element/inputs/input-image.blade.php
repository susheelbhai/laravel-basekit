{{-- input-image.tsx: flex stack + id-based preview (reliable vs absolute + z-index) --}}
@php
    $__iid = 'img_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
    $existingRaw = old($name, $value);
    $hasExisting = filled($existingRaw);
@endphp
<div class="mb-4 space-y-1">
    <label for="{{ $__iid }}_ctl" class="{{ $labelClass }}">
        {{ $label }}{!! $requiredMark !!}
    </label>
    <div class="space-y-2">
        <input
            id="{{ $__iid }}_ctl"
            name="{{ $name }}"
            type="file"
            accept="image/*"
            class="hidden"
            {{ $required }}
            {{ $attributes }}
        >
        <div
            id="{{ $__iid }}_box"
            role="button"
            tabindex="0"
            class="flex min-h-72 w-full max-w-xl cursor-pointer flex-col items-center justify-center gap-2 rounded-div border-2 border-dashed border-input-border bg-input-bg p-3 hover:bg-input-hover-bg"
            onclick="document.getElementById('{{ $__iid }}_ctl').click()"
            onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();document.getElementById('{{ $__iid }}_ctl').click();}"
            ondragover="event.preventDefault(); this.classList.add('border-secondary','bg-input-focused-bg');"
            ondragleave="event.preventDefault(); this.classList.remove('border-secondary','bg-input-focused-bg');"
            ondrop="event.preventDefault(); this.classList.remove('border-secondary','bg-input-focused-bg'); var inp=document.getElementById('{{ $__iid }}_ctl'); var f=event.dataTransfer.files; if(f&&f[0]){var d=new DataTransfer(); d.items.add(f[0]); inp.files=d.files; inp.dispatchEvent(new Event('change'));}"
        >
            <img
                id="{{ $__iid }}_preview"
                @if ($hasExisting)
                    src="{{ $existingRaw }}"
                @endif
                alt=""
                class="mx-auto block max-h-64 max-w-full object-contain"
                style="display: {{ $hasExisting ? 'block' : 'none' }};"
                onerror="this.style.display='none'; document.getElementById('{{ $__iid }}_hint').style.display='block';"
            >
            <div
                id="{{ $__iid }}_hint"
                class="text-center text-sm font-medium text-input-placeholder"
                style="display: {{ $hasExisting ? 'none' : 'block' }};"
            >
                Drag & drop or click to upload
            </div>
        </div>
    </div>
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
<script>
    (function() {
        var ctl = document.getElementById('{{ $__iid }}_ctl');
        var preview = document.getElementById('{{ $__iid }}_preview');
        var hint = document.getElementById('{{ $__iid }}_hint');
        if (!ctl || !preview || !hint) return;

        function showPreview(url) {
            if (preview.dataset.blobUrl) {
                URL.revokeObjectURL(preview.dataset.blobUrl);
                delete preview.dataset.blobUrl;
            }
            preview.onload = function() {
                preview.style.display = 'block';
                hint.style.display = 'none';
            };
            preview.onerror = function() {
                preview.style.display = 'none';
                hint.style.display = 'block';
            };
            preview.src = url;
            if (url.indexOf('blob:') === 0) {
                preview.dataset.blobUrl = url;
            }
            requestAnimationFrame(function() {
                if (preview.naturalWidth > 0) {
                    preview.style.display = 'block';
                    hint.style.display = 'none';
                }
            });
        }

        function clearPreview() {
            if (preview.dataset.blobUrl) {
                URL.revokeObjectURL(preview.dataset.blobUrl);
                delete preview.dataset.blobUrl;
            }
            preview.removeAttribute('src');
            preview.style.display = 'none';
            hint.style.display = 'block';
        }

        ctl.addEventListener('change', function() {
            if (ctl.files && ctl.files[0]) {
                showPreview(URL.createObjectURL(ctl.files[0]));
            } else {
                clearPreview();
            }
        });
    })();
</script>
