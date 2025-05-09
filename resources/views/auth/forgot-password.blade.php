<x-guest-layout>


    <h1 class="text-2xl font-semibold text-center mb-6">
        <span class="flex items-center justify-center gap-2">
            <i class="fa-solid fa-envelope-circle-check"></i>
            パスワード再設定
        </span>
    </h1>

    <div class="mb-4 text-sm text-gray-600 text-center">
        パスワードをお忘れですか？ご安心ください。ご登録のメールアドレスを入力いただければ、パスワード再設定用のリンクをお送りします。
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-green-600 text-sm text-center" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4 relative">
            <x-text-input id="email" class="block w-full pl-10 py-2 border border-gray-300 rounded"
                type="email"
                name="email"
                :value="old('email')"
                placeholder="メールアドレス"
                required autofocus />
            <i class="fa-solid fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-500" />
        </div>

        <x-primary-button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded">
            {{ __('パスワード再設定リンクを送信') }}
        </x-primary-button>
    </form>
</x-guest-layout>