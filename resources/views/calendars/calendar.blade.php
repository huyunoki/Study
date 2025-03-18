<!-- calendar.blade.php -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
</style>

<x-app-layout>
    <!-- カレンダー -->
    <div id='calendar'></div>

    <!-- モーダル -->
    <div id="easyModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-1/2 border border-gray-300 shadow-lg rounded-md overflow-hidden animate-fadeIn">
            <!-- ヘッダー -->
            <div class="bg-gray-200 px-4 py-3 flex items-center justify-between">
                <p class="text-gray-800 font-bold text-lg text-center flex-1" id="title" name="event_title"></p>
                <button type="button" class="text-xl font-bold text-gray-600 hover:text-gray-800 transition modalClose">
                    &times;
                </button>
            </div>

            <!-- コンテンツ -->
            <div class="p-2">
                <!-- ボタン -->
                <div class="flex justify-end space-x-2">
                    <button id="openBtn"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-600 transition"
                        href="#">
                        開く
                    </button>
                    <button id="editBtn"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-600 transition"
                        href="#">
                        編集
                    </button>
                    <button id="deleteBtn"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-600 transition"
                        href="#">
                        削除
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
