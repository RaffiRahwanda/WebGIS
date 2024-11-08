
<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CentrePointController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\SungaiController;
use App\Models\Space;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\ChartController;

Route::get('/charts', [ChartController::class, 'index']);
Route::get('/chart-data/{id}', [ChartController::class, 'getChartData']);

Auth::routes();


Route::get('/about', function (){
    $space['item'] = Space::all()->random(20);

    return view('about', $space);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/',[App\Http\Controllers\MapController::class,'index'])->name('map.index');
Route::get('/map/{slug}',[App\Http\Controllers\MapController::class,'show'])->name('map.show');



Route::group(['middleware' => ['auth']], function(){
Route::resource('centre-point',(CentrePointController::class));
Route::resource('category',(CategoryController::class));
Route::resource('space',(SpaceController::class));
Route::resource('sungai',(SungaiController::class));


Route::get('/centrepoint/data',[DataController::class,'centrepoint'])->name('centre-point.data');
Route::get('/categories/data',[DataController::class,'categories'])->name('data-category');
Route::get('/spaces/data',[DataController::class,'spaces'])->name('data-space');
Route::get('/sungais/data',[DataController::class,'sungai'])->name('data-sungai');


Route::get('/create', [App\Http\Controllers\HasilLaboratoriumController::class, 'add']);
Route::post('/tambah', [App\Http\Controllers\HasilLaboratoriumController::class, 'create']);
Route::get('/hapus/{id}', [App\Http\Controllers\HasilLaboratoriumController::class, 'deletes']);
Route::get('/edit/{id}', [App\Http\Controllers\HasilLaboratoriumController::class, 'edit']);
Route::post('/update/{id}', [App\Http\Controllers\HasilLaboratoriumController::class, 'update']);

Route::get('/hasil_lab/{id}', [App\Http\Controllers\HasilLaboratoriumController::class, 'showById']);
Route::post('update/status', [App\Http\Controllers\HasilLaboratoriumController::class, 'updateStatus']);

// Route::get('')

Route::get('/hasilbysungai/{id}', [App\Http\Controllers\SungaiController::class, 'hasilsungai']);

Route::get('/hasil_laboratorium', [App\Http\Controllers\HasilLaboratoriumController::class, 'index']);
Route::get('/hasil_laboratorium/export_excel', [App\Http\Controllers\HasilLaboratoriumController::class,'export_excel']);
Route::post('/hasil_laboratorium/import_excel', [App\Http\Controllers\HasilLaboratoriumController::class,'import_excel']);
Route::get('/create/{id}', [App\Http\Controllers\HasilLaboratoriumController::class, 'formById']);
Route::post('/tambah/hasil', [App\Http\Controllers\HasilLaboratoriumController::class, 'createById']);
Route::get('/hapus_hasil/{id}', [App\Http\Controllers\HasilLaboratoriumController::class, 'deleteById']);
Route::get('/edit_hasil_id/{id}', [App\Http\Controllers\HasilLaboratoriumController::class, 'editById']);
Route::post('/update_hasil_id/{id}', [App\Http\Controllers\HasilLaboratoriumController::class, 'updateById']);
Route::post('/update_status/{id}', [App\Http\Controllers\HasilLaboratoriumController::class, 'updateStatus']);
Route::get('/edit_hasil/{id}', [App\Http\Controllers\HasilLaboratoriumController::class, 'editByHasil']);
Route::post('/update_hasil/{id}', [App\Http\Controllers\HasilLaboratoriumController::class, 'updateHasil']);


Route::get('/apasaja/{id}', [App\Http\Controllers\HasilLaboratoriumController::class, 'apasaja']);


});