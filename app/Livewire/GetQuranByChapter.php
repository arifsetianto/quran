<?php

namespace App\Livewire;

use App\Models\Chapter;
use App\Models\Quran;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection as IlluminateCollection;
use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
#[Title('Quran by Surah')]
class GetQuranByChapter extends Component
{
    public string $surah;
    public bool $isChapterOne;
    public bool $isLastChapter;
    public bool $showTranslation;
    public bool $showComment;
    public string $searchChapter = '';
    public IlluminateCollection $chapters;

    protected array $queryString = [
        'showTranslation' => ['except' => ''],
        'showComment'     => ['except' => ''],
    ];

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->chapters = Chapter::where('tname', 'ilike', '%' . $this->searchChapter . '%')->get();

        return view('livewire.get-quran-by-chapter')->with(
            [
                'chapter'       => $this->getChapterData($this->surah),
                'qurans'        => $this->getQuranContents($this->surah),
                'showBismillah' => false
            ]
        );
    }

    public function mount($surah): void
    {
        $this->surah = $surah;
        $this->isChapterOne = $this->surah == 1;
        $this->isLastChapter = $this->surah == Chapter::count();
        $this->chapters = $this->getChaptersData();
    }

    private function getChaptersData(): Collection
    {
        return Chapter::get();
    }

    private function getChapterData($surah): Chapter
    {
        return Chapter::findOrFail($surah);
    }

    private function getQuranContents($surah): Collection
    {
        return Quran::where('chapter_id', $surah)
                    ->orderBy('verse')
                    ->get();
    }

    public function selectChapter(): void
    {
        $this->redirectRoute(
            'get-quran-by-chapter',
            ['surah' => $this->surah, 'showTranslation' => $this->showTranslation, 'showComment' => $this->showComment]
        );
    }

    public function checkTranslation(): void
    {
        $this->redirectRoute(
            'get-quran-by-chapter',
            [
                'surah'           => $this->surah,
                'showTranslation' => !!$this->showTranslation,
                'showComment'     => $this->showComment
            ]
        );
    }

    public function checkComment(): void
    {
        $this->redirectRoute(
            'get-quran-by-chapter',
            [
                'surah'           => $this->surah,
                'showTranslation' => $this->showTranslation,
                'showComment'     => !!$this->showComment
            ]
        );
    }

    public function goToHome(): void
    {
        $this->redirectRoute('welcome');
    }

    public function goToListChapters(): void
    {
        $this->redirectRoute('list-chapters');
    }

    public function goToFirstSurah(): void
    {
        $this->redirectRoute(
            'get-quran-by-chapter',
            ['surah' => 1, 'showTranslation' => $this->showTranslation, 'showComment' => $this->showComment]
        );
    }

    public function goToPreviousChapter(): void
    {
        $this->redirectRoute(
            'get-quran-by-chapter',
            [
                'surah'           => --$this->surah,
                'showTranslation' => $this->showTranslation,
                'showComment'     => $this->showComment
            ]
        );
    }

    public function goToNextChapter(): void
    {
        $this->redirectRoute(
            'get-quran-by-chapter',
            [
                'surah'           => ++$this->surah,
                'showTranslation' => $this->showTranslation,
                'showComment'     => $this->showComment
            ]
        );
    }
}
