<li>
    <a
        href="{{ $href }}"
        data-slot="sidebar-menu-button"
        data-sidebar="menu-button"
        data-size="default"
        data-active="{{ $active ? 'true' : 'false' }}"
        @if($active) aria-current="page" @endif
        class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-div p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 aria-disabled:pointer-events-none aria-disabled:opacity-50 data-[active=true]:bg-sidebar-accent data-[active=true]:font-medium data-[active=true]:text-sidebar-accent-foreground group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
    >
        @if(!empty($icon))
            <i class="{{ $icon }} text-base leading-none"></i>
        @endif
        <span>{{ $name }}</span>
    </a>
</li>
