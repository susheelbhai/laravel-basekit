@php
    $adminSidebar = include resource_path('data/php/admin_sidebar.php');
    $sidebarMenu = is_array($adminSidebar) ? ($adminSidebar['sidebarMenu'] ?? []) : [];
@endphp

@foreach($sidebarMenu as $group)
    <x-layout.sidebar.group :icon="$group['icon']" :name="$group['group']">
        @foreach($group['items'] as $item)

            @php
                $hasChildren = !empty($item['children']);
                $hasSubGroups = !empty($item['sub_groups']);
            @endphp

            @if(!$hasChildren && !$hasSubGroups)
                {{-- No children? It's a top-level link --}}
                <x-layout.sidebar.li1
                    :icon="$item['icon']"
                    :href="route($item['route'])"
                    :name="$item['name']"
                    :active="\App\Support\SidebarRouteActive::matches($item['route'])"
                />
            @else
                @php
                    $routesInBranch = [];
                    if ($hasChildren) {
                        $routesInBranch = \App\Support\SidebarRouteActive::collectRouteNamesFromNodes($item['children']);
                    }
                    if ($hasSubGroups) {
                        foreach ($item['sub_groups'] as $sub) {
                            foreach ($sub['children'] ?? [] as $sc) {
                                if (!empty($sc['route']) && is_string($sc['route'])) {
                                    $routesInBranch[] = $sc['route'];
                                }
                            }
                        }
                    }
                    $li2ExactOnly = \App\Support\SidebarRouteActive::groupUsesExactOnly($routesInBranch);
                    $li2BranchActive = false;
                    foreach ($routesInBranch as $r) {
                        if (\App\Support\SidebarRouteActive::matches($r, $li2ExactOnly)) {
                            $li2BranchActive = true;
                            break;
                        }
                    }
                @endphp

                {{-- Has children or sub-groups? It's a dropdown --}}
                <x-layout.sidebar.li2
                    :icon="$item['icon']"
                    :name="$item['name']"
                    :open="$li2BranchActive"
                    :active="$li2BranchActive"
                >

                    {{-- Standard children (recursive nested `children`, same idea as TSX NavMain) --}}
                    @if($hasChildren)
                        @foreach($item['children'] as $child)
                            @include('partials.sidebar-menu-node', ['child' => $child, 'exactOnly' => $li2ExactOnly])
                        @endforeach
                    @endif

                    @if($hasSubGroups)
                        @foreach($item['sub_groups'] as $sub)
                            @php
                                $subRoutes = array_values(array_filter(
                                    array_column($sub['children'] ?? [], 'route'),
                                    fn ($r) => is_string($r) && $r !== ''
                                ));
                                $subExactOnly = \App\Support\SidebarRouteActive::groupUsesExactOnly($subRoutes);
                                $sub32Active = false;
                                foreach ($subRoutes as $r) {
                                    if (\App\Support\SidebarRouteActive::matches($r, $subExactOnly)) {
                                        $sub32Active = true;
                                        break;
                                    }
                                }
                            @endphp
                            <x-layout.sidebar.li32
                                :name="$sub['name']"
                                :icon="$sub['icon'] ?? ''"
                                :open="$sub32Active"
                                :active="$sub32Active"
                            >
                                @foreach($sub['children'] as $subChild)
                                    <x-layout.sidebar.li21
                                        :href="route($subChild['route'])"
                                        :name="$subChild['name']"
                                        :icon="$subChild['icon'] ?? ''"
                                        :active="\App\Support\SidebarRouteActive::matches($subChild['route'], $subExactOnly)"
                                    />
                                @endforeach
                            </x-layout.sidebar.li32>
                        @endforeach
                    @endif

                </x-layout.sidebar.li2>
            @endif

        @endforeach
    </x-layout.sidebar.group>
@endforeach
