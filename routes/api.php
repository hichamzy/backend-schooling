<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* etudiants routes */
Route::get('/students', [\App\Http\Controllers\StudentController::class, 'index']);
Route::get('/students/{id}', [\App\Http\Controllers\StudentController::class, 'show']);
Route::put('/students/{id}', [\App\Http\Controllers\StudentController::class, 'update']);
Route::get('/exportStudents', [\App\Http\Controllers\StudentController::class, 'exportExcelList']);
Route::get('/students/{id}/pdf', [\App\Http\Controllers\StudentController::class, 'exportPdf']);
Route::get('/students/{id}/notes', [\App\Http\Controllers\NoteController::class, 'studentNote']);

/* matieres routes */

Route::get('/matieres/filters', [\App\Http\Controllers\MatiereController::class, 'filters']);
Route::get('/matieres', [\App\Http\Controllers\MatiereController::class, 'index']);
Route::get('/matieres/{id}', [\App\Http\Controllers\MatiereController::class, 'show']);
Route::post('/matieres', [\App\Http\Controllers\MatiereController::class, 'insert']);
Route::put('/matieres/{id}', [\App\Http\Controllers\MatiereController::class, 'update']);
Route::delete('/matieres/{id}', [\App\Http\Controllers\MatiereController::class, 'delete']);

/* module routes */
Route::get('/modules', [\App\Http\Controllers\ModuleController::class, 'index']);
Route::get('/modules/{id}', [\App\Http\Controllers\ModuleController::class, 'show']);
Route::post('/modules', [\App\Http\Controllers\ModuleController::class, 'insert']);
Route::put('/modules/{id}', [\App\Http\Controllers\ModuleController::class, 'update']);
Route::delete('/modules/{id}', [\App\Http\Controllers\ModuleController::class, 'delete']);

/* prof routes*/
Route::get('/profs',[\App\Http\Controllers\ProfController::class,'index']);
Route::get('/profs/{id}',[\App\Http\Controllers\ProfController::class,'show']);
Route::post('/profs',[\App\Http\Controllers\ProfController::class,'insert']);
Route::put('/profs/{id}',[\App\Http\Controllers\ProfController::class,'update']);
Route::delete('/profs/{id}',[\App\Http\Controllers\ProfController::class,'delete']);

/* notes routes */
Route::get('/notes/{filier}/{annee}/{matiere_id}', [\App\Http\Controllers\NoteController::class, 'exportList']);
Route::post('/notes/import', [\App\Http\Controllers\NoteController::class, 'importList']);


Route::get('/demandes', [\App\Http\Controllers\DemandeController::class, 'index']);
Route::get('/demandes/{student_id}', [\App\Http\Controllers\DemandeController::class, 'show']);
Route::put('/demandes/{demande}', [\App\Http\Controllers\DemandeController::class, 'accepte']);
Route::put('/demandes/{id}/envoyer', [\App\Http\Controllers\DemandeController::class, 'envoyee']);

Route::resource('posts',\App\Http\Controllers\PostController::class);

/* LOGIN routes */

Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login']);