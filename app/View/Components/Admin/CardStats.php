<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardStats extends Component
{
    /**
     * Create a new component instance.
     */
    public $icon, $color, $title, $value;
    public function __construct($icon, $color, $title, $value)
    {
        $this->icon = $icon;
        $this->color = $color;
        $this->title = $title;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.card-stats');
    }
}
