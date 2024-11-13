<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
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

<script>

    let colors = [[62, 35, 255],
        [60, 255, 60],
        [255, 35, 98],
        [45, 175, 230],
        [255, 0, 255],
        [255, 128, 0]];

    let step = 0;

    let colorIndices = [0,1,2,3];

    //transition speed
    let gradientSpeed = 0.002;

    function updateGradient()
    {

        if ( $===undefined ) return;

        let c0_0 = colors[colorIndices[0]];
        let c0_1 = colors[colorIndices[1]];
        let c1_0 = colors[colorIndices[2]];
        let c1_1 = colors[colorIndices[3]];

        let istep = 1 - step;
        let r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
        let g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
        let b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
        let color1 = "rgb("+r1+","+g1+","+b1+")";

        let r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
        let g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
        let b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
        let color2 = "rgb("+r2+","+g2+","+b2+")";

        $('#gradient').css({
            background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
            background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});

        step += gradientSpeed;
        if ( step >= 1 )
        {
            step %= 1;
            colorIndices[0] = colorIndices[1];
            colorIndices[2] = colorIndices[3];

            //pick two new target color indices
            //do not pick the same as the current one
            colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
            colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;

        }
    }

    setInterval(updateGradient,10);

</script>
