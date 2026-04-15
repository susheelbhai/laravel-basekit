@php
    $headerUser = include resource_path('data/php/header_user.php');
    $menuItems = $headerUser['menuItems'];
    $profileItems = $headerUser['profileItems'];
    $loginRoute = $headerUser['loginRoute'];
@endphp

@foreach ($menuItems as $item)
    <x-layout.header.li1 :href="route($item['routeName'])" :name="$item['name']" />
@endforeach

@auth('web')
    <x-layout.header.li2 name="{{ auth()->user()->name }}">
        @foreach ($profileItems as $item)
            @if (($item['method'] ?? 'get') === 'post')
                <form action="{{ route($item['routeName']) }}" method="post" class="block w-full">
                    @csrf
                    <button
                        type="submit"
                        class="w-full rounded-full px-3 py-2 text-left text-sm transition-colors hover:bg-muted hover:text-primary"
                    >
                        {{ $item['name'] }}
                    </button>
                </form>
            @else
                <x-layout.header.li1 :href="route($item['routeName'])" :name="$item['name']" />
            @endif
        @endforeach
    </x-layout.header.li2>
@else
    <x-layout.header.li1 :href="route($loginRoute)" name="Login" />
@endauth
