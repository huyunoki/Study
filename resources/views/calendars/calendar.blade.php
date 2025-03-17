<!-- calendar.blade.php -->
 <style>
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
  .animate-fadeIn {
    animation: fadeIn 1s ease-in-out;
  }

#easyModal {
  position: fixed !important;
}
</style>

<x-app-layout>
    <!-- 以下のdivタグ内にカレンダーを表示 -->
    <div id='calendar'></div>


    <div id="easyModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-gray-100 w-1/2 shadow-lg animate-fadeIn p-4">
        <div class="bg-blue-300 p-3 flex justify-between items-center">
            <p class="input-title" id="title" name="event_title"></p>
            <button type="button" class="cursor-pointer modalClose">&times;</button>
        </div>
        <div class="p-4">
            <input type="hidden" id="id" name="id" value="" />
            <!-- <p id="body"></p> -->
            <div class="mt-4 flex justify-end space-x-3">
                <button id="editBtn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">編集</button>
                <button id="deleteBtn" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">削除</button>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
