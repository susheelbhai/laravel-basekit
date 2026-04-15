@php
    $col_class = '';
    switch ($div) {
        case 1:
            $col_class = 'col-span-12';
            break;
        case 2:
            $col_class = 'col-span-6';
            break;
        case 3:
            $col_class = 'col-span-4';
            break;
        case 4:
            $col_class = 'col-span-3';
            break;
        case 6:
            $col_class = 'col-span-2';
            break;
        case 12:
            $col_class = 'col-span-1';
            break;
        default:
            $col_class = 'col-span-6';
    }

    $resolved = $type === 'multi_img' ? 'multi_img' : 'single';

    $labelClass = 'text-sm leading-none font-medium text-foreground select-none';
    $requiredMark = $required == 'required'
        ? '<span class="text-xl font-bold text-red-500">*</span>'
        : '';

    $__iid = 'img_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
    $existingRaw = old($name, $value ?? '');
    $hasExisting = filled($existingRaw);
@endphp

<div class="{{ $col_class }} mb-4 space-y-1">
    @if ($resolved === 'single')
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
    @else
        <label for="{{ $__iid }}_ctl" class="{{ $labelClass }}">{{ $label }}{!! $requiredMark !!}</label>
        <input
            id="{{ $__iid }}_ctl"
            name="{{ $name }}"
            type="file"
            accept="image/*"
            multiple
            class="hidden"
            {{ $required }}
        >
        <div
            role="button"
            tabindex="0"
            onclick="document.getElementById('{{ $__iid }}_ctl').click()"
            onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();document.getElementById('{{ $__iid }}_ctl').click();}"
            ondragover="event.preventDefault(); this.classList.add('border-secondary','bg-input-focused-bg');"
            ondragleave="event.preventDefault(); this.classList.remove('border-secondary','bg-input-focused-bg');"
            ondrop="event.preventDefault(); this.classList.remove('border-secondary','bg-input-focused-bg'); var inp=document.getElementById('{{ $__iid }}_ctl'); var src=event.dataTransfer.files; if(src&&src.length){var d=new DataTransfer(); for(var i=0;i<src.length;i++){d.items.add(src[i]);} inp.files=d.files; inp.dispatchEvent(new Event('change'));}"
            class="relative flex h-32 w-full max-w-2xl cursor-pointer items-center justify-center overflow-hidden rounded-div border-2 border-dashed border-input-border bg-input-bg transition-colors hover:bg-input-hover-bg"
        >
            <div class="text-center text-input-placeholder">
                <p class="text-sm font-medium">Click or drag to upload multiple images</p>
            </div>
        </div>
        <div id="{{ $__iid }}_grid" class="mt-2 grid max-h-60 gap-2 overflow-y-auto" style="grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));"></div>
        <script>
            (function() {
                var ctl = document.getElementById('{{ $__iid }}_ctl');
                var grid = document.getElementById('{{ $__iid }}_grid');
                if (!ctl || !grid) return;
                ctl.addEventListener('change', function() {
                    grid.innerHTML = '';
                    if (!ctl.files || !ctl.files.length) return;
                    for (var i = 0; i < ctl.files.length; i++) {
                        (function(file) {
                            var r = new FileReader();
                            r.onload = function(e) {
                                var wrap = document.createElement('div');
                                wrap.className = 'relative overflow-hidden rounded-div border border-input-border';
                                wrap.style.height = '100px';
                                var img = document.createElement('img');
                                img.src = e.target.result;
                                img.className = 'h-full w-full object-cover';
                                img.alt = '';
                                wrap.appendChild(img);
                                grid.appendChild(wrap);
                            };
                            r.readAsDataURL(file);
                        })(ctl.files[i]);
                    }
                });
            })();
        </script>
    @endif

    @error($name)
        <x-form.validation-error :value="$message" />
    @enderror
</div>
