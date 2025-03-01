<?php

namespace App\Http\Controllers;

use App\Models\BookMark;
use App\Models\Place;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookMarkController extends Controller
{
    public function store(Request $request, BookMark $bookmark)
    {

        $bookmark->place_id = $request->place_id;
        $bookmark->user_id = Auth::user()->id;
        $bookmark->save();


        return redirect()->route('dashboard');
    }

    public function destroy(Request $request, $id)
    {
        $place = Place::findOrFail($id);

        $place->bookmarks()->delete();

        return redirect()->route('dashboard');
    }
}
