<?php

namespace App\View\Components\Layout;

use Closure;
use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View as ViewFacade;

class App extends Component
{
    public $setting;

    /**
     * @param  array<int, array<string, mixed>>  $sidebarFooterNavItems
     * @param  array<int, array<string, mixed>>  $sidebarProfileNavItems
     */
    public function __construct(
        public array $sidebarFooterNavItems = [],
        public array $sidebarProfileNavItems = [],
        public ?string $sidebarUserGuard = null,
    ) {
        $this->setting = Setting::find(1);
        ViewFacade::share('setting', $this->setting);
    }

    
    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.layout.app');
    }
}
