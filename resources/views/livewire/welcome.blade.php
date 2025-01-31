<div>
    <div class="flex justify-center">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="h-24 w-auto bg-gray-100 dark:bg-gray-900"/>
        </a>
    </div>

    <div class="flex flex-col justify-center items-center mt-4">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-center text-blue-950 md:text-5xl lg:text-6xl dark:text-white">Welcome to <span class="text-blue-950">Thai</span><span class="text-gold-400">Quran</span> Online Reading</h1>
        <p class="mb-6 text-lg font-normal text-center text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">เรามีความมุ่งมั่นและตั้งใจที่จะพัฒนา​เว็บแอป​ (Web​ App) ขึ้นโดยมุ่งเน้นให้ผู้สนใจที่จะเรียนรู้อิสลามได้เข้าถึงเนื้อหาของอัลกุรอานแปลไทยได้ง่ายยิ่งขึ้น​  ท่านสามารถศึกษาอัลกุรอานแปลไทยทั้งเล่มตามความสามารถของท่านผ่านทาง​เว็บแอป​ โดยเลือกศึกษาตาม​ ญุซ​ ซูเราะฮฺ​ หน้า​ และหมวดหมู่​</p>
    </div>

    <div class="mt-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <a href="{{ route('get-quran-by-part', ['juz' => 1, 'showTranslation' => true, 'showComment' => true]) }}" class="scale-100 p-6 bg-blue-950 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-blue-700/50 via-transparent text-center dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-lg shadow-blue-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-950">
                    <div class="size-full">
                        <div class="w-full">
                            <h2 class="text-xl text-center font-bold text-gold-400 dark:text-white leading-none tracking-tight items-center inline-flex">
                                Quran by Juz
                            </h2>
                            <p class="mt-2 text-gray-100 dark:text-gray-400 text-sm leading-relaxed">
                                อัลกุรอานแบ่งตามญุซ
                            </p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('list-chapters') }}" class="scale-100 p-6 bg-blue-950 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-blue-700/50 via-transparent text-center dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-lg shadow-blue-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-950">
                    <div class="size-full">
                        <div class="w-full">
                            <h2 class="text-xl text-center font-bold text-gold-400 dark:text-white leading-none tracking-tight items-center inline-flex">
                                Quran by Surah
                            </h2>
                            <p class="mt-2 text-gray-100 dark:text-gray-400 text-sm leading-relaxed">
                                อัลกุรอานแบ่งตามซูเราะฮฺ
                            </p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('get-quran-by-page', ['page' => 1, 'showTranslation' => true, 'showComment' => true]) }}" class="scale-100 p-6 bg-blue-950 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-blue-700/50 via-transparent text-center dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-lg shadow-blue-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-950">
                    <div class="size-full">
                        <div class="w-full">
                            <h2 class="text-xl text-center font-bold text-gold-400 dark:text-white leading-none tracking-tight items-center inline-flex">
                                Quran by Pages
                            </h2>
                            <p class="mt-2 text-gray-100 dark:text-gray-400 text-sm leading-relaxed">
                                อัลกุรอานแบ่งตาม​หน้า
                            </p>
                        </div>
                    </div>
                </a>
                <a href="#" class="scale-100 p-6 bg-blue-950 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-blue-700/50 via-transparent text-center dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-lg shadow-blue-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-950">
                    <div class="size-full">
                        <div class="w-full">
                            <h2 class="text-xl text-center font-bold text-gold-400 dark:text-white leading-none tracking-tight items-center inline-flex">
                                Quran by Subject Matters
                                <span class="flex-1 ms-3 whitespace-nowrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" data-tooltip-target="tooltip-lock">
                                          <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                <div id="tooltip-lock" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Coming Soon
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </h2>
                            <p class="mt-2 text-gray-100 dark:text-gray-400 text-sm leading-relaxed">
                                อัลกุรอานแบ่งตามหมวดหมู่​
                            </p>
                        </div>
                    </div>
                </a>
                <a href="https://booking.thaiquran.com/" target="_blank" class="scale-100 p-6 bg-gold-950 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-blue-700/50 via-transparent text-center dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-lg shadow-blue-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-950">
                    <div class="size-full">
                        <div class="w-full">
                            <h2 class="text-xl text-center font-bold text-blue-950 dark:text-white leading-none tracking-tight items-center inline-flex">
                                Order Free ThaiQuran
                            </h2>
                            <p class="mt-2 text-blue-950 dark:text-gray-400 text-sm leading-relaxed">
                                (Stay update on when the next batch opens!)
                            </p>
                        </div>
                    </div>
                </a>
                <a href="https://booking.thaiquran.com/login-guest" target="_blank" class="scale-100 p-6 bg-gold-950 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-blue-700/50 via-transparent text-center dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-lg shadow-blue-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-950">
                    <div class="size-full">
                        <div class="w-full">
                            <h2 class="text-xl text-center font-bold text-blue-950 dark:text-white leading-none tracking-tight items-center inline-flex">
                                Sign In / Register
                            </h2>
                            <p class="mt-2 text-blue-950 dark:text-gray-400 text-sm leading-relaxed">
                                (Create an account and claim your free ThaiQuran)
                            </p>
                        </div>
                    </div>
                </a>
                <a href="http://thaiquran.org/" target="_blank" class="scale-100 p-6 bg-blue-950 dark:bg-gray-800/50 dark:bg-gradient-to-bl from-blue-700/50 via-transparent text-center dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-lg shadow-blue-500/20 dark:shadow-none transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-950">
                    <div class="size-full">
                        <div class="w-full">
                            <h2 class="text-xl text-center font-bold text-gold-400 dark:text-white leading-none tracking-tight items-center inline-flex">
                                Home
                            </h2>
                            <p class="mt-2 text-gray-100 dark:text-gray-400 text-sm leading-relaxed">
                                (thaiquran.org)
                            </p>
                        </div>
                    </div>
                </a>
        </div>
    </div>
</div>
