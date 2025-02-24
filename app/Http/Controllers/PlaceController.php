<?php

namespace App\Http\Controllers;

use App\Helpers\MarkdownHelper;
use App\Models\Place;
use Illuminate\Http\Request;
use League\CommonMark\CommonMarkConverter;

class PlaceController extends Controller
{
    public function show($id)
    {
        $place = Place::find($id);
        $converter = new CommonMarkConverter();

        $place->description = $converter->convertToHtml($place->description);

        return view('place.show', compact('place'));
    }
}
