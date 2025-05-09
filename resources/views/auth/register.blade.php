<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>新規登録画面</title>
</head>

<body class="min-h-screen flex items-center justify-center bg-white text-gray-800">

    <div class="w-full max-w-md p-8 bg-white shadow-md border border-gray-200 rounded">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <h1 class="text-2xl font-semibold text-center mb-6">
                <span class="flex items-center justify-center gap-2">
                    <i class="fa-solid fa-lock"></i>
                    新規登録
                </span>
            </h1>

            <!-- Name -->
            <div class="mb-4 relative">
                <x-text-input id="name" class="block w-full pl-10 py-2 border border-gray-300 rounded"
                    placeholder="お名前"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required autofocus autocomplete="name" />
                <i class="fa-solid fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Email -->
            <div class="mb-4 relative">
                <x-text-input id="email" class="block w-full pl-10 py-2 border border-gray-300 rounded"
                    placeholder="メールアドレス"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autocomplete="username" />
                <i class="fa-solid fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Password -->
            <div class="mb-4 relative">
                <x-text-input id="password" class="block w-full pl-10 py-2 border border-gray-300 rounded"
                    placeholder="パスワード（8文字以上）"
                    type="password"
                    name="password"
                    required autocomplete="new-password" />
                <i class="fa-solid fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6 relative">
                <x-text-input id="password_confirmation" class="block w-full pl-10 py-2 border border-gray-300 rounded"
                    placeholder="パスワード確認"
                    type="password"
                    name="password_confirmation"
                    required autocomplete="new-password" />
                <i class="fa-solid fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-500" />
            </div>

            <x-primary-button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded">
                {{ __('登録') }}
            </x-primary-button>
        </form>

        <div class="mt-6 text-center text-sm">
            <p class="mb-1">すでに登録済みの方</p>
            <a href="/login" class="text-blue-500 hover:underline font-semibold">ログイン画面はこちら</a>
        </div>
    </div>
</body>


</html>