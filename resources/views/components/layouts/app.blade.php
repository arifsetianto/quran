<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- PWA  -->
        <meta name="theme-color" content="#f3f4f6"/>
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">

        <title>{{ config('app.name') }} | {{ $title ?? 'Page Title' }}</title>

        <!-- Icons -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">

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
                    <span class="block text-sm text-gray-500 text-center dark:text-gray-400">
                        <div class="flex justify-between items-center">
                            <span>Copyright © {{ date('Y') }} by ThaiQuran Foundation. All Rights Reserved.</span>
                            <span>
                                <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                            </span>
                        </div>
                    </span>
                </div>
            </footer>
        </div>
    </div>

    <script>
        const audioContainers = document.querySelectorAll('.audioContainer');
        const audioElements = document.querySelectorAll('.audioContainer audio');
        const playPauseButtons = document.querySelectorAll('.playPauseButton');
        let currentAudio = null;

        function playAudio(audioElement, playPauseButton) {
            if (currentAudio !== audioElement) {
                // Pause currently playing audio, if any
                if (currentAudio) {
                    currentAudio.pause();
                    currentAudio.currentTime = 0; // Reset to the beginning
                    const currentPlayPauseButton = currentAudio.parentElement.querySelector('.playPauseButton');
                    const currentPlayIcon = currentPlayPauseButton.querySelector('.playIcon');
                    currentPlayIcon.innerHTML = '<path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd"/>';
                }
                // Play new audio
                audioElement.play().then(() => {
                    // If successfully played, update the currentAudio
                    currentAudio = audioElement;
                    const playIcon = playPauseButton.querySelector('.playIcon');
                    playIcon.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    playIcon.innerHTML = '<path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 0 1 .75-.75H9a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25Zm7.5 0A.75.75 0 0 1 15 4.5h1.5a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H15a.75.75 0 0 1-.75-.75V5.25Z" clip-rule="evenodd"/>';
                }).catch(error => {
                    // Handle error if unable to play
                    console.log('Failed to play audio:', error);
                });
            } else {
                // Pause if the same audio is clicked again
                if (audioElement.paused) {
                    // Check if the audio is paused before playing
                    audioElement.play().then(() => {
                        // If successfully played, update the currentAudio
                        currentAudio = audioElement;
                        const playIcon = playPauseButton.querySelector('.playIcon');
                        playIcon.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        playIcon.innerHTML = '<path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 0 1 .75-.75H9a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25Zm7.5 0A.75.75 0 0 1 15 4.5h1.5a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H15a.75.75 0 0 1-.75-.75V5.25Z" clip-rule="evenodd"/>';
                    }).catch(error => {
                        // Handle error if unable to play
                        console.log('Failed to play audio:', error);
                    });
                } else {
                    audioElement.pause();
                    audioElement.currentTime = 0; // Reset to the beginning
                    currentAudio = null;
                    const playIcon = playPauseButton.querySelector('.playIcon');
                    playIcon.innerHTML = '<path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd"/>';
                }
            }
        }

        function handleAudioEnded(audioElement, playPauseButton, index) {
            audioElement.addEventListener('ended', function() {
                currentAudio = null;
                audioElement.currentTime = 0; // Reset to the beginning when audio ends
                const playIcon = playPauseButton.querySelector('.playIcon');
                playIcon.innerHTML = '<path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd"/>';
                playSequentially(index + 1);
            });
        }

        function playSequentially(index) {
            if (index < audioElements.length) {
                const audio = audioElements[index];
                const playPauseButton = playPauseButtons[index];
                playAudio(audio, playPauseButton);
                handleAudioEnded(audio, playPauseButton, index);
            }
        }

        audioContainers.forEach((container, index) => {
            const playPauseButton = playPauseButtons[index];
            playPauseButton.addEventListener('click', function() {
                playSequentially(index);
            });
        });
    </script>

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>
    </body>
</html>
