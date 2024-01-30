<?php

namespace App\Livewire;

use App\Models\Chapter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
#[Title('List Surahs')]
class ListChapters extends Component
{
    public string $searchChapter = '';
    public Collection $chapters;

    public function mount(): void
    {
        $this->chapters = Chapter::get();
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->chapters =
            Chapter::when(
                $this->searchChapter !== '',
                fn(Builder $query) => $query->where('tname', 'ilike', '%' . $this->searchChapter . '%')
            )->get();

        return view(
            'livewire.list-chapters',
            [
                'chapters' => $this->chapters
            ]
        );
    }
}
