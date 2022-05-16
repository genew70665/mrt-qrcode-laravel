<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReactController;

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
    
// Route::view('/', '/app');
Route::redirect('/admin', '/admin/login');
Route::get('/{path?}', [
    ReactController::class, 'show',
    'as' => 'app',
    'where' => ['path' => '.*']
]);

// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth:admin']], function () {
//     Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
// });

