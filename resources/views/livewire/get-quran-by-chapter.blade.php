<div>
    <nav
        class="bg-white dark:bg-gray-900 fixed w-full z-50 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="flex items-center justify-start rtl:justify-end">
                <a href="{{ route('welcome') }}" class="flex">
                    <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-8"/>
                    <span
                        class="self-center text-2xl font-extrabold leading-none tracking-tight whitespace-nowrap dark:text-white"><span
                            class="text-blue-950">Thai</span><span class="text-gold-400">Quran</span></span>
                </a>
            </div>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <div class="flex justify-center items-center cursor-pointer" data-modal-target="navigation-modal"
                     data-modal-toggle="navigation-modal" aria-controls="navigation-modal">
                    <div class="flex flex-col items-end">
                        <h1 class="mb-1 text-xl font-extrabold leading-none tracking-tight text-blue-950 dark:text-white">{{ $chapter->tname }}
                            <span class="text-gold-400 dark:text-blue-500">#{{ $chapter->id }}</span></h1>
                        <p class="text-sm font-semibold leading-none tracking-tight text-blue-950 lg:text-xl dark:text-gray-400 capitalize">{{ $chapter->type }}
                            . {{ $chapter->total_verses }} Ayahs</p>
                    </div>
                    <div class="ml-3">
                        <svg class="w-3 h-3 text-blue-950 stroke-blue-950 dark:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="mt-20 flex justify-center items-center">
        <div
            class="scale-100 p-10 text-center bg-blue-950 w-full dark:bg-gray-800/50 dark:bg-gradient-to-bl from-blue-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-lg shadow-blue-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500">
            <p class="text-2xl font-semibold text-gold-400 dark:text-gray-300 leading-relaxed quran-text">
                سورة {{ $chapter->name }}
            </p>
            <p class="mt-2 text-3xl font-semibold text-white dark:text-gray-300 leading-relaxed">
                {{ $chapter->tname }}
            </p>
            <p class="mt-2 text-base font-semibold text-white dark:text-gray-400 leading-relaxed">
                {{ $chapter->ename }}
            </p>
            <hr class="h-px my-8 bg-gold-400 border-0 dark:bg-gray-700">
            <p class="mt-6 text-base font-semibold text-white dark:text-gray-400 capitalize leading-relaxed">
                {{ $chapter->type }} &nbsp; . &nbsp; {{ $chapter->total_verses }} Ayahs
            </p>
        </div>
    </div>

    <div class="mt-10">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
            @forelse($qurans as $quran)
                <div
                    href="{{ route('get-quran-by-chapter', ['surah' => $quran->chapter_id, 'showTranslation' => $showTranslation, 'showComment' => $showComment]) }}"
                    class="scale-100 py-6 flex transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500 border-b-2 border-blue-950">
                    <div class="w-full text-gray-500 dark:text-gray-400 text-sm leading-relaxed"
                         wire:key="quran-{{ $quran->id }}">
                        <div class="flex justify-start items-center mb-8">
                            <div class="mr-2">
                                <p class="text-lg font-extrabold tracking-tight text-gray-900 dark:text-gray-400 leading-relaxed">
                                    {{ $quran->chapter->id }}:{{ $quran->verse }}
                                </p>
                            </div>
                            <div class="ml-2 flex">
                                <audio id="playAudio-{{ $quran->id }}"
                                       src="{{ asset(sprintf('storage/recitations/%s.mp3', sprintf("%'.03d", $quran->chapter_id) . sprintf("%'.03d", $quran->verse))) }}"></audio>
                                <button onclick="play({{ $quran->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         class="w-6 h-6 text-gray-900 dark:text-gray-400 leading-relaxed"
                                         id="iconPlay-{{ $quran->id }}">
                                        <path fill-rule="evenodd"
                                              d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         class="w-6 h-6 text-gray-900 dark:text-gray-400 leading-relaxed hidden"
                                         id="iconPause-{{ $quran->id }}">
                                        <path fill-rule="evenodd"
                                              d="M6.75 5.25a.75.75 0 0 1 .75-.75H9a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25Zm7.5 0A.75.75 0 0 1 15 4.5h1.5a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H15a.75.75 0 0 1-.75-.75V5.25Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="mb-14 text-4xl font-semibold text-gray-900 dark:text-gray-300 quran-text leading-loose">
                                @if(!$showBismillah && $quran->verse === 1 && $quran->chapter_id !== 1 && $quran->chapter_id !== 9)
                                    {!! preg_replace('/ ([ۖ-۩])/u', '<span class="text-gold-400">&nbsp;$1</span>', preg_replace('/^(([^ ]+ ){4})/u', '', $quran->text)) !!}
                                @else
                                    {!! preg_replace('/ ([ۖ-۩])/u', '<span class="text-gold-400">&nbsp;$1</span>', $quran->text) !!}
                                @endif
                            </p>
                        </div>
                        <div class="mt-8">
                            @if($showTranslation)
                                <p class="mt-6 text-lg font-semibold text-gray-900 dark:text-gray-300 leading-relaxed">
                                    <span class="font-extrabold leading-none tracking-tight text-blue-950">Translation</span> : {{ $quran->translation->text }}
                                </p>
                            @endif

                            @if($showComment)
                                @foreach($quran->comments as $comment)
                                    <p class="mt-6 text-lg font-semibold text-gray-900 dark:text-gray-300 leading-relaxed">
                                        <span class="font-extrabold leading-none tracking-tight text-blue-950">Comment</span> : {{ $comment->text }}
                                    </p>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                No Data
            @endforelse
        </div>
    </div>

    <div class="mt-16 flex items-center justify-center gap-x-6 lg:justify-center">
        @if(!$isChapterOne)
            <a wire:click="goToFirstSurah"
               class="rounded-lg bg-gold-400 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gold-300 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white cursor-pointer">Beginning
                of Surah</a>
            <a wire:click="goToPreviousChapter"
               class="inline-flex items-center justify-center text-sm font-semibold text-blue-950 rounded-lg hover:text-blue-900 dark:text-gray-400 dark:hover:text-white cursor-pointer">
                <svg class="w-4 h-4 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 5H1m0 0 4 4M1 5l4-4"></path>
                </svg>
                Previous Surah
            </a>
        @endif

        @if(!$isLastChapter)
            <a wire:click="goToNextChapter"
               class="inline-flex items-center justify-center text-sm font-semibold text-blue-950 rounded-lg hover:text-blue-900 dark:text-gray-400 dark:hover:text-white cursor-pointer">
                Next Surah
                <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M1 5h12m0 0L9 1m4 4L9 9"></path>
                </svg>
            </a>
        @endif
    </div>

    <div id="navigation-modal" tabindex="-1" aria-hidden="true"
         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Choose a Surah of the Quran
                    </h3>
                    <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="navigation-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Select the surah of the Quran.</p>
                    <ul class="my-4 space-y-3">
                        <li>
                            <div
                                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg group dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                <label for="select_surah" class="sr-only">Choose a surah</label>
                                <select id="select_surah" wire:model="surah" wire:change="selectChapter"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-600 bg-transparent border-0 border-b-2 border-gray-400 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-400 peer">
                                    @foreach($chapters as $value)
                                        @if($value->id == $surah)
                                            <option value="{{ $value->id }}" selected>{{ $value->id }}
                                                . {{ $value->tname }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->id }}
                                                . {{ $value->tname }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </li>
                    </ul>
                    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Select the option to display
                        translations and commentaries.</p>
                    <ul class="my-4 space-y-3">
                        <li>
                            <div
                                class="flex justify-between items-center p-3 text-base font-bold text-gray-900 rounded-lg group dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                <p class="flex-1 whitespace-nowrap">Show Translation</p>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" value="1" wire:model="showTranslation"
                                           wire:click="checkTranslation" class="sr-only peer">
                                    <div
                                        class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-950"></div>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div
                                class="flex justify-between items-center p-3 text-base font-bold text-gray-900 rounded-lg group dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                <p class="flex-1 whitespace-nowrap">Show Comment</p>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" value="1" wire:model="showComment" wire:click="checkComment"
                                           class="sr-only peer">
                                    <div
                                        class="w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-950"></div>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
