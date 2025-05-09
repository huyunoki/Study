<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>フユノキノート</title>

</head>

<body class="min-h-screen flex items-center justify-center bg-white text-gray-800">

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full max-w-md p-8 bg-white shadow-md border border-gray-200 rounded">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <h1 class="text-2xl font-semibold text-center mb-6 flex items-center justify-center gap-2">
                <i class="fa-solid fa-lock"></i>
                ログイン
            </h1>

            <!-- Email Address -->
            <div class="mb-4 relative">
                <x-text-input id="email" class="block w-full pl-10 py-2 border border-gray-300 rounded"
                    placeholder="例） store@balmuda.com"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autofocus autocomplete="username" />
                <i class="fa-solid fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Password -->
            <div class="mb-4 relative">
                <x-text-input id="password" class="block w-full pl-10 py-2 border border-gray-300 rounded"
                    placeholder="パスワード（8文字以上）"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                <i class="fa-solid fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="mb-4 flex justify-between items-center text-sm">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="mr-1">
                    <span>{{ __('Remember me') }}</span>
                </label>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">
                    パスワードをお忘れの方 ？
                </a>
                @endif
            </div>

            <x-primary-button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded">
                {{ __('ログイン') }}
            </x-primary-button>
        </form>

        <div class="mt-6 text-center text-sm">
            <p class="mb-1">はじめてご利用の方</p>
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline font-semibold">
                アカウントの作成（新規登録）
            </a>
        </div>
    </div>

</body>


</html>