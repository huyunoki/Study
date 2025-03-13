<x-app-layout>
  <div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">📌 編集</h1>

    <div x-data="{ 
      title: @js(old('place.title', $place->title ?? '')), 
      body: @js(old('place.body', $place->body ?? '')) 
    }" class="flex flex-wrap -mx-2">

      <!-- 左カラム (入力フォーム) -->
      <div class="w-full md:w-1/2 px-2">
        <div class="bg-gray-100 p-4 rounded-lg">
          <h2 class="text-xl font-semibold text-gray-800 mb-3">📝 投稿フォーム</h2>
          <form action="/places/{{ $place->id }}\update" method="POST">
            @csrf
            @method('PUT')

            <!-- タイトル -->
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


</x-app-layout>

<!-- マークダウン変換用のスクリプト -->
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>