<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RegisterPartner extends Component
{
    public $slide = 1;
    
    public function render()
    {
        return view('livewire.register-partner');
    }
}
