<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Place;
use Carbon\Carbon;

class EventController extends Controller
{
    public function show()
    {
        return view("calendars/calendar");
    }

    public function get(Request $request)
    {
        $request->validate([
            'start_date' => 'required|numeric',
        ]);

        // `start_date` を `YYYY-MM-DD` に変換
        $start_date = Carbon::createFromTimestampMs($request->input('start_date'))->toDateString();

        // ログインユーザーの `places` からデータを取得
        $places = Auth::user()->places()
            ->whereDate('study_date', '>=', $start_date) // `study_date` を基準に検索
            ->select('id', 'title', 'body','study_date as start') // FullCalendar に適した形式に変更
            ->get();

        return response()->json($places);
    }
}
