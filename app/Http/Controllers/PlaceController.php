<?php

namespace App\Http\Controllers;

use App\Helpers\MarkdownHelper;
use App\Models\Place;
use App\Models\Bookmark;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\PlaceRequest;
use League\CommonMark\CommonMarkConverter;

class PlaceController extends Controller
{

    public function index(Place $place,Bookmark $bookmark,Category $category,Request $request)
    {
        $user = \Auth::user();
        $places = $user->places()->get();
        $categorys=$category->get();

        // ユーザーがブックマークしている place_id のリストを取得
        $exists = Bookmark::where('user_id', $user->id)->pluck('place_id')->toArray();

        // index画面の検索時にgetメソッドで渡されるqueryを受け取る
        $filter = $request->query('category');
        $sort = $request->query('sort');

        // クエリのベース
        $query = Place::query();

        // カテゴリでフィルタリング（すべての時はクエリがnullで送られてくるため）
        if (!empty($filter)) {
            $query->where('category_id', $filter);
        }

        switch ($sort) {
            case "1":
                $query->orderBy('created_at', 'desc'); // 最新順
                break;
            case "2":
                $query->orderBy('created_at', 'asc'); // 古い順
                break;
            case "3":
                $query->orderBy('title', 'asc'); // タイトル順
                break;
        }

        // クエリ実行
        $places = $query->get();

        // カテゴリリストを取得（フォーム用）
        $filter = Category::all();

        
        return view('places.index', compact('places','exists','categorys'));
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
