<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Job Website') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full">
    <div class="min-h-full flex flex-col">
        <!-- Navigation Bar -->
        @include('layouts.partials.navigation')

        @if (isset($header))
            <!-- Page Heading -->
            <header class="bg-white shadow border-b border-white/10">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex align-center justify-between">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="mx-auto flex flex-col max-w-7xl py-6 sm:px-6 lg:px-8 flex-auto w-full">
            {{ $slot }}
        </main>

        <!-- Page Footer -->
        @include('layouts.partials.footer')
    </div>
</body>

</html>
