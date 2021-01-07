<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Resources\Article as ArticleResuce;
use App\Http\Resources\ArticleCollection;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    private static $rules = [
        'title' => 'required|string|unique:articles|max:255',
        'body' => 'required',
    ];

    private static $messages = [
        'required'=>'El campo :attribute es obligatorio.',
        'body.requiered'=> 'el body ingresado no se puede prosesar con exito.',
    ];

    public function index(){
        return new ArticleCollection(Article::paginate(10));
    }
    public function show( Article $article){
        return response()->json(new ArticleResuce($article),200);
    }
    public function store(Request $request){

        $request->validate(self::$rules,self::$messages);

        /*$validator = Validator::make($request->all(),[
            'title' => 'required|string|unique:articles|max:255',
            'body' => 'required|string'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'error' => 'data_validation_failed', 
                "error_list"=>$validator->errors()], 400);
        }*/

        $article = Article::create($request->all());
        return response()->json($article, 201);
    }
    public function update(Request $request, Article $article){
        $article->update($request->all());
        return response()->json($article, 200);
    }
    public function delete(Article $article){
        $article->delete();
        return response()->json(null, 204);
    }
}
