import axios from "axios";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";

// カレンダーを表示させたいタグのidを取得
const calendarEl = document.getElementById("calendar");

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
    });

    // カレンダーのレンダリング
    calendar.render();
}
``;
