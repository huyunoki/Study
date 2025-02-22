<?php

namespace App\Http\Controllers;

use App\Helpers\MarkdownHelper;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function show($id)
    {
        $place = Place::findOrFail($id);
        $place->description = MarkdownHelper::cleanHtml(MarkdownHelper::parseMarkdown($place->description));

        return view('place.show',  ['place' => $place]);
    }
}
