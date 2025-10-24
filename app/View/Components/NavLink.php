<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavLink extends Component
{
    /**
     * The active state for the nav link.
     *
     * @var bool
     */
    public $active;

    /**
     * Icon class for the link.
     *
     * @var string
     */
    public $icn;

    /**
     * Create a new component instance.
     *
     * @param  bool  $active
     * @param  string  $icn
     * @return void
     */
    public function __construct($active = false, $icn = '')
    {
        $this->active = $active;
        $this->icn = $icn;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-link');
    }
}
