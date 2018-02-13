<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Todo;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todos', function (Request $request) {
    //Affiche le contenu de la table 'todos'
    return Todo::all();
});
Route::post('/todos', function (Request $request) {
  $todo = new Todo();
  $todo->label = $request->input('label');
  $todo->isDone = boolval($request->input('isDone'));
  $todo->save(); //Enregistrer en base de données
  return Todo::find($todo->id);
});
Route::put('/todos/{id}', function ($id, Request $request){
  $todo = Todo::find($id);
  $todo->label = $request->input('label');
  $todo->isDone = boolean($request->input('isDone'));
  $todo->save(); //Enregistrer en base de données
  return $todo;
});
Route::delete('/todos/{id}', function ($id, Request $request) {
  //Supprimer un enregistrement en fonction de l'id'
  Todo::destroy($id);
});
