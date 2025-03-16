<x-app-layout>
  <div class="max-w-4xl mx-auto p-4">
    <!-- タイトルと新規投稿ボタン -->
    <div class="flex items-center space-x-2">
      <h1 class="text-xl font-bold text-gray-800">📌 投稿一覧</h1>
      <a href="/places/create" class="bg-green-500 text-black px-2 py-1 rounded hover:bg-green-600 transition">
        ➕ 新規投稿
      </a>
    </div>

    <!-- フィルター & 並び替え -->
    <div class="flex flex-wrap justify-between items-center mt-2 bg-gray-100 p-2 rounded">
      <form method="GET" action="" class="flex flex-wrap space-x-1">
        <!-- カテゴリーフィルター -->
        <select name="category" class="border px-2 py-1 rounded bg-white text-sm">
          <option value="">📂 すべて</option>

          @foreach($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>

        <!-- 並び替えオプション -->
        <select name="sort" class="border px-2 py-1 rounded bg-white text-sm">
          <option value="1">📅 最新順</option>
          <option value="2">📅 古い順</option>
          <option value="3">🔤 タイトル順</option>
        </select>

        <button type="submit" class="bg-blue-500 text-black px-3 py-1 text-sm rounded hover:bg-blue-600 transition">
          🔍 検索
        </button>
      </form>
    </div>

    <!-- 投稿リスト -->
    <div class="mt-3 bg-white shadow rounded p-2 divide-y">
      @foreach ($places as $place)
      <div class="py-1 flex justify-between items-center">
        <div>
          <a href="/places/{{ $place->id }}" class="text-sm font-semibold text-blue-600 hover:underline">
            {{ $place->title }}
          </a>
          <p class="text-xs text-gray-500">📅 {{ $place->study_date }}</p>
        </div>

        <div class="flex flex-col items-end space-y-1">
          @if (in_array($place->id, $exists))
          <form action="/places/{{$place->id}}/bookmark" method="POST">
            <input type="hidden" name="place_id" value="{{$place->id}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-xs bg-red-500 text-white px-2 py-1 rounded">ブックマーク解除</button>
          </form>
          @else
          <form action="/places/{{$place->id}}/bookmark" method="POST">
            @csrf
            <input type="hidden" name="place_id" value="{{$place->id}}">
            <button type="submit" class="text-xs bg-green-500 text-white px-2 py-1 rounded">ブックマーク</button>
          </form>
          @endif

          <div class="flex space-x-1">
            <!-- 編集ボタン -->
            <a href="/places/{{ $place->id }}/edit" class="text-xs bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600">編集</a>

            <!-- 削除ボタン -->
            <form action="/places/{{ $place->id }}/delete" method="POST" onsubmit="return confirm('本当に削除しますか？');">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-xs bg-gray-500 text-white px-2 py-1 rounded hover:bg-gray-600">削除</button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
      <div class="py-1">
        <a href="#" class="text-sm font-semibold text-blue-600 hover:underline">
          【デザイン】UI/UXの基本
        </a>
        <p class="text-xs text-gray-500">📅 2024-02-18</p>
      </div>
      <div class="py-1">
        <a href="#" class="text-sm font-semibold text-blue-600 hover:underline">
          【ライフスタイル】朝活のメリット
        </a>
        <p class="text-xs text-gray-500">📅 2024-02-15</p>
      </div>

    </div>


    <!-- ページネーション -->
    <div class="mt-2 flex justify-center space-x-1">
      <button class="bg-gray-300 text-gray-700 px-2 py-1 text-sm rounded">◀️ 前へ</button>
      <button class="bg-gray-300 text-gray-700 px-2 py-1 text-sm rounded">1</button>
      <button class="bg-gray-300 text-gray-700 px-2 py-1 text-sm rounded">2</button>
      <button class="bg-gray-300 text-gray-700 px-2 py-1 text-sm rounded">3</button>
      <button class="bg-gray-300 text-gray-700 px-2 py-1 text-sm rounded">次へ ▶️</button>
    </div>
  </div>

</x-app-layout>