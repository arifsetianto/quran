<?php

namespace App\Livewire;

use App\Models\Chapter;
use App\Models\Part;
use App\Models\Quran;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Quran by Part')]
class GetQuranByPart extends Component
{
    public string $juz;
    public bool $isJuzOne;
    public bool $isLastJuz;
    public bool $showBismillah = false;
    public bool $showTranslation;
    public bool $showComment;

    protected array $queryString = [
        'showTranslation' => ['except' => ''],
        'showComment'     => ['except' => ''],
    ];

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.get-quran-by-part')->with(
            [
                'parts'         => $this->getPartsData(),
                'partData'      => $this->getPartData($this->juz),
                'contents'      => $this->getContents(),
                'showBismillah' => $this->showBismillah
            ]
        );
    }

    public function mount($juz): void
    {
        $this->juz = $juz;
        $this->isJuzOne = $this->juz == 1;
        $this->isLastJuz = $this->juz == Part::count();
    }

    private function getPartsData(): Collection
    {
        return Part::with('chapter')->get();
    }

    private function getPartData($part): Part
    {
        return Part::findOrFail($part);
    }

    private function getContents(): string
    {
        // Determine the end Sura and Aya for the given juz
        $chapterEnd = null;
        $verseEnd = $this->getVerseEnd($chapterEnd);

        // Retrieve the starting Aya for the current juz
        $currentPart = $this->getPartData($this->juz);
        $chapterStart = $currentPart->chapter_id;
        $verseStart = $currentPart->verse;

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
                    $contents .= "<p class='text-2xl font-normal text-gold-400 dark:text-gray-300 leading-relaxed quran-text'>"; // Indicate end of a Sura if there are multiple Suras on one juz
                    $contents .= "سورة  " . $currentChapter->name;
                    $contents .= '</p>';
                    $contents .= "<p class='mt-2 text-3xl font-semibold text-white dark:text-gray-300 leading-relaxed'>"; // Indicate end of a Sura if there are multiple Suras on one juz
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
                                                <p class="text-3xl font-normal text-gray-900 dark:text-gray-300 quran-text leading-loose">ِبِسْمِ ٱللَّهِ ٱلرَّحْمَـٰنِ ٱلرَّحِيمِ</p>
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
                    }
                }

                $contents .= '<div href="' .
                             route(
                                 'get-quran-by-part',
                                 [
                                     'juz'             => $this->juz,
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
        // Get the starting Aya and Sura of the current juz
        $currentJuz = Part::find($this->juz);
        $currentChapter = $currentJuz->chapter_id;

        // Attempt to find the next juz
        $nextJuz = Part::find((int)$this->juz + 1) ?? null;

        if (null !== $nextJuz) {
            $nextChapter = $nextJuz->chapter_id;
            $nextVerse = $nextJuz->verse;

            if ($nextChapter == $currentChapter + 1 && $nextVerse == 1) {
                // Case 1: Next juz starts with the next Sura and Aya 1
                $chapterEnd = $currentChapter;
                return Chapter::find($currentChapter)->total_verses;
            } elseif ($nextChapter == $currentChapter + 1 && $nextVerse > 1) {
                // Case 2: Next juz starts with the next Sura and Aya greater than 1
                $chapterEnd = $currentChapter + 1;
                return $nextVerse - 1;
            } elseif ($nextChapter > $currentChapter + 1 && $nextVerse == 1) {
                // Case 3: Next juz jumps a Sura and starts at Aya 1
                $chapterEnd = $nextChapter - 1;
                return Chapter::find($chapterEnd)->total_verses;
            } elseif ($nextChapter > $currentChapter + 1 && $nextVerse > 1) {
                // Case 4: Next juz jumps a Sura and starts at an Aya greater than 1
                $chapterEnd = $nextChapter - 1;
                return Chapter::find($chapterEnd)->total_verses;
            } else {
                // Next juz continues the current Sura or is within the current Sura's sequence
                $chapterEnd = $currentChapter;
                return $nextVerse - 1;
            }
        } else {
            // Case 4: This is the last juz
            $chapterEnd = Chapter::orderByDesc('id')->first()->id;
            return Chapter::find($chapterEnd)->total_verses;
        }
    }

    public function selectJuz(): void
    {
        $this->redirectRoute(
            'get-quran-by-part',
            ['juz' => $this->juz, 'showTranslation' => $this->showTranslation, 'showComment' => $this->showComment]
        );
    }

    public function checkTranslation(): void
    {
        $this->redirectRoute(
            'get-quran-by-part',
            ['juz' => $this->juz, 'showTranslation' => !!$this->showTranslation, 'showComment' => $this->showComment]
        );
    }

    public function checkComment(): void
    {
        $this->redirectRoute(
            'get-quran-by-part',
            ['juz' => $this->juz, 'showTranslation' => $this->showTranslation, 'showComment' => !!$this->showComment]
        );
    }

    public function goToHome(): void
    {
        $this->redirectRoute('welcome');
    }

    public function goToFirstJuz(): void
    {
        $this->redirectRoute(
            'get-quran-by-part',
            ['juz' => 1, 'showTranslation' => $this->showTranslation, 'showComment' => $this->showComment]
        );
    }

    public function goToPreviousJuz(): void
    {
        $this->redirectRoute(
            'get-quran-by-part',
            ['juz' => --$this->juz, 'showTranslation' => $this->showTranslation, 'showComment' => $this->showComment]
        );
    }

    public function goToNextJuz(): void
    {
        $this->redirectRoute(
            'get-quran-by-part',
            ['juz' => ++$this->juz, 'showTranslation' => $this->showTranslation, 'showComment' => $this->showComment]
        );
    }
}
