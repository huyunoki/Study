<?php

namespace App\Http\Controllers;

use App\Helpers\MarkdownHelper;
use App\Models\Place;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\PlaceRequest;
use League\CommonMark\CommonMarkConverter;

class PlaceController extends Controller
{

    public function index(Place $place,Bookmark $bookmark)
    {
        

        $user = \Auth::user(); // 現在のログインユーザーを取得
        $places = $user->places()->orderBy('created_at', 'desc')->get();

        // ユーザーがブックマークしている place_id のリストを取得
        $exists = Bookmark::where('user_id', $user->id)->pluck('place_id')->toArray();

        return view('places.index', compact('places','exists'));
    }


    public function create()
    {
        return view('places.create');
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

        return view('places.show', compact('place'));
    }

    public function edit($id)
    {
        $place = Place::find($id);
        // dd($place);
        return view('places.edit',compact('place'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $place = Place::find($id);
        $input = $request['place'];
        $place->user_id = Auth::id();

        $place->fill($input)->save();
        return redirect('/place');
    }

    public function delete($id)
    {
        $place=Place::find($id);
        $place->delete();

        return redirect('/place');
    }
}
