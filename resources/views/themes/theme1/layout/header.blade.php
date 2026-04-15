<div class="flex w-full items-center justify-between space-x-2">
    <div class="flex items-center gap-2">
        <button
            id="starter-kit-sidebar-trigger"
            type="button"
            class="-ml-1 inline-flex h-7 w-7 cursor-pointer items-center justify-center rounded-div text-muted-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-sidebar-ring"
            aria-label="Toggle sidebar"
        >
            <svg viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
            </svg>
            <span class="sr-only">Toggle Sidebar</span>
        </button>

        {{-- Breadcrumbs placeholder (TSX uses <Breadcrumbs /> here) --}}
        <nav class="text-sm text-muted-foreground">
            <span>{{ $page_name ?? 'Dashboard' }}</span>
        </nav>
    </div>

    <div class="flex items-center gap-4">
        @php
            /** @var \App\Models\Admin|null $adminUser */
            $adminUser = \Illuminate\Support\Facades\Auth::guard('admin')->user();
            $unreadCount = $adminUser ? $adminUser->unreadNotifications()->count() : 0;
            $unreadNotifications = $adminUser ? $adminUser->unreadNotifications()->take(5)->get() : collect();
        @endphp

        {{-- Notifications (match TSX NotificationIcon + NotificationBox) --}}
        <div class="relative" id="starter-kit-notifications">
            <button
                type="button"
                class="relative flex h-8 w-8 cursor-pointer items-center justify-center rounded-full focus:outline-none hover:bg-background2"
                aria-label="Notifications"
                onclick="(function(){
                    var box = document.getElementById('starter-kit-notifications-box');
                    if (!box) return;
                    box.classList.toggle('hidden');
                })()"
            >
                <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a3.001 3.001 0 01-5.714 0M6.5 8.25a5.25 5.25 0 1111 0c0 1.172.26 2.318.764 3.338.37.76.736 1.53.736 2.162 0 1.386-1.014 2.25-2.25 2.25H7.25c-1.236 0-2.25-.864-2.25-2.25 0-.632.366-1.402.736-2.162A8.96 8.96 0 006.5 8.25z" />
                </svg>
                @if($unreadCount > 0)
                    <span class="absolute -top-1 -right-1 min-w-[1.25rem] rounded-full bg-red-500 px-1.5 text-center text-xs font-bold text-white">
                        {{ $unreadCount }}
                    </span>
                @endif
            </button>

            <div id="starter-kit-notifications-box" class="absolute right-0 z-50 mt-2 hidden w-80 rounded-div border border-border bg-card shadow-lg">
                <div class="border-b p-4 font-semibold text-card-foreground">Unread Notifications</div>
                <ul class="max-h-72 divide-y divide-border overflow-y-auto">
                    @if($unreadNotifications->isEmpty())
                        <li class="p-4 text-center text-sm text-muted-foreground">No unread notifications</li>
                    @else
                        @foreach($unreadNotifications as $n)
                            @php
                                $title = data_get($n, 'data.title', 'Notification');
                                $message = data_get($n, 'data.data.message', '');
                                $href = route('admin.notification.show', $n->id);
                                $createdAt = $n->created_at ? $n->created_at->toDateTimeString() : '';
                            @endphp
                            <li class="cursor-pointer p-4 text-sm hover:bg-muted">
                                <a href="{{ $href }}" class="block cursor-pointer">
                                    <div class="font-medium text-card-foreground">{{ $title }}</div>
                                    <div class="text-muted-foreground">{{ $message }}</div>
                                    <div class="mt-1 text-xs text-muted-foreground">{{ $createdAt }}</div>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
                <div class="flex justify-center border-t p-2">
                    <a href="{{ route('admin.notification.index') }}" class="cursor-pointer text-sm font-medium text-primary hover:underline">
                        See all notifications
                    </a>
                </div>
            </div>
        </div>

        @include('components.starter-kit-appearance-toggle')

        @once
            <script>
                (function () {
                    document.addEventListener('mousedown', function (e) {
                        var wrap = document.getElementById('starter-kit-notifications');
                        var box = document.getElementById('starter-kit-notifications-box');
                        if (!wrap || !box) return;
                        if (!wrap.contains(e.target)) box.classList.add('hidden');
                    });
                })();
            </script>
        @endonce
    </div>
</div>