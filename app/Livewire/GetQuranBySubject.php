<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Quran;
use App\Models\Subject;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * @author  Arif Setianto <arifsetiantoo@gmail.com>
 */
#[Title('Quran by Subject Matters')]
class GetQuranBySubject extends Component
{
    public string $subject;
    public bool $showBismillah = false;
    public bool $showTranslation;
    public bool $showComment;

    protected array $queryString = [
        'showTranslation' => ['except' => ''],
        'showComment'     => ['except' => ''],
    ];

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.get-quran-by-subject')->with(
            [
                'subjects'       => $this->getSubjectsData(),
                'currentSubject' => $this->getSubjectData($this->subject),
                'contents'       => $this->getContents()
            ]
        );
    }

    public function mount($subject): void
    {
        $this->subject = $subject;
    }

    private function getSubjectsData(): Collection
    {
        return Subject::get();
    }

    private function getSubjectData($subject): Subject
    {
        return Subject::findOrFail($subject);
    }

    private function getContents(): string
    {
        $subject = $this->getSubjectData($this->subject);
        $contents = '';

        foreach ($subject->chapter_verses as $item) {
            $start = $item['start'];
            $end = $item['end'];

            for ($verse = $start; $verse <= $end; $verse++) {
                $quran = Quran::where('chapter_id', $item['chapter_id'])->where('verse', $verse)->first();

                $contents .= '<div href="' .
                             route(
                                 'get-quran-by-subject',
                                 [
                                     'subject'         => $this->subject,
                                     'showTranslation' => $this->showTranslation,
                                     'showComment'     => $this->showComment
                                 ]
                             ) .
                             '"class="scale-100 py-6 flex transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500 border-b-2 border-blue-950">';
                $contents .= '<div class="w-full text-gray-500 dark:text-gray-400 text-sm leading-relaxed" wire:key="quran-' .
                             $quran->id .
                             '">';
                $contents .= '<div class="flex justify-start items-center mb-8">';
                $contents .= '<div class="mr-2">';
                $contents .= '<p class="text-lg font-extrabold tracking-tight text-gray-900 dark:text-gray-400 leading-relaxed">';
                $contents .= "{$quran->chapter_id}:{$verse}";
                $contents .= '</p>';
                $contents .= '</div>';
                $contents .= '<div class="ml-2 flex">';
                $contents .= '<audio id="playAudio-' .
                             $quran->id .
                             '" src="' .
                             asset(
                                 sprintf(
                                     'storage/recitations/%s.mp3',
                                     sprintf("%'.03d", $quran->chapter_id) . sprintf("%'.03d", $quran->verse)
                                 )
                             ) .
                             '"></audio>';
                $contents .= '<button onclick="play(' . $quran->id . ')">';
                $contents .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-900 dark:text-gray-400 leading-relaxed" id="iconPlay-' .
                             $quran->id .
                             '">';
                $contents .= '<path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />';
                $contents .= '</svg>';
                $contents .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-gray-900 dark:text-gray-400 leading-relaxed hidden" id="iconPause-' .
                             $quran->id .
                             '">';
                $contents .= '<path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 0 1 .75-.75H9a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25Zm7.5 0A.75.75 0 0 1 15 4.5h1.5a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H15a.75.75 0 0 1-.75-.75V5.25Z" clip-rule="evenodd" />';
                $contents .= '</svg>';
                $contents .= '</button>';
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
                    $contents .= '<span class="font-extrabold leading-none tracking-tight text-gray-900">Translation</span> : ' .
                                 $quran->translation->text;
                    $contents .= '</p>';
                }

                if ($this->showComment) {
                    foreach ($quran->comments as $comment) {
                        $contents .= '<div class="max-w mt-4 p-4 bg-blue-950/25 rounded-lg dark:bg-gray-800 dark:border-gray-700">';
                        $contents .= '<p class="text-base font-semibold text-blue-950 dark:text-gray-300 leading-relaxed italic">';
                        $contents .= '<span class="font-extrabold leading-none tracking-tight text-blue-950">Comment</span> : ' .
                                     $comment->text;
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

    public function selectSubject(): void
    {
        $this->redirectRoute(
            'get-quran-by-subject',
            [
                'subject'         => $this->subject,
                'showTranslation' => $this->showTranslation,
                'showComment'     => $this->showComment
            ]
        );
    }

    public function checkTranslation(): void
    {
        $this->redirectRoute(
            'get-quran-by-subject',
            [
                'subject'         => $this->subject,
                'showTranslation' => !!$this->showTranslation,
                'showComment'     => $this->showComment
            ]
        );
    }

    public function checkComment(): void
    {
        $this->redirectRoute(
            'get-quran-by-subject',
            [
                'subject'         => $this->subject,
                'showTranslation' => $this->showTranslation,
                'showComment'     => !!$this->showComment
            ]
        );
    }

    public function goToHome(): void
    {
        $this->redirectRoute('welcome');
    }
}
