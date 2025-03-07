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

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
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
    <!-- モーダル -->
    <div id="category-modal"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
        x-data="{ open: false }"
        x-show="open"
        x-on:open-modal.window="open = true"
        x-on:click.away="open = false"
        x-transition.opacity.duration.300ms
        style="display: none;">

        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold text-gray-700">カテゴリを追加</h2>

            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <input type="text" name="name" class="border px-3 py-2 rounded w-full mt-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="カテゴリ名" required>

                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400"
                        x-on:click="open = false">
                        キャンセル
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"
                        x-on:click="open = false">
                        追加
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            window.dispatchEvent(new CustomEvent('open-modal'));
        }
    </script>
</body>

</html>