<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServicePackageModal extends Component
{


    public $title;
    public $reload;

    // Set default values so nothing is required
    public function __construct(string $title = 'Service Package', bool $reload = false)
    {
        $this->title = $title;   // default title if none provided
        $this->reload = $reload; // default false
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Pass inventory for select2 in modal
        $inventory = \App\Models\Inventory::orderBy('Product')->get(['id', 'Product as part_name', 'Stock as stock']);
        return view('components.service-package-modal', compact('inventory'));
    }
}
