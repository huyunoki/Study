<x-app-layout>

    <div class="max-w-4xl mx-auto p-6">
        <!-- タイトルと新規投稿ボタンをより近く配置 -->
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-gray-800">📌 投稿一覧</h1>
            <a href="/places/create" class="bg-green-500 text-black px-3 py-1.5 rounded-lg hover:bg-green-600 transition">
                ➕ 新規投稿
            </a>
        </div>

        <!-- フィルター & 並び替え -->
        <div class="flex flex-wrap justify-between items-center mt-4 bg-gray-100 p-3 rounded-lg">
            <form method="GET" action="#" class="flex flex-wrap space-x-2">
                <!-- カテゴリーフィルター -->
                <select name="category" class="border px-3 py-2 rounded bg-white">
                    <option value="">📂 すべてのカテゴリー</option>
                    <option value="1">プログラミング</option>
                    <option value="2">デザイン</option>
                    <option value="3">ライフスタイル</option>
                </select>

                <!-- 並び替えオプション -->
                <select name="sort" class="border px-3 py-2 rounded bg-white">
                    <option value="latest">📅 最新順</option>
                    <option value="oldest">📅 古い順</option>
                    <option value="title">🔤 タイトル順</option>
                </select>

                <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600 transition">
                    🔍 検索
                </button>
            </form>
        </div>

        <!-- 投稿リスト -->
        <div class="mt-6 bg-white shadow-md rounded-lg p-4 divide-y">
            @foreach ($places as $place)
            <div class="py-3">
                <a href="/places/{{ $place->id }}" class="text-lg font-semibold text-blue-600 hover:underline">
                    {{ $place->title }}
                </a>
                <p class="text-sm text-gray-500">📅 投稿日: {{ $place->created_at->format('Y-m-d') }}</p>
            </div>
            @endforeach

            <!-- サンプルデータ -->
            <div class="py-3">
                <a href="#" class="text-lg font-semibold text-blue-600 hover:underline">
                    【デザイン】UI/UXの基本
                </a>
                <p class="text-sm text-gray-500">📅 投稿日: 2024-02-18</p>
            </div>
            <div class="py-3">
                <a href="#" class="text-lg font-semibold text-blue-600 hover:underline">
                    【ライフスタイル】朝活のメリット
                </a>
                <p class="text-sm text-gray-500">📅 投稿日: 2024-02-15</p>
            </div>
        </div>

        <!-- ページネーション -->
        <div class="mt-4 flex justify-center space-x-2">
            <button class="bg-gray-300 text-gray-700 px-3 py-1 rounded">◀️ 前へ</button>
            <button class="bg-gray-300 text-gray-700 px-3 py-1 rounded">1</button>
            <button class="bg-gray-300 text-gray-700 px-3 py-1 rounded">2</button>
            <button class="bg-gray-300 text-gray-700 px-3 py-1 rounded">3</button>
            <button class="bg-gray-300 text-gray-700 px-3 py-1 rounded">次へ ▶️</button>
        </div>
    </div>

</x-app-layout>