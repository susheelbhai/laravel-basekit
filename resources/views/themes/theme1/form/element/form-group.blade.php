<div {{ $attributes->merge(['class' => 'col-span-12']) }}>
    <div class="rounded-div border border-border bg-card px-4 py-4">
        <h3 class="mb-4 text-base font-medium">{{ $title }}</h3>
        <div class="grid grid-cols-12 gap-4">
            {{ $slot }}
        </div>
    </div>
</div>