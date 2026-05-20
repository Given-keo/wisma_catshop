<?php

namespace App\View\Components\Admin\Services;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormServices extends Component
{
    public $id;
    public $name;
    public $type;
    public $price;
    public $description;
    public $isActive;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $id = null,
        $name = '',
        $type = '',
        $price = '',
        $description = '',
        $isActive = true
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->description = $description;
        $this->isActive = $isActive;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.services.form-services');
    }
}