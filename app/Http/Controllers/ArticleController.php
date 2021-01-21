<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Resources\Article as ArticleResuce;
use App\Http\Resources\ArticleCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    private static $messages = [
        'required'=>'El campo :attribute es obligatorio.',
        'body.requiered'=> 'el body ingresado no se puede prosesar con exito.',
    ];

    public function image(Article $article){
        return response()->download(public_path(Storage::url($article->image)), $article->title);
    }

    public function index(){
        //$this->authorize('viewAny', Article::class);
        return new ArticleCollection(Article::paginate(10));
    }
    public function show( Article $article){
        $this->authorize('view', $article);
        return response()->json(new ArticleResuce($article),200);
    }
    public function store(Request $request){
        $this->authorize('create', Article::class);
        $request->validate([
            'title' => 'required|string|unique:articles|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|dimensions:min_width=200,min_height=200',
        ],self::$messages);

        //$article = Article::create($request->all());
        //
        $article = new Article($request->all());
        $path = $request->image->store('public/articles');
        //$path = $request->image->storeAs('public/articles', $request->user()->id . '_' . $article->title . '.' . $request->image->extension());
        $article->image = $path;
        $article->save();
        return response()->json(new ArticleResuce($article), 201);
    }
    public function update(Request $request, Article $article){
        $this->authorize('update',$article);
        $request->validate([
            'title' => 'required|string|unique:articles,title,'.$article->id.'|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|dimensions:min_width=200,min_height=200',
        ],self::$messages);

        $article->update($request->all());
        return response()->json($article, 200);
    }
    public function delete(Article $article){
        $article->delete();
        return response()->json(null, 204);
    }
}
