<x-app-layout>
  <div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">📌 新規投稿作成</h1>

    <div x-data="{ title: '', body: ''}" class="flex flex-wrap -mx-2">
      <!-- 左カラム (入力フォーム) -->
      <div class="w-full md:w-1/2 px-2">
        <div class="bg-gray-100 p-4 rounded-lg">
          <h2 class="text-xl font-semibold text-gray-800 mb-3">📝 投稿フォーム</h2>
          <form action="/places/store" method="POST">
            @csrf

            <!-- タイトル (幅100%) -->
            <div class="mb-3">
              <label for="title" class="block text-gray-700 font-semibold">📌 タイトル</label>
              <input type="text" id="title" name="place[title]" class="w-full border px-3 py-2 rounded"
                x-model="title" required>
            </div>

            <!-- カテゴリ・学習日・学習時間 (3分割で横並び) -->
            <div class="mb-3 flex space-x-2">
              <!-- カテゴリ -->
              <div class="w-1/3">
                <label for="category" class="block text-gray-700 font-semibold">📂 カテゴリ</label>
                <select name="place[category_id]" class="w-full border px-3 py-2 rounded" x-data x-on:change="if ($el.value === 'new') { $dispatch('open-modal'); $el.value = '' }">
                  <option value="">📂 すべて</option>
                  <option value="new">🎈 新規作成</option>
                  @foreach($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>

              <!-- 学習日 -->
              <div class="w-1/3">
                <label for="study_date" class="block text-gray-700 font-semibold">📅 学習日</label>
                <input type="date" id="study_date" name="place[study_date]" class="w-full border px-3 py-2 rounded"
                  x-model="study_date">
              </div>

              <!-- 学習時間 -->
              <div class="w-1/3">
                <label for="study_time" class="block text-gray-700 font-semibold">⏰ 学習時間</label>
                <input type="time" id="study_time" name="place[study_time]" class="w-full border px-3 py-2 rounded"
                  x-model="study_time">
              </div>
            </div>

            <!-- マークダウン入力エリア -->
            <div class="mb-3">
              <label for="body" class="block text-gray-700 font-semibold">📖 内容</label>
              <textarea id="body" name="place[body]" class="w-full border px-3 py-2 rounded h-[300px]"
                x-model="body" required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600 transition">
              ✅ 投稿する
            </button>
          </form>
        </div>
      </div>

      <!-- 右カラム (リアルタイムプレビュー) -->
      <div class="w-full md:w-1/2 px-2">
        <div class="bg-gray-100 p-4 rounded-lg">
          <h2 class="text-xl font-semibold text-gray-800 mb-3">📝 投稿プレビュー</h2>

          <!-- タイトル表示 -->
          <div class="text-lg font-bold text-gray-800 mb-2" x-text="title">
            (タイトルがここに表示されます)
          </div>

          <hr class="my-3">

          <!-- マークダウン内容表示 -->
          <div class="border p-3 rounded bg-white text-gray-700 min-h-[300px]" x-html="marked.parse(body)">
            (内容がここに表示されます)
          </div>
        </div>
      </div>
    </div>
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



</x-app-layout>
<!-- マークダウン変換用のスクリプト -->
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>