
<a href="{{ $href }}" class="flex items-center gap-2 rounded-input px-2 py-2 text-sm text-muted-foreground hover:bg-muted hover:text-foreground">
    @if(!empty($icon))
        <span class="text-muted-foreground">{{ $icon }}</span>
    @endif
    <span>{{ $name }}</span>
</a>