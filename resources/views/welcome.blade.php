<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} | Welcome</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-50 min-h-screen">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.206 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.794 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.794 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.206 18 16.5 18s-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                        <span class="text-xl font-bold text-gray-800 tracking-wide">
                            {{ config('app.name', 'SIS') }}
                        </span>
                    </a>
                </div>

                <div class="flex items-center space-x-3">
                    @auth
                        <a href="{{ route('admin.students.index') }}"
                            class="text-sm text-gray-700 hover:text-blue-600 font-medium transition duration-150 ease-in-out">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm text-gray-700 hover:text-blue-600 font-medium transition duration-150 ease-in-out">
                            Log in
                        </a>

                        {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                Register
                            </a>
                        @endif --}}
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-16 pb-24 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-3">
                Modern Academic Management
            </p>
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-gray-900 tracking-tight leading-tight mb-6">
                Welcome to the <br class="sm:hidden">
                <span class="text-blue-600 border-b-4 border-blue-500">Student Information System</span>
            </h1>
            <p class="text-xl sm:text-2xl text-gray-600 max-w-3xl mx-auto mb-10">
                A streamlined platform for managing student data, academic records, and administrative tasks with
                precision and ease.
            </p>

            @auth
                <a href="{{ route('admin.students.index') }}"
                    class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                    Go to Dashboard
                </a>
            @else
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3v-1m18-6v-1a3 3 0 00-3-3H6a3 3 0 00-3 3v1">
                            </path>
                        </svg>
                        Admin Login
                    </a>
                    {{-- @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-10 py-4 border border-blue-600 text-lg font-medium rounded-lg text-blue-600 bg-white hover:bg-blue-50 transition duration-300 ease-in-out transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM12 18H5a2 2 0 01-2-2v-2c0-.59.26-.96.6-1.2l1.65-1.1c.42-.28.97-.28 1.39 0l1.65 1.1c.34.24.6.61.6 1.2v2a2 2 0 01-2 2z"></path></svg>
                            Register Account
                        </a>
                    @endif --}}
                </div>
            @endauth
        </div>
    </main>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-extrabold text-gray-900 text-center mb-16">
                Key Features for Efficient Management
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                <div
                    class="text-center p-8 bg-white border-t-4 border-blue-600 rounded-lg shadow-xl hover:shadow-2xl transition duration-300">
                    <div
                        class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">
                        Centralized Data
                    </h3>
                    <p class="text-gray-600">
                        Manage student profiles, enrollment status, and personal details from a single, secure location.
                    </p>
                </div>

                <div
                    class="text-center p-8 bg-white border-t-4 border-gray-500 rounded-lg shadow-xl hover:shadow-2xl transition duration-300">
                    <div
                        class="flex items-center justify-center h-16 w-16 rounded-full bg-gray-100 text-gray-600 mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 8v8m-4-5v5m-4-2v2m13-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">
                        Simple System
                    </h3>
                    <p class="text-gray-600">
                        Easily manage and update student information, attendance, and progress with a simple system.
                    </p>

                </div>

                <div
                    class="text-center p-8 bg-white border-t-4 border-indigo-600 rounded-lg shadow-xl hover:shadow-2xl transition duration-300">
                    <div
                        class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">
                        Built with Laravel & Tailwind
                    </h3>
                    <p class="text-gray-600">
                        Enjoy a fast, secure, and modern application experience with a clean, responsive design.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-lg font-semibold mb-3">
                {{ config('app.name', 'SIS') }}
            </p>
            <p class="text-sm text-gray-400">
                &copy; {{ date('Y') }} All rights reserved.
            </p>

        </div>
    </footer>

</body>

</html>
