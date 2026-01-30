<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InventoryModal extends Component
{


    public $title;
    public $reload;

    // Set default values so nothing is required
    public function __construct(string $title = 'Inventory', bool $reload = false)
    {
        $this->title = $title;   // default title if none provided
        $this->reload = $reload; // default false
    }

    public function render()
    {
        return view('components.inventory-modal');
    }
}
