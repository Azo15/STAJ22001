<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Yazı Tipleri -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scriptler -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50 selection:bg-fuchsia-500 selection:text-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-indigo-50 via-white to-fuchsia-50 relative overflow-hidden">
            
            <!-- Background Decorations -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 right-0 w-64 h-64 bg-sky-500/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-1/3 w-80 h-80 bg-pink-500/20 rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 flex flex-col items-center">
                <a href="/" class="flex flex-col items-center group">
                    <div class="h-20 w-20 rounded-2xl bg-gradient-to-br from-indigo-600 to-fuchsia-600 flex items-center justify-center shadow-lg shadow-indigo-500/30 transform group-hover:rotate-6 transition-all duration-300">
                        <span class="text-4xl">📚</span>
                    </div>
                    <span class="mt-4 text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-fuchsia-600">BRS SYSTEM</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-8 py-8 bg-white/70 backdrop-blur-xl border border-white/50 shadow-xl shadow-indigo-100/50 sm:rounded-2xl relative z-10">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-xs text-slate-400 relative z-10">
                &copy; {{ date('Y') }} Library Management System
            </div>
        </div>
    </body>
</html>
