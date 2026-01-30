<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomerModal extends Component
{

    public $title;
    public $reload;

    // Set default values so nothing is required
    public function __construct(string $title = 'Customer', bool $reload = false)
    {
        $this->title = $title;   // default title if none provided
        $this->reload = $reload; // default false
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.customer-modal');
    }
}
