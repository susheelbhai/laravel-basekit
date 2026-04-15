<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title> Dashboard | {{ config('app.name') }}</title>
    </x-slot>

    <div class="flex h-full flex-1 flex-col gap-4 rounded-div p-4">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-div border border-sidebar-border/70 dark:border-sidebar-border">
                <div class="absolute inset-0 bg-[linear-gradient(45deg,transparent_25%,hsl(var(--border))_25%,hsl(var(--border))_50%,transparent_50%,transparent_75%,hsl(var(--border))_75%,hsl(var(--border)))] opacity-30 [background-size:24px_24px]"></div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-div border border-sidebar-border/70 dark:border-sidebar-border">
                <div class="absolute inset-0 bg-[linear-gradient(45deg,transparent_25%,hsl(var(--border))_25%,hsl(var(--border))_50%,transparent_50%,transparent_75%,hsl(var(--border))_75%,hsl(var(--border)))] opacity-30 [background-size:24px_24px]"></div>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-div border border-sidebar-border/70 dark:border-sidebar-border">
                <div class="absolute inset-0 bg-[linear-gradient(45deg,transparent_25%,hsl(var(--border))_25%,hsl(var(--border))_50%,transparent_50%,transparent_75%,hsl(var(--border))_75%,hsl(var(--border)))] opacity-30 [background-size:24px_24px]"></div>
            </div>
        </div>
        <div class="relative min-h-[100vh] flex-1 overflow-hidden rounded-div border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
            <div class="absolute inset-0 bg-[linear-gradient(45deg,transparent_25%,hsl(var(--border))_25%,hsl(var(--border))_50%,transparent_50%,transparent_75%,hsl(var(--border))_75%,hsl(var(--border)))] opacity-30 [background-size:24px_24px]"></div>
        </div>
    </div>
</x-layout.admin.app>
