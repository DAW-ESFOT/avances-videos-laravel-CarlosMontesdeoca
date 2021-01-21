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
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::get('articles', 'ArticleController@index');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');

    //articulos
    Route::get('articles/{article}', 'ArticleController@show');
    Route::post('articles', 'ArticleController@store');
    Route::put('articles/{article}', 'ArticleController@update');
    Route::delete('articles/{article}', 'ArticleController@delete');
    Route::get('articles/{article}/image', 'ArticleController@image');

    //comentarios
    Route::get('articles/{article}/comments', 'CommentController@index');
    Route::get('articles/{article}/comments/{comment}', 'CommentController@show');
    Route::post('articles/{article}/comments', 'CommentController@store');
    Route::put('articles/{article}/comments/{comment}', 'CommentController@update');
    Route::delete('articles/{article}/comments/{comment}', 'CommentController@delete');
});