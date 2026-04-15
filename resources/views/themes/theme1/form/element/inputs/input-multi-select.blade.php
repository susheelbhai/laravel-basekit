{{-- Mirrors input-multi-select.tsx: react-select compact control, placeholder "Select…", chips in control, dropdown menu + filter (not an always-open checkbox panel). --}}
@php
    $multiVal = old($name, $value);
    $multiSelected = is_array($multiVal)
        ? array_map('strval', $multiVal)
        : ($multiVal !== null && $multiVal !== '' ? [strval($multiVal)] : []);

    $formattedOptions = [];
    foreach (($options ?? []) as $option) {
        if (is_array($option)) {
            $id = (string) ($option['id'] ?? $option['value'] ?? '');
            $title = (string) ($option['title'] ?? $option['name'] ?? $option['label'] ?? $id);
        } elseif (is_object($option)) {
            $id = (string) ($option->id ?? $option->value ?? $option);
            $title = (string) ($option->title ?? $option->name ?? $id);
        } else {
            $id = (string) $option;
            $title = (string) $option;
        }
        $formattedOptions[] = ['value' => $id, 'label' => $title];
    }

    $__msid = 'ms_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
@endphp
<div class="mb-4 space-y-1" id="{{ $__msid }}_root">
    <span id="{{ $name }}_ms_label" class="{{ $labelClass }} block">
        {{ $label }}{!! $requiredMark !!}
    </span>
    @include($__formTheme . '.form.element.inputs.partials.help-tooltip')
    <div {{ $attributes->merge(['class' => 'relative']) }}>
        <button
            type="button"
            id="{{ $__msid }}_trigger"
            class="{{ $selectBase }} !h-auto min-h-10 w-full justify-between gap-2 py-1.5 text-left data-[open=true]:border-secondary/60 data-[open=true]:ring-2 data-[open=true]:ring-secondary/25"
            aria-haspopup="listbox"
            aria-expanded="false"
            aria-labelledby="{{ $name }}_ms_label"
            data-open="false"
        >
            <span class="flex min-w-0 flex-1 flex-wrap items-center gap-1">
                <span id="{{ $__msid }}_placeholder" class="text-input-placeholder">Select…</span>
                <span id="{{ $__msid }}_pills" class="contents"></span>
            </span>
            <svg
                id="{{ $__msid }}_chevron"
                class="h-4 w-4 shrink-0 text-muted-foreground transition-transform data-[open=true]:rotate-180"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
                data-open="false"
            >
                <path d="M6 9l6 6 6-6" />
            </svg>
        </button>

        <div
            id="{{ $__msid }}_menu"
            class="hidden overflow-hidden rounded-div border border-input-border bg-input-bg shadow-lg"
            role="listbox"
            aria-multiselectable="true"
            aria-labelledby="{{ $name }}_ms_label"
        >
            <div class="border-b border-input-border p-2">
                <input
                    type="search"
                    id="{{ $__msid }}_filter"
                    class="{{ $inputBase }} w-full border-input-border"
                    placeholder="Search..."
                    autocomplete="off"
                    aria-label="Filter options"
                >
            </div>
            <div id="{{ $__msid }}_options" class="max-h-52 overflow-y-auto p-1">
                @foreach ($formattedOptions as $opt)
                    <button
                        type="button"
                        role="option"
                        class="ms-opt flex w-full rounded-div px-2 py-1.5 text-left text-sm text-input-text hover:bg-accent hover:text-accent-foreground"
                        data-value="{{ $opt['value'] }}"
                        data-label="{{ e($opt['label']) }}"
                        data-filter="{{ e(mb_strtolower($opt['label'], 'UTF-8')) }}"
                    >
                        {{ $opt['label'] }}
                    </button>
                @endforeach
            </div>
        </div>

        <div id="{{ $__msid }}_hiddens" class="hidden" aria-hidden="true"></div>
    </div>
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
<script>
    (function () {
        var root = document.getElementById('{{ $__msid }}_root');
        if (!root) return;
        if (root.dataset.msInit === '1') return;
        var trigger = document.getElementById('{{ $__msid }}_trigger');
        var menu = document.getElementById('{{ $__msid }}_menu');
        var filter = document.getElementById('{{ $__msid }}_filter');
        var optionsEl = document.getElementById('{{ $__msid }}_options');
        var hiddens = document.getElementById('{{ $__msid }}_hiddens');
        var placeholder = document.getElementById('{{ $__msid }}_placeholder');
        var pills = document.getElementById('{{ $__msid }}_pills');
        var chevron = document.getElementById('{{ $__msid }}_chevron');
        if (!trigger || !menu || !filter || !optionsEl || !hiddens || !placeholder || !pills || !chevron) return;
        root.dataset.msInit = '1';
        var menuContainer = trigger.parentNode;
        var menuInsertBefore = hiddens;

        var options = @json($formattedOptions);
        var initialIds = @json($multiSelected);
        var selected = [];
        initialIds.forEach(function (id) {
            var idStr = String(id);
            for (var i = 0; i < options.length; i++) {
                if (options[i].value === idStr) {
                    selected.push({ value: options[i].value, label: options[i].label });
                    break;
                }
            }
        });

        function isOpen() {
            return trigger.getAttribute('data-open') === 'true';
        }

        function positionMenu() {
            var r = trigger.getBoundingClientRect();
            menu.style.position = 'fixed';
            menu.style.left = r.left + 'px';
            menu.style.top = r.bottom + 4 + 'px';
            menu.style.width = r.width + 'px';
            menu.style.right = 'auto';
            menu.style.marginTop = '0';
            menu.style.zIndex = '9999';
            var searchBox = menu.firstElementChild;
            var searchH = searchBox ? searchBox.offsetHeight : 40;
            var spaceBelow = window.innerHeight - r.bottom - 8 - searchH - 8;
            var cap = 208;
            optionsEl.style.maxHeight = Math.max(120, Math.min(cap, spaceBelow)) + 'px';
        }

        function onScrollOrResize() {
            if (isOpen()) positionMenu();
        }

        function setOpen(open) {
            trigger.setAttribute('data-open', open ? 'true' : 'false');
            trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
            chevron.setAttribute('data-open', open ? 'true' : 'false');
            if (open) {
                menu.classList.remove('hidden');
                document.body.appendChild(menu);
                positionMenu();
                window.addEventListener('scroll', onScrollOrResize, true);
                window.addEventListener('resize', onScrollOrResize);
                filter.value = '';
                updateListVisibility();
                setTimeout(function () {
                    filter.focus();
                }, 0);
            } else {
                window.removeEventListener('scroll', onScrollOrResize, true);
                window.removeEventListener('resize', onScrollOrResize);
                menu.classList.add('hidden');
                menu.style.cssText = '';
                optionsEl.style.maxHeight = '';
                if (menu.parentNode === document.body) {
                    menuContainer.insertBefore(menu, menuInsertBefore);
                }
            }
        }

        function renderHiddens() {
            hiddens.innerHTML = '';
            selected.forEach(function (s) {
                var inp = document.createElement('input');
                inp.type = 'hidden';
                inp.name = '{{ $name }}[]';
                inp.value = s.value;
                hiddens.appendChild(inp);
            });
        }

        function syncOptionRows() {
            var selVals = {};
            selected.forEach(function (s) {
                selVals[s.value] = true;
            });
            optionsEl.querySelectorAll('.ms-opt').forEach(function (btn) {
                var v = btn.getAttribute('data-value');
                var on = !!selVals[v];
                btn.setAttribute('aria-selected', on ? 'true' : 'false');
                btn.classList.toggle('bg-accent', on);
                btn.classList.toggle('text-accent-foreground', on);
            });
        }

        function renderPills() {
            pills.innerHTML = '';
            if (selected.length === 0) {
                placeholder.classList.remove('hidden');
            } else {
                placeholder.classList.add('hidden');
                selected.forEach(function (s) {
                    var pill = document.createElement('span');
                    pill.className =
                        'inline-flex max-w-full items-center gap-0.5 rounded bg-primary/10 px-2 py-0.5 text-xs text-primary';
                    var t = document.createElement('span');
                    t.className = 'truncate';
                    t.appendChild(document.createTextNode(s.label));
                    pill.appendChild(t);
                    var rm = document.createElement('button');
                    rm.type = 'button';
                    rm.className = 'shrink-0 rounded px-0.5 hover:bg-primary/20';
                    rm.setAttribute('aria-label', 'Remove ' + s.label);
                    rm.appendChild(document.createTextNode('×'));
                    (function (val) {
                        rm.addEventListener('click', function (e) {
                            e.stopPropagation();
                            selected = selected.filter(function (x) {
                                return x.value !== val;
                            });
                            renderPills();
                            renderHiddens();
                            syncOptionRows();
                            updateListVisibility();
                        });
                    })(s.value);
                    pill.appendChild(rm);
                    pills.appendChild(pill);
                });
            }
        }

        function updateListVisibility() {
            var q = filter.value.trim().toLowerCase();
            var selVals = {};
            selected.forEach(function (s) {
                selVals[s.value] = true;
            });
            optionsEl.querySelectorAll('.ms-opt').forEach(function (btn) {
                var v = btn.getAttribute('data-value');
                var hay = (btn.getAttribute('data-filter') || '').toLowerCase();
                var matchesSearch = q === '' || hay.indexOf(q) !== -1;
                var stillAvailable = !selVals[v];
                btn.classList.toggle('hidden', !stillAvailable || !matchesSearch);
            });
        }

        trigger.addEventListener('click', function () {
            setOpen(!isOpen());
        });

        filter.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        filter.addEventListener('input', updateListVisibility);

        optionsEl.querySelectorAll('.ms-opt').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                var v = btn.getAttribute('data-value');
                var lbl = btn.getAttribute('data-label') || '';
                var already = false;
                for (var i = 0; i < selected.length; i++) {
                    if (selected[i].value === v) {
                        already = true;
                        break;
                    }
                }
                if (already) return;
                selected.push({ value: v, label: lbl });
                renderPills();
                renderHiddens();
                syncOptionRows();
                setOpen(false);
                trigger.focus();
            });
        });

        document.addEventListener(
            'mousedown',
            function (e) {
                if (!isOpen()) return;
                var t = e.target;
                if (root.contains(t) || menu.contains(t)) return;
                setOpen(false);
            },
            true
        );

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && isOpen()) {
                setOpen(false);
                trigger.focus();
            }
        });

        renderPills();
        renderHiddens();
        syncOptionRows();
        updateListVisibility();
    })();
</script>
