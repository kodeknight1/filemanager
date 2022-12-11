<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get( '/upload', [ FileController::class, 'upload' ] )->name( 'file.upload' );
    Route::post( '/upload', [ FileController::class, 'store' ] )->name( 'file.store' );


    Route::get( '/create-folder', [ FolderController::class, 'create' ] )->name( 'create.folder' );
    Route::post( '/create-folder', [ FolderController::class, 'store' ] )->name( 'store.folder' );

    Route::get( '/files', [ FolderController::class, 'index' ] )->name( 'files.index' );
    Route::get( '/files/folder/{folder}', [ FolderController::class, 'folder' ] )->name( 'folder.view' );


});

require __DIR__.'/auth.php';
