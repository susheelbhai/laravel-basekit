<li>
    <a
        href="{{ $href }}"
        data-slot="sidebar-menu-sub-button"
        data-sidebar="menu-sub-button"
        data-size="md"
        data-active="{{ $active ? 'true' : 'false' }}"
        @if($active) aria-current="page" @endif
        class="text-sidebar-foreground ring-sidebar-ring hover:bg-sidebar-accent hover:text-sidebar-accent-foreground active:bg-sidebar-accent active:text-sidebar-accent-foreground data-[active=true]:bg-sidebar-accent data-[active=true]:font-medium data-[active=true]:text-sidebar-accent-foreground flex h-7 min-w-0 -translate-x-px items-center gap-2 overflow-hidden rounded-div px-2 text-sm outline-hidden focus-visible:ring-2 focus-visible:ring-sidebar-ring [&>svg]:size-4 [&>svg]:shrink-0 [&>span:last-child]:truncate"
    >
        @if(!empty($icon))
            <i class="{{ $icon }} shrink-0 text-base leading-none"></i>
        @endif
        <span class="min-w-0 truncate">{{ $name }}</span>
    </a>
</li>
