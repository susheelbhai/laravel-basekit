<?php

namespace App\View\Components\Layout\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Li21 extends Component
{
    public $name;

    public $href;

    public bool $active;

    public string $icon;

    public function __construct($name, $href, bool $active = false, ?string $icon = null)
    {
        $this->name = $name;
        $this->href = $href;
        $this->active = $active;
        $this->icon = $icon ?? '';
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.layout.sidebar.li21');
    }
}
