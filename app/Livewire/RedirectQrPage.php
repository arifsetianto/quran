<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
class RedirectQrPage extends Component
{
    public string $page;

    public function mount(): void
    {
        $this->redirectRoute(
            'get-quran-by-page',
            ['page' => $this->page, 'showTranslation' => true, 'showComment' => true]
        );
    }
}
