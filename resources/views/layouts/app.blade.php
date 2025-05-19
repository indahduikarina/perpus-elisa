<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        :root {
            --pink-light: #fdd3e6; /* Light pink */
            --pink-soft:rgb(236, 72, 153);  /* Soft pink */
            --pink-dark:rgb(245, 224, 230);  /* Darker pink */
        }
    </style>
</head>
<body class="font-sans antialiased bg-[var(--pink-light)]">

    <div class="min-h-screen bg-[var(--pink-light)] dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading (Header section) -->
        @isset($header)
            <header class="bg-[var(--pink-soft)] dark:bg-[var(--pink-dark)] shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Main content section -->
        <main>
            @yield('content') {{-- Main Content here --}}
        </main>

    </div>
</body>
</html>
