<?php

namespace App\View\Components\Form\Type;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Login extends Component
{
    public $title;

    public $action;

    public $method;

    public $submitName;

    public ?string $description;

    public bool $showSubmit;

    public ?string $formClass;

    public function __construct(
        $title,
        $action = '#',
        $method = 'post',
        $submitName = 'Submit',
        ?string $description = null,
        bool $showSubmit = true,
        ?string $formClass = null,
    ) {
        $this->title = $title;
        $this->action = $action;
        $this->method = $method;
        $this->submitName = $submitName;
        $this->description = $description;
        $this->showSubmit = $showSubmit;
        $this->formClass = $formClass;
    }
    public function render(): View|Closure|string
    {
        return view('theme1.form.type.login');
    }
}
