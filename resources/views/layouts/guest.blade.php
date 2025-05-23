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
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                <!-- Logo Container -->
                <div class="flex justify-center mb-6"> <!-- Added margin-bottom (mb-6) for spacing -->
                    <a class="block">
                        <img 
                            src="https://i.postimg.cc/L4Lp4JqL/Whats-App-Image-2025-02-11-at-10-38-33-526755f1-1-Copy-removebg-preview.png" 
                            class="h-16 w-auto" Increased size to h-16 (4rem)
                            alt="Logo"
                        />
                    </a>
                </div>
    
                <!-- Content Slot -->
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
