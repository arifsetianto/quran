<div>
    <div class="flex justify-center">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-24 w-auto bg-gray-100 dark:bg-gray-900"/>
        </a>
    </div>

    <div class="flex flex-col justify-center items-center mt-4">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-center text-blue-950 md:text-5xl lg:text-6xl dark:text-white">Welcome to <span class="text-blue-950">Thai</span><span class="text-gold-400">Quran</span> Online Translation</h1>
        <p class="mb-6 text-lg font-normal text-center text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">ThaiQuran has wonderful documentation covering every aspect of the framework.</p>
    </div>

    <div class="mt-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            @foreach($menu as $value)
                <a href="{{ !$value['lock'] ? $value['redirect_route'] : '#' }}" class="scale-100 p-6 bg-blue-950 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-blue-700/50 via-transparent text-center dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-lg shadow-blue-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-950">
                    <div class="size-full">
{{--                        <div class="h-16 w-16 bg-blue-50 dark:bg-blue-800/20 flex items-center justify-center rounded-full">--}}
{{--                            {!! $value['icon'] !!}--}}
{{--                        </div>--}}

                        <div class="w-full">
                            <h2 class="text-xl text-center font-bold text-gold-400 dark:text-white leading-none tracking-tight items-center inline-flex">
                                {{ $value['title'] }}
                                @if($value['lock'])
                                    <span class="flex-1 ms-3 whitespace-nowrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" data-tooltip-target="tooltip-lock">
                                          <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <div id="tooltip-lock" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        Coming Soon
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                @endif
                            </h2>
{{--                            <p class="mt-2 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">--}}
{{--                                {{ $value['description'] }}--}}
{{--                            </p>--}}
                        </div>
                    </div>

{{--                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-blue-500 w-6 h-6 mx-6">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />--}}
{{--                    </svg>--}}
                </a>
            @endforeach
        </div>
    </div>
</div>
