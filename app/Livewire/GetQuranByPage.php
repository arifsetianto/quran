<?php

namespace App\Livewire;

use App\Models\Chapter;
use App\Models\Page;
use App\Models\Quran;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
#[Title('Quran by Page')]
class GetQuranByPage extends Component
{
    public string $page;
    public bool $isPageOne;
    public bool $isLastPage;
    public bool $showBismillah = false;
    public bool $showTranslation;
    public bool $showComment;

    protected array $queryString = [
        'showTranslation' => ['except' => ''],
        'showComment'     => ['except' => ''],
    ];

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.get-quran-by-page')->with(
            [
                'pages'         => $this->getPagesData(),
                'pageData'      => $this->getPageData($this->page),
                'contents'      => $this->getContents(),
                'showBismillah' => $this->showBismillah
            ]
        );
    }

    public function mount($page): void
    {
        $this->page = $page;
        $this->isPageOne = $this->page == 1;
        $this->isLastPage = $this->page == Page::count();
    }

    private function getPagesData(): Collection
    {
        return Page::get();
    }

    private function getPageData($page): Page
    {
        return Page::findOrFail($page);
    }

    private function getContents(): string
    {
        // Determine the end Sura and Aya for the given page
        $chapterEnd = null;
        $verseEnd = $this->getVerseEnd($chapterEnd);

        // Retrieve the starting Aya for the current page
        $currentPage = $this->getPageData($this->page);
        $chapterStart = $currentPage->chapter_id;
        $verseStart = $currentPage->verse;

        // Initialize content variable
        $contents = '';

        // Iterate through the Ayas and Suras to display the content
        for ($chapter = $chapterStart; $chapter <= $chapterEnd; $chapter++) {
            $start = $chapter == $chapterStart ? $verseStart : 1;
            $end = $chapter == $chapterEnd ? $verseEnd : Chapter::find($chapter)->total_verses;

            for ($verse = $start; $verse <= $end; $verse++) {
                $quran = Quran::where('chapter_id', $chapter)->where('verse', $verse)->first();

                if ($quran->verse == 1) {
                    $currentChapter = Chapter::find($quran->chapter_id);
                    $contents .= '<div class="scale-100 p-10 text-center bg-blue-950 w-full dark:bg-gray-800/50 dark:bg-gradient-to-bl from-blue-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500">';
                    $contents .= "<p class='text-2xl font-normal text-gold-400 dark:text-gray-300 leading-relaxed quran-text'>"; // Indicate end of a Sura if there are multiple Suras on one page
                    $contents .= "سورة  " . $currentChapter->name;
                    $contents .= '</p>';
                    $contents .= "<p class='mt-2 text-3xl font-semibold text-white dark:text-gray-300 leading-relaxed'>"; // Indicate end of a Sura if there are multiple Suras on one page
                    $contents .= $currentChapter->tname;
                    $contents .= '</p>';
                    $contents .= "<p class='mt-2 text-base font-semibold text-white dark:text-gray-400 leading-relaxed'>";
                    $contents .= $currentChapter->ename;
                    $contents .= '</p>';
                    $contents .= '<hr class="h-px my-8 bg-gold-400 border-0 dark:bg-gray-700">';
                    $contents .= '<p class="mt-6 text-base font-semibold text-white dark:text-gray-400 capitalize leading-relaxed">';
                    $contents .= $currentChapter->type->value . ' . ' . $currentChapter->total_verses . ' Ayahs';
                    $contents .= '</p>';
                    $contents .= '</div>';

                    if ($quran->verse === 1) {
                        if ($quran->chapter_id !== 1 && $quran->chapter_id !== 9) {
                            $contents .= '<div class="text-center">
                                                <p class="text-3xl font-normal text-gray-900 dark:text-gray-300 quran-text leading-loose">بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ </p>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <button class="inline-flex" data-modal-target="surah-info-modal" data-modal-toggle="surah-info-modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-blue-900 dark:text-gray-400 leading-relaxed">
                                                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                                        </svg>
                                                        <span class="ml-1 font-semibold tracking-tight text-blue-900">Surah Info</span>
                                                    </button>
                                                </div>
                                                <div class="audioContainer">
                                                    <audio id="playAudio-bismillah"
                                                           src="' . asset('storage/recitations/verses/bismillah.mp3') . '"></audio>
                                                    <button class="playPauseButton inline-flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                             class="w-6 h-6 text-gray-900 dark:text-gray-400 leading-relaxed playIcon">
                                                            <path fill-rule="evenodd"
                                                                  d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z"
                                                                  clip-rule="evenodd"/>
                                                        </svg>
                                                        <span class="ml-1 font-semibold tracking-tight">Play Audio</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr class="w-full h-0.5 mx-auto bg-gold-400 border-0 rounded md:my-10 dark:bg-gray-700">';
                        } else {
                            $contents .= '<div class="flex justify-between items-center">
                                        <div>
                                            <button class="inline-flex" data-modal-target="surah-info-modal" data-modal-toggle="surah-info-modal">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-blue-900 dark:text-gray-400 leading-relaxed">
                                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-1 font-semibold tracking-tight text-blue-900">Surah Info</span>
                                            </button>
                                        </div>
                                    </div>';
                        }

                        $contents .= '<div id="surah-info-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Surah Info
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="surah-info-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-4 md:p-5">
                                                    <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                                                        <li class="pb-3 sm:pb-4">
                                                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                                                <div class="flex-1 min-w-0">
                                                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                        Quran text provided by:
                                                                    </p>
                                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                        <a href="http://tanzil.net/" class="hover:underline text-blue-600">Tanzil.net</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="py-3 sm:py-4">
                                                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                                                <div class="flex-1 min-w-0">
                                                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                        Quran Thai-translation and commentary provided by:
                                                                    </p>
                                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                        <a href="https://facebook.com/smakomnka" class="hover:underline text-blue-600">Arab Thai Alumni University</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="py-3 sm:py-4">
                                                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                                                <div class="flex-1 min-w-0">
                                                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                        Quran Recitations by:
                                                                    </p>
                                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                        <a href="https://versebyversequran.com/" class="hover:underline text-blue-600">Mishary Rashid Alafasy</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="py-3 sm:py-4">
                                                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                                                <div class="flex-1 min-w-0">
                                                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                        ThaiQuran QR Code & Printing by:
                                                                    </p>
                                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                        <a href="https://syaamilquran.com" class="hover:underline text-blue-600">Syaamil Quran</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                    }
                }

                $contents .= '<div href="' .
                             route(
                                 'get-quran-by-page',
                                 [
                                     'page'            => $this->page,
                                     'showTranslation' => $this->showTranslation,
                                     'showComment'     => $this->showComment
                                 ]
                             ) .
                             '"class="scale-100 py-6 flex transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500 border-b-2 border-gold-400">';
                $contents .= '<div class="w-full text-gray-500 dark:text-gray-400 text-sm leading-relaxed" wire:key="quran-' .
                             $quran->id .
                             '">';
                $contents .= '<div class="flex justify-start items-center mb-8">';
                $contents .= '<div class="mr-2">';
                $contents .= '<p class="text-lg font-extrabold tracking-tight text-gray-900 dark:text-gray-400 leading-relaxed">';
                $contents .= "{$chapter}:{$verse}";
                $contents .= '</p>';
                $contents .= '</div>';
                $contents .= '<div class="ml-2">';
                $contents .= '<div id="playlist">';
                $contents .= '<div class="audioContainer flex">';
                $contents .= '<audio id="playAudio-' .
                             sprintf("%'.04d", $quran->id) . sprintf("%'.03d", $quran->chapter_id) . sprintf("%'.03d", $quran->verse) .
                             '" src="' .
                             asset(
                                 sprintf(
                                     'storage/recitations/verses/%s.mp3',
                                     sprintf("%'.03d", $quran->chapter_id) . sprintf("%'.03d", $quran->verse)
                                 )
                             ) .
                             '"></audio>';
                $contents .= '<button class="playPauseButton">';
                $contents .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-900 dark:text-gray-400 leading-relaxed playIcon">';
                $contents .= '<path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />';
                $contents .= '</svg>';
                $contents .= '</button>';
                $contents .= '</div>';
                $contents .= '</div>';
                $contents .= '</div>';
                $contents .= '</div>';
                $contents .= '<div class="text-right">';
                $contents .= '<p class="mb-14 text-3xl font-normal text-gray-900 dark:text-gray-300 quran-text leading-loose">';
                $contents .= !$this->showBismillah &&
                             $quran->verse === 1 &&
                             $quran->chapter_id !== 1 &&
                             $quran->chapter_id !== 9 ?
                    preg_replace(
                        '/ ([ۖ-۩])/u',
                        '<span class="text-gold-400">&nbsp;$1</span>',
                        preg_replace('/^(([^ ]+ ){4})/u', '', $quran->text)
                    ) : preg_replace('/ ([ۖ-۩])/u', '<span class="text-gold-400">&nbsp;$1</span>', $quran->text);
                $contents .= '</p>';
                $contents .= '</div>';
                $contents .= '<div class="mt-8">';

                if ($this->showTranslation) {
                    $contents .= '<p class="mt-6 text-base font-semibold text-gray-900 dark:text-gray-300 leading-relaxed">';
                    $contents .= '<span class="font-extrabold leading-none tracking-tight text-gray-900">Translation</span> : ' . $quran->translation->text;
                    $contents .= '</p>';
                }

                if ($this->showComment) {
                    foreach ($quran->comments as $comment) {
                        $contents .= '<div class="max-w mt-4 p-4 bg-blue-950/25 rounded-lg dark:bg-gray-800 dark:border-gray-700">';
                        $contents .= '<p class="text-base font-semibold text-blue-950 dark:text-gray-300 leading-relaxed italic">';
                        $contents .= '<span class="font-extrabold leading-none tracking-tight text-blue-950">Comment</span> : ' . $comment->text;
                        $contents .= '</p>';
                        $contents .= '</div>';
                    }
                }

                $contents .= '</div>';
                $contents .= '</div>';
                $contents .= '</div>';
            }
        }

        return $contents;
    }

    private function getVerseEnd(&$chapterEnd): int
    {
        // Get the starting Aya and Sura of the current page
        $currentPage = Page::find($this->page);
        $currentChapter = $currentPage->chapter_id;

        // Attempt to find the next page
        $nextPage = Page::find((int)$this->page + 1) ?? null;

        if (null !== $nextPage) {
            $nextChapter = $nextPage->chapter_id;
            $nextVerse = $nextPage->verse;

            if ($nextChapter == $currentChapter + 1 && $nextVerse == 1) {
                // Case 1: Next page starts with the next Sura and Aya 1
                $chapterEnd = $currentChapter;
                return Chapter::find($currentChapter)->total_verses;
            } elseif ($nextChapter == $currentChapter + 1 && $nextVerse > 1) {
                // Case 2: Next page starts with the next Sura and Aya greater than 1
                $chapterEnd = $currentChapter + 1;
                return $nextVerse - 1;
            } elseif ($nextChapter > $currentChapter + 1 && $nextVerse == 1) {
                // Case 3: Next page jumps a Sura and starts at Aya 1
                $chapterEnd = $nextChapter - 1;
                return Chapter::find($chapterEnd)->total_verses;
            } elseif ($nextChapter > $currentChapter + 1 && $nextVerse > 1) {
                // Case 4: Next page jumps a Sura and starts at an Aya greater than 1
                $chapterEnd = $nextChapter - 1;
                return Chapter::find($chapterEnd)->total_verses;
            } else {
                // Next page continues the current Sura or is within the current Sura's sequence
                $chapterEnd = $currentChapter;
                return $nextVerse - 1;
            }
        } else {
            // Case 4: This is the last page
            $chapterEnd = Chapter::orderByDesc('id')->first()->id;
            return Chapter::find($chapterEnd)->total_verses;
        }
    }

    public function selectPage(): void
    {
        $this->redirectRoute(
            'get-quran-by-page',
            ['page' => $this->page, 'showTranslation' => $this->showTranslation, 'showComment' => $this->showComment]
        );
    }

    public function checkTranslation(): void
    {
        $this->redirectRoute(
            'get-quran-by-page',
            ['page' => $this->page, 'showTranslation' => !!$this->showTranslation, 'showComment' => $this->showComment]
        );
    }

    public function checkComment(): void
    {
        $this->redirectRoute(
            'get-quran-by-page',
            ['page' => $this->page, 'showTranslation' => $this->showTranslation, 'showComment' => !!$this->showComment]
        );
    }

    public function goToHome(): void
    {
        $this->redirectRoute('welcome');
    }

    public function goToFirstPage(): void
    {
        $this->redirectRoute(
            'get-quran-by-page',
            ['page' => 1, 'showTranslation' => $this->showTranslation, 'showComment' => $this->showComment]
        );
    }

    public function goToPreviousPage(): void
    {
        $this->redirectRoute(
            'get-quran-by-page',
            ['page' => --$this->page, 'showTranslation' => $this->showTranslation, 'showComment' => $this->showComment]
        );
    }

    public function goToNextPage(): void
    {
        $this->redirectRoute(
            'get-quran-by-page',
            ['page' => ++$this->page, 'showTranslation' => $this->showTranslation, 'showComment' => $this->showComment]
        );
    }
}
