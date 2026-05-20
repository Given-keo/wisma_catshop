<?php

namespace App\View\Components\Admin\Users;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormUsers extends Component
{
    public $id;
    public $name;
    public $email;
    public $whatsapp;
    public $address;
    public $loyaltyPoints;

    public function __construct($id = null, $name = '', $email = '', $whatsapp = '', $address = '', $loyaltyPoints = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->whatsapp = $whatsapp;
        $this->address = $address;
        $this->loyaltyPoints = $loyaltyPoints;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.users.form-users');
    }
}