<?php

namespace App\View\Components\Admin\Cats;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormCats extends Component
{
    public $id;
    public $userId;
    public $users;
    public $name;
    public $breed;
    public $gender;
    public $age;
    public $color;
    public $healthNotes;

    public function __construct(
        $id = null,
        $userId = '',
        $users = [],
        $name = '',
        $breed = '',
        $gender = '',
        $age = '',
        $color = '',
        $healthNotes = ''
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->users = $users;
        $this->name = $name;
        $this->breed = $breed;
        $this->gender = $gender;
        $this->age = $age;
        $this->color = $color;
        $this->healthNotes = $healthNotes;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.cats.form-cats');
    }
}