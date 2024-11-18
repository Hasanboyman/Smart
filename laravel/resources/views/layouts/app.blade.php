<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Smart English') }}</title>
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
        <link rel="icon" href="{{ asset('smart_ico.png') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased" id="gradient">
        <x-banner />

        <div class="min-h-screen bg-transparent">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header style="background: linear-gradient(15deg, black, transparent)" class="bg-transparent  shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
<script src="https://kit.fontawesome.com/6d6de8a581.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let step = 0;
        let gradientSpeed = 0.02;
        let backgroundImage = '{{ session("background_image") }}'; // Initial background image from the server.

        // Default gradient colors
        const defaultColors = [
            [236, 255, 220],
            [236, 255, 220],
            [236, 255, 220],
            [236, 255, 220],
            [236, 255, 220],
            [236, 255, 220]
        ];

        // Utility to generate random colors
        function generateRandomColor() {
            return [
                Math.floor(Math.random() * 256),
                Math.floor(Math.random() * 256),
                Math.floor(Math.random() * 256)
            ];
        }

        // Function to apply dynamic gradient
        function dynamicGradient() {
            if (defaultColors.length < 4) return;

            const c0_0 = defaultColors[0];
            const c0_1 = defaultColors[1];
            const c1_0 = defaultColors[2];
            const c1_1 = defaultColors[3];

            const istep = 1 - step;
            const r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
            const g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
            const b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
            const color1 = `rgb(${r1},${g1},${b1})`;

            const r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
            const g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
            const b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
            const color2 = `rgb(${r2},${g2},${b2})`;

            // Check if a background image exists
            if (backgroundImage) {
                document.body.style.background = `url('/storage/${backgroundImage}') no-repeat center center fixed`;
                document.body.style.backgroundSize = 'cover';
            } else {
                document.body.style.background = `linear-gradient(to right, ${color1}, ${color2})`;
            }

            step += gradientSpeed;
            if (step >= 1) {
                step %= 1;
                defaultColors[0] = defaultColors[1];
                defaultColors[2] = defaultColors[3];

                defaultColors[1] = generateRandomColor();
                defaultColors[3] = generateRandomColor();
            }
        }


        // Interval for linear gradient
        setInterval(dynamicGradient, 200);

    });
</script>


