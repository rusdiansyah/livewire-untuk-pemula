<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home')]
class HomeIndex extends Component
{
    public function render()
    {
        return view('livewire.home-index');
    }
}
