<?php

namespace App\View\Components\Layout\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Li2 extends Component
{
    public $name;

    public $icon;

    public bool $open;

    public bool $active;

    public function __construct($name, $icon, bool $open = false, bool $active = false)
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->open = $open;
        $this->active = $active;
    }

    public function render(): View|Closure|string
    {
        return view(Session::get('user')['theme'].'.layout.sidebar.li2');
    }
}
