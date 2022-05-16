<?php

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

Route::redirect('/admin', '/admin/login');
Route::group(['prefix' => 'admin'], function(){
    Auth::routes(['register' => false]);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\KitTrackController::class, 'index'])->name('dashboard');
    // Change Password
    Route::get('change-password', [App\Http\Controllers\Admin\ChangePasswordController::class, 'index'])->name('admin.change-password.index');
    // Update Change Password
    Route::post('change-password', [App\Http\Controllers\Admin\ChangePasswordController::class,'updatePassword'])->name('admin.change-password.update');
    // Admin User
    Route::resource('admin', App\Http\Controllers\Admin\AdminController::class);
    // users list
    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::post('users/{id}/inactive', [App\Http\Controllers\Admin\UserController::class, 'inactive'])->name('users.inactive');
    Route::post('users/import', [App\Http\Controllers\Admin\UserController::class, 'import'])->name('users.import');
    Route::get('changeStatus', [App\Http\Controllers\Admin\UserController::class, 'changeStatus']);
    // Equiment routes
    Route::get('equipment', [App\Http\Controllers\Admin\EquipmentController::class, 'index'])->name('equipment.index');
    Route::post('equipment/create', [App\Http\Controllers\Admin\EquipmentController::class, 'create'])->name('equipment.create');
    Route::post('equipment/edit', [App\Http\Controllers\Admin\EquipmentController::class, 'import'])->name('equipment.edit');
    Route::get('equipment/{id}/show', [App\Http\Controllers\Admin\EquipmentController::class, 'show'])->name('equipment.show');
    Route::post('equipment/import', [App\Http\Controllers\Admin\EquipmentController::class, 'import'])->name('equipment.import');
    Route::post('equipment/select', [App\Http\Controllers\Admin\EquipmentController::class, 'selectEquipment'])->name('equipment.select');

    Route::get('equipment-list', [App\Http\Controllers\Admin\EquipmentController::class, 'equipmentList']);
    Route::get('show-equip-demo', [App\Http\Controllers\Admin\EquipmentController::class, 'showEquipdemo']);

    // Kit management
    Route::resource('kit', App\Http\Controllers\Admin\KitController::class);
    // Kit track management
    Route::get('kit-track', [App\Http\Controllers\Admin\KitTrackController::class, 'index'])->name('kit-track.index');
}); 

