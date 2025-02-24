<?php

namespace App\Http\Controllers;

use App\Helpers\MarkdownHelper;
use App\Models\Place;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use League\CommonMark\CommonMarkConverter;

class PlaceController extends Controller
{

    public function index(Place $place)
    {

        $user = \Auth::user(); // 現在のログインユーザーを取得
        $places = $user->places()->orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('places'));
    }


    public function create()
    {
        return view('place.create');
    }

    public function store(Request $repuest, Place $place)
    {
        // dd($repuest);
        $input = $repuest['place'];
        $place->user_id = Auth::id();
        $place->fill($input)->save();
        return redirect('/place');
    }

    public function show($id)
    {

        $place = Place::find($id);
        // dd($place->body);
        $converter = new CommonMarkConverter();
        $place->body = $converter->convertToHtml($place->body);

        return view('place.show', compact('place'));
    }
}
