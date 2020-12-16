<?php
// https://app.getpostman.com/join-team?invite_code=09e540f8950c8f4f45d79d8c533171d9
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Article;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
// OBtener la lista
Route::get('articles', function(){
    return Article::all();
});
// obtener un solo registro
Route::get('articles/{id}', function($id){
    return Article::find($id);
});
// Crear un solo registro
Route::post('articles', function(Request $request){
    return Article::create($request->all());
});
// modificar un solo registro
Route::put('articles/{id}', function(Request $request, $id){
    $article = Article::findOrFail($id);
    $article->update($request->all());
    return $article;
});
// borrar un registro
Route::delete('articles/{id}', function($id){
    Article::find($id)->delete();
    return 204;
});