<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ config('app.name') }} | {{ $title ?? 'Page Title' }}</title>

        <!-- Icons -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="container mx-auto p-6 lg:p-8">
            {{ $slot }}

            <footer class="my-4">
                <div class="w-full max-w-screen-xl mx-auto py-4 md:py-8">
                    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                    <span class="block text-sm text-gray-500 text-center dark:text-gray-400">Quran text provided by: <a href="http://tanzil.net/" class="hover:underline">Tanzil.net</a></span>
                    <span class="block pt-1 text-sm text-gray-500 text-center dark:text-gray-400">Quran Thai-translation and commentary provided by: <a href="http://tanzil.net/" class="hover:underline">Arab Thai Alumni University</a></span>
                    <span class="block pt-1 text-sm text-gray-500 text-center dark:text-gray-400">Quran Recitations by: Mishary Rashid Alafasy (<a href="https://versebyversequran.com/" class="hover:underline">www.versebyversequran.com</a>)</span>
                    <span class="block pt-1 text-sm text-gray-500 text-center dark:text-gray-400">Website provided by: Thaiquran Foundation (<a href="https://thaiquran.org" class="hover:underline">www.thaiquran.org</a>)</span>
                </div>
            </footer>

        </div>
    </div>

    <script>
        function play(id) {
            let playAudio = document.getElementById('playAudio-' + id);
            let iconPlay = document.getElementById('iconPlay-' + id);
            let iconPause = document.getElementById('iconPause-' + id);

            if (playAudio.paused) {
                document.querySelectorAll('audio').forEach(el => el.pause());
                document.querySelectorAll('[id*="iconPlay"]').forEach(el => el.classList.remove('hidden'));
                document.querySelectorAll('[id*="iconPause"]').forEach(el => el.classList.add('hidden'));

                playAudio.play();
                iconPlay.classList.add('hidden');
                iconPause.classList.remove('hidden');

                playAudio.addEventListener('ended', function () {
                    playAudio.currentTime = 0;
                    iconPlay.classList.remove('hidden');
                    iconPause.classList.add('hidden');
                });
            } else {
                playAudio.pause();
                iconPlay.classList.remove('hidden');
                iconPause.classList.add('hidden');
            }
        }
    </script>
    </body>
</html>
