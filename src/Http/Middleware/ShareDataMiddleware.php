<?php

namespace App\Http\Middleware;

use App\Models\ImportantLink;
use App\Models\PageContact;
use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class ShareDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $renderType = (string) config('app.render_type', 'blade');

        if ($renderType === 'inertia') {
            Inertia::share([
                'auth' => function () {
                    /** @var \App\Models\User|null $user */
                    $user = Auth::user();
                    $unreadNotifications = $user
                        ? $user->unreadNotifications()->take(10)->get()->map(fn ($n) => $n->toArray())
                        : [];

                    return [
                        'user' => $user,
                        'dashboard_url' => route('dashboard'),
                        'unread_notifications_count' => count($unreadNotifications),
                        'unread_notifications' => $unreadNotifications,
                    ];
                },
                'admin' => function () {
                    /** @var \App\Models\Admin|null $user */
                    $user = Auth::guard('admin')->user();
                    $unreadNotifications = $user
                        ? $user->unreadNotifications()->take(10)->get()->map(fn ($n) => $n->toArray())
                        : [];

                    return [
                        'user' => $user,
                        'permissions' => $user?->getAllPermissions()->pluck('name'),
                        'dashboard_url' => route('admin.dashboard'),
                        'unread_notifications_count' => count($unreadNotifications),
                        'unread_notifications' => $unreadNotifications,
                    ];
                },
                'partner' => function () {
                    /** @var \App\Models\Partner|null $user */
                    $user = Auth::guard('partner')->user();
                    $unreadNotifications = $user
                        ? $user->unreadNotifications()->take(10)->get()->map(fn ($n) => $n->toArray())
                        : [];

                    return [
                        'user' => $user,
                        'permissions' => $user?->getAllPermissions()->pluck('name'),
                        'dashboard_url' => route('partner.dashboard'),
                        'unread_notifications_count' => count($unreadNotifications),
                        'unread_notifications' => $unreadNotifications,
                    ];
                },
                'seller' => function () {
                    /** @var \App\Models\Seller|null $user */
                    $user = Auth::guard('seller')->user();
                    $unreadNotifications = $user
                        ? $user->unreadNotifications()->take(10)->get()->map(fn ($n) => $n->toArray())
                        : [];

                    return [
                        'user' => $user,
                        'permissions' => $user?->getAllPermissions()->pluck('name'),
                        'dashboard_url' => route('seller.dashboard'),
                        'unread_notifications_count' => count($unreadNotifications),
                        'unread_notifications' => $unreadNotifications,
                    ];
                },
            ]);
        }

        $settings = Setting::find(1);
        $pageContact = PageContact::find(1);
        $importantLinks = ImportantLink::whereIsActive(1)->latest()->get();

        config([
            'important_links' => $importantLinks,
        ]);

        if ($settings) {
            config([
                'app.name' => $settings->app_name,
                'app.favicon' => $settings->favicon,
                'app.dark_logo' => $settings->dark_logo,
                'app.light_logo' => $settings->light_logo,
                'app.square_dark_logo' => $settings->square_dark_logo,
                'app.square_light_logo' => $settings->square_light_logo,
                'app.email' => $settings->email,
                'app.phone' => $settings->phone,
                'app.facebook' => $settings->facebook,
                'app.twitter' => $settings->twitter,
                'app.instagram' => $settings->instagram,
                'app.linkedin' => $settings->linkedin,
                'app.youtube' => $settings->youtube,
                'app.whatsapp' => '91'.$settings->whatsapp,
                'app.address' => $settings->address,
            ]);
        }

        if ($pageContact) {
            config([
                'app.working_hour' => $pageContact->working_hour,
            ]);
        }

        return $next($request);
    }
}

