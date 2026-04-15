<?php

namespace App\View\Components\Layout\Seller;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class App extends Component
{
    public function __construct()
    {
        $user = Auth::guard('seller')->user();
        $theme = 'theme1';
        $user = [
            'login' => $user,
            'theme' => $theme,
        ];
        Session::put('user', $user);
    }

    public function render(): View|Closure|string
    {
        return view('components.layout.seller.app');
    }
}
