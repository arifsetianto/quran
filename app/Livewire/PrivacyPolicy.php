<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
#[Title('Privacy Policy')]
class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.privacy-policy');
    }
}
