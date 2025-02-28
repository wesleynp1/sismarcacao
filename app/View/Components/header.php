<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class header extends Component
{
    public function __construct(public string $texto)
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render() : View
    {
        return view('components.header');
    }
}
