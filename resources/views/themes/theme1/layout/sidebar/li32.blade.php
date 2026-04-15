<li class="relative group/menu-item">
    <details class="group" @if($open) open @endif>
        <summary
            data-slot="sidebar-menu-button"
            data-sidebar="menu-button"
            data-size="default"
            data-active="{{ $active ? 'true' : 'false' }}"
            class="peer/menu-button flex w-full cursor-pointer list-none items-center justify-between gap-2 overflow-hidden rounded-div p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 focus-visible:ring-sidebar-ring focus-visible:ring-offset-1 focus-visible:ring-offset-sidebar active:bg-sidebar-accent active:text-sidebar-accent-foreground data-[active=true]:bg-sidebar-accent data-[active=true]:font-medium data-[active=true]:text-sidebar-accent-foreground data-[active=true]:hover:bg-sidebar-accent data-[active=true]:hover:text-sidebar-accent-foreground group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! group-data-[collapsible=icon]:justify-center"
        >
            <span class="flex min-w-0 flex-1 items-center gap-2 overflow-hidden group-data-[collapsible=icon]:justify-center">
                @if(!empty($icon))
                    <i class="{{ $icon }} text-base leading-none shrink-0"></i>
                @endif
                <span class="truncate group-data-[collapsible=icon]:hidden">{{ $name }}</span>
            </span>
            <span class="ms-auto flex shrink-0 text-sidebar-foreground group-data-[collapsible=icon]:hidden" aria-hidden="true">
                <svg class="size-4 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
        </summary>

        <ul data-slot="sidebar-menu-sub" data-sidebar="menu-sub" class="border-sidebar-border mx-0 mt-0.5 flex min-w-0 translate-x-px flex-col gap-1 border-l border-sidebar-border pl-2.5 py-0.5 group-data-[collapsible=icon]:hidden">
            {{ $slot }}
        </ul>

        <div
            class="pointer-events-none hidden min-w-56 overflow-hidden rounded-div border border-border bg-card text-card-foreground shadow-lg group-data-[collapsible=icon]/sidebar:group-open:pointer-events-auto group-data-[collapsible=icon]/sidebar:group-open:absolute group-data-[collapsible=icon]/sidebar:group-open:left-full group-data-[collapsible=icon]/sidebar:group-open:top-0 group-data-[collapsible=icon]/sidebar:group-open:z-[60] group-data-[collapsible=icon]/sidebar:group-open:ml-2 group-data-[collapsible=icon]/sidebar:group-open:block"
        >
            <div class="border-b border-border p-3 text-sm font-medium">{{ $name }}</div>
            <ul class="max-h-[min(70vh,24rem)] overflow-y-auto p-2">
                {{ $slot }}
            </ul>
        </div>
    </details>
</li>
