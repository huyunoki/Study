<head>
   <!-- EasyMDE -->
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
    @vite(['resources/js/markdown.js'])
    <style>
      .CodeMirror .cm-spell-error:not(.cm-url):not(.cm-comment):not(.cm-tag):not(.cm-word) {
          background: transparent !important;
      }
    </style>
</head>
<x-app-layout>
  <div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
  <h1 class="text-2xl font-bold text-gray-800 mb-4">📌 新規投稿作成</h1>

  <div class="w-full px-2">
    <div class="bg-gray-100 p-4 rounded-lg">
      <form id="postForm" action="/places/store" method="POST">
        @csrf
        
        <div class="flex justify-between items-center mb-3">
          <h2 class="text-xl font-semibold text-gray-800">📝 投稿フォーム</h2>
          <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600 transition">
            ✅ 投稿する
          </button>
        </div>

        <div class="mb-3">
          <label for="title" class="block text-gray-700 font-semibold">📌 タイトル</label>
          <input type="text" id="title" name="place[title]" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-3 flex space-x-2">
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

          <div class="w-1/3">
            <label for="study_date" class="block text-gray-700 font-semibold">📅 学習日</label>
            <input type="date" id="study_date" name="place[study_date]" class="w-full border px-3 py-2 rounded">
          </div>

          <div class="w-1/3">
            <label for="study_time" class="block text-gray-700 font-semibold">⏰ 学習時間</label>
            <input type="time" id="study_time" name="place[study_time]" class="w-full border px-3 py-2 rounded">
          </div>
        </div>

        <div class="mb-3">
          <label for="body" class="block text-gray-700 font-semibold">📖 内容</label>
          <textarea id="body" name="place[body]" class="w-full border px-3 py-2 rounded h-72"></textarea>
        </div>
      </form>
    </div>
  </div>
</div>

</x-app-layout>
