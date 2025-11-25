<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
@props(['auth' => false])

@if($auth)
    <header class="w-full bg-gray-800 text-sm p-2 not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a
                            href="{{ url('/dashboard') }}"
                            class="inline-block px-5 py-1.5 text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border  dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                    >
                        Dashboard
                    </a>
                @else
                    <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 text-[#EDEDEC]  border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                    >
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border  dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
@endif
<div @class([
    'min-h-screen flex flex-col justify-center items-center',
    'bg-gray-800' => $auth,
])>
    <div class="w-full overflow-hidden sm:rounded-lg flex justify-center items-center">
        {{ $slot }}
    </div>
</div>
</body>
</html>