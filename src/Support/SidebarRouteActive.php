<?php

namespace App\Support;

/**
 * Mirrors resources/js/components/navigation/nav-main.tsx route matching for Blade sidebars.
 */
final class SidebarRouteActive
{
    /**
     * Collect named routes from menu nodes, recursing into nested `children`
     * (same shape as TSX NavItem trees, e.g. Layouts → Footer → links).
     *
     * @param  array<int, array<string, mixed>>  $nodes
     * @return list<string>
     */
    public static function collectRouteNamesFromNodes(array $nodes): array
    {
        $routes = [];
        foreach ($nodes as $node) {
            if (! empty($node['route']) && is_string($node['route'])) {
                $routes[] = $node['route'];
            }
            if (! empty($node['children']) && is_array($node['children'])) {
                foreach (self::collectRouteNamesFromNodes($node['children']) as $nested) {
                    $routes[] = $nested;
                }
            }
        }

        return $routes;
    }

    /**
     * @param  list<string>  $routeNames
     */
    public static function groupUsesExactOnly(array $routeNames): bool
    {
        foreach ($routeNames as $r) {
            if (! str_ends_with($r, '.index')) {
                continue;
            }
            $prefix = substr($r, 0, -strlen('.index'));
            foreach ($routeNames as $other) {
                if ($other === $r) {
                    continue;
                }
                if (str_starts_with($other, $prefix.'.')) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function matches(?string $routeName, bool $exactOnly = false): bool
    {
        if ($routeName === null || $routeName === '' || ! request()->route()) {
            return false;
        }

        if (request()->routeIs($routeName)) {
            return true;
        }

        if ($exactOnly) {
            return false;
        }

        if (str_ends_with($routeName, '.index')) {
            $prefix = substr($routeName, 0, -strlen('.index'));

            return request()->routeIs($prefix.'.*');
        }

        return false;
    }
}
