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

    public function index(Place $place, Bookmark $bookmark, Category $category, Request $request)
    {
        $user = \Auth::user();

        // ログインユーザーの投稿のみ取得
        $query = $user->places();

        // ユーザーがブックマークしている place_id のリストを取得
        $exists = Bookmark::where('user_id', $user->id)->pluck('place_id')->toArray();

        // index画面の検索時にgetメソッドで渡されるqueryを受け取る
        $filter = $request->query('category');
        $sort = $request->query('sort');

        // カテゴリでフィルタリング
        if (!empty($filter)) {
            $query->where('category_id', $filter);
        }

        // ソート処理
        if (empty($sort)) {
            $query->orderBy('created_at', 'desc'); // デフォルトを最新順
        } else {
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
        }


        // クエリ実行（ログインユーザーの投稿のみにフィルター適用）
        $places = $query->get();

        // カテゴリリストを取得（フォーム用）
        $categories = $user->categories()->get();

        return view('places.index', compact('places', 'exists', 'categories'));
    }



    public function create(Category $category)
    {
        $user = \Auth::user();
        $categories = $user->categories()->get();
        return view('places.create', compact('categories'));
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
        $user=\Auth::user();

        $place = Place::find($id);

        // カテゴリリストを取得（フォーム用）
        $categories = $user->categories()->get();

        // dd($place);

        return view('places.edit', compact('place','categories'));
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
        $place = Place::find($id);
        $place->delete();

        return redirect('/place');
    }
}
