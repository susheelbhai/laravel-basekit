<?php

namespace App\View\Components\Layout\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Li1 extends Component
{
    public $name;

    public $href;

    public $icon;

    public bool $active;

    public function __construct($name, $href, $icon, bool $active = false)
    {
        $this->name = $name;
        $this->href = $href;
        $this->icon = $icon;
        $this->active = $active;
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.layout.sidebar.li1');
    }
}
