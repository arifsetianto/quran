<div>
    <div class="flex justify-center">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-24 w-auto bg-gray-100 dark:bg-gray-900"/>
        </a>
    </div>

    <div class="flex flex-col justify-center items-center mt-4">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-center text-blue-950 md:text-5xl lg:text-6xl dark:text-white">Quran by Surah</h1>
        <p class="mb-6 text-lg font-normal text-center text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">ThaiQuran has wonderful documentation covering every aspect of the framework.</p>
    </div>

    <div class="mt-6">
        <form>
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="default-search" wire:model.live="searchChapter" class="block w-full p-4 ps-10 text-sm text-gray-900 border-transparent focus:border-transparent focus:ring-0 shadow rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Surah" required>
            </div>
        </form>
    </div>

    <div class="mt-6">
        <div wire:loading wire:target="searchChapter" class="text-center">
            <div class="flex items-center justify-center w-56 h-56 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                <div class="px-3 py-1 text-xs font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse dark:bg-blue-900 dark:text-blue-200">loading...</div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6">
            @foreach($chapters as $chapter)
                <a href="{{ route('get-quran-by-chapter', ['surah' => $chapter->id, 'showTranslation' => true, 'showComment' => true]) }}" class="scale-100 p-6 bg-blue-950 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-blue-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-lg shadow-blue-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-950">
                    <div class="flex justify-between items-center">
                        <div class="flex justify-start items-center">
                            <div class="diamond font-bold text-blue-950 dark:text-white flex items-center justify-center">
                                <span class="text">{{ $chapter->id }}</span>
                            </div>

                            <div class="ml-5">
                                <p class="text-base font-bold text-white dark:text-white">{{ $chapter->tname }}</p>
                                <div class="mt-1 flex justify-start items-center">
                                    <p class="text-sm text-white font-semibold dark:text-gray-400 capitalize">{{ $chapter->type }}</p>
                                    <p class="ml-2 text-sm text-white font-semibold dark:text-gray-400">.</p>
                                    <p class="ml-2 text-sm text-white font-semibold dark:text-gray-400">{{ $chapter->total_verses }} Ayahs</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="quran-text text-xl font-bold text-gold-400 dark:text-white">
                                {{ $chapter->name }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
