import axios from "axios";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";

// カレンダーを表示させたいタグのidを取得
const calendarEl = document.getElementById("calendar");

//カレンダー表示させる
if (calendarEl) {
    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin],
        initialView: "dayGridMonth",
        headerToolbar: {
            start: "prev,next today",
            center: "title",
            end: "dayGridMonth,timeGridWeek",
        },
        height: "auto",

        events: function (info, successCallback, failureCallback) {
            const startDate = info.start.valueOf(); // タイムスタンプ (ミリ秒)

            
            // ✅ 送信データを確認
            console.log("🚀 送信データ (start_date):", startDate);

            axios
                .post("/calendar/get", {
                    start_date: startDate,
                })
                .then((response) => {
                    // ✅ レスポンスデータを確認
                    console.log("✅ 成功: ", response.data);

                    // 既に表示されているイベントを削除（重複防止）
                    calendar.removeAllEvents();

                    // カレンダーに読み込み
                    successCallback(response.data);
                })
                .catch((error) => {
                    console.error(
                        "🚨 エラー: ",
                        error.response ? error.response.data : error
                    );
                    alert("登録に失敗しました。");
                });
            },

            eventClick: function(info) {
                const modal = document.getElementById('easyModal');
                const buttonClose = document.getElementsByClassName('modalClose')[0];

                // console.log(info.event); // info.event内に予定の全情報が入っているので、必要に応じて参照すること
                document.getElementById("title").innerText = info.event.title;

                //項目をクリックした際のモーダル表示
                // modal.style.display = 'block';
                modal.classList.remove("hidden");
                modal.classList.add("flex");
                
                // バツ印がクリックされた時     
                buttonClose.addEventListener('click', modalClose);
                function modalClose() {
                    // modal.style.display = 'none';
                    modal.classList.add("hidden");
                    modal.classList.remove("flex"); // ← これも重要！
                }

                // モーダルコンテンツ以外がクリックされた時
                addEventListener('click', outsideClose);
                function outsideClose(e) {
                    if (e.target == modal) {
                        // modal.style.display = 'none';
                        modal.classList.add("hidden");
                        modal.classList.remove("flex"); // ← これも重要！
                    }
                }

                // ボタンの href を更新
                document.getElementById("openBtn").href = `/places/${info.event.id}`;
                document.getElementById("editBtn").href = `/places/${info.event.id}/edit`;
                document.getElementById("deleteBtn").href = `/places/${info.event.id}/delete`;
            },
        }); 
        // カレンダーのレンダリング
        calendar.render();
}