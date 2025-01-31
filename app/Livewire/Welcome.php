<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
#[Title('Welcome')]
class Welcome extends Component
{
    public function render()
    {
        return view('livewire.welcome');
    }
}
