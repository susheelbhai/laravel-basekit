@props([
    'images' => [],
    'title' => '',
])

@php
    $displayImages = collect($images)
        ->map(fn ($img) => [
            'url' => data_get($img, 'url', ''),
            'thumbnail' => data_get($img, 'thumbnail', data_get($img, 'url', '')),
        ])
        ->filter(fn ($img) => filled($img['url']))
        ->values();
@endphp

@if ($displayImages->count() > 0)
    <div
        class="flex items-start gap-4"
        x-data="{
            i: 0,
            images: {{ Illuminate\Support\Js::from($displayImages) }},
            isDragging: false,
            startX: 0,
            dragOffset: 0,
            thumbMaxStyle: '',
            syncThumbMaxHeight() {
                const el = this.$refs.mainSlide;
                if (!el) {
                    this.thumbMaxStyle = '';
                    return;
                }
                this.thumbMaxStyle = 'max-height: ' + el.offsetHeight + 'px';
            },
            initThumbScroll() {
                this.$nextTick(() => {
                    this.syncThumbMaxHeight();
                    const el = this.$refs.mainSlide;
                    if (!el || typeof ResizeObserver === 'undefined') {
                        return;
                    }
                    new ResizeObserver(() => this.syncThumbMaxHeight()).observe(el);
                });
            },
            next() { this.i = this.i >= this.images.length - 1 ? 0 : this.i + 1 },
            prev() { this.i = this.i <= 0 ? this.images.length - 1 : this.i - 1 },
            goTo(idx) { this.i = idx },
            dragStart(e) {
                this.isDragging = true;
                this.dragOffset = 0;
                this.startX = e.touches ? e.touches[0].clientX : e.clientX;
            },
            dragMove(e) {
                if (!this.isDragging) return;
                const x = e.touches ? e.touches[0].clientX : e.clientX;
                this.dragOffset = x - this.startX;
            },
            dragEnd() {
                if (!this.isDragging) return;
                this.isDragging = false;
                const threshold = 50;
                if (this.dragOffset < -threshold) this.next();
                else if (this.dragOffset > threshold) this.prev();
                this.dragOffset = 0;
            },
        }"
        x-init="initThumbScroll()"
    >
        @if ($displayImages->count() > 1)
            <div
                class="scrollbar-none flex min-h-0 w-20 shrink-0 flex-col gap-2 overflow-y-auto overflow-x-hidden overscroll-y-contain p-3"
                x-bind:style="thumbMaxStyle"
            >
                @foreach ($displayImages as $idx => $img)
                    <button
                        type="button"
                        class="relative flex-shrink-0 overflow-hidden rounded-div transition-all opacity-60 hover:opacity-100"
                        x-bind:class="{{ (int) $idx }} === i ? 'ring-2 ring-primary ring-offset-2 opacity-100' : 'opacity-60 hover:opacity-100'"
                        @click="goTo({{ (int) $idx }})"
                        aria-label="Go to image {{ (int) $idx + 1 }}"
                    >
                        <img
                            src="{{ data_get($img, 'thumbnail', data_get($img, 'url', '')) }}"
                            alt=""
                            class="h-20 w-20 object-cover"
                            loading="lazy"
                        />
                    </button>
                @endforeach
            </div>
        @endif

        <div
            x-ref="mainSlide"
            class="relative min-w-0 flex-1 aspect-square select-none overflow-hidden rounded-div bg-muted shadow-lg cursor-grab active:cursor-grabbing"
            @mousedown.prevent="dragStart($event)"
            @mousemove.prevent="dragMove($event)"
            @mouseup="dragEnd()"
            @mouseleave="dragEnd()"
            @touchstart.prevent="dragStart($event)"
            @touchmove.prevent="dragMove($event)"
            @touchend="dragEnd()"
        >
            <div
                class="flex h-full"
                x-bind:class="isDragging ? '' : 'transition-transform duration-500 ease-out'"
                x-bind:style="`transform: translateX(calc(-${i * 100}% + ${dragOffset}px));`"
            >
                @foreach ($displayImages as $idx => $img)
                    <div class="flex h-full w-full flex-shrink-0 items-center justify-center bg-muted">
                        <img
                            src="{{ data_get($img, 'url', '') }}"
                            alt="{{ $title }} - Image {{ (int) $idx + 1 }}"
                            class="h-full w-full object-contain pointer-events-none"
                            loading="{{ (int) $idx === 0 ? 'eager' : 'lazy' }}"
                            draggable="false"
                        />
                    </div>
                @endforeach
            </div>

            @if ($displayImages->count() > 1)
                <button
                    type="button"
                    class="absolute left-2 top-1/2 -translate-y-1/2 rounded-full bg-black/50 p-2 text-white transition-all hover:bg-black/70 focus:outline-none focus:ring-2 focus:ring-white"
                    aria-label="Previous image"
                    @click="prev()"
                >
                    <span class="sr-only">Previous</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
                </button>
                <button
                    type="button"
                    class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-black/50 p-2 text-white transition-all hover:bg-black/70 focus:outline-none focus:ring-2 focus:ring-white"
                    aria-label="Next image"
                    @click="next()"
                >
                    <span class="sr-only">Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                </button>

                <div class="absolute bottom-4 right-4 rounded-full bg-black/60 px-3 py-1 text-sm text-white">
                    <span x-text="`${i + 1} / ${images.length}`"></span>
                </div>
            @endif
        </div>
    </div>
@endif
