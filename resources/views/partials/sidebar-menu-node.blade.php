{{-- Recursive node: flat link (li21) or folder (li32) with deeper children — mirrors TSX NavItem nesting. --}}
@php
    /** @var array<string, mixed> $child */
    /** @var bool $exactOnly */
@endphp
@if(empty($child['children']))
    <x-layout.sidebar.li21
        :href="route($child['route'])"
        :name="$child['name']"
        :icon="$child['icon'] ?? ''"
        :active="\App\Support\SidebarRouteActive::matches($child['route'], $exactOnly)"
    />
@else
    @php
        $nestedRoutes = \App\Support\SidebarRouteActive::collectRouteNamesFromNodes($child['children']);
        $nestedExactOnly = \App\Support\SidebarRouteActive::groupUsesExactOnly($nestedRoutes);
        $nestedOpen = false;
        foreach ($nestedRoutes as $r) {
            if (\App\Support\SidebarRouteActive::matches($r, $nestedExactOnly)) {
                $nestedOpen = true;
                break;
            }
        }
    @endphp
    <x-layout.sidebar.li32 :name="$child['name']" :icon="$child['icon'] ?? ''" :open="$nestedOpen" :active="$nestedOpen">
        @foreach($child['children'] as $subChild)
            {{-- Intentional self-include: one level per child until a row has no `children` (then li21 above). --}}
            @include('partials.sidebar-menu-node', ['child' => $subChild, 'exactOnly' => $nestedExactOnly])
        @endforeach
    </x-layout.sidebar.li32>
@endif
