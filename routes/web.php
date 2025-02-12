<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\FileUploadController;
Route::get('/upload', [FileUploadController::class, 'showForm']);
Route::post('/upload', [FileUploadController::class, 'uploadFile']);
Route::get('/download/{filename}', [FileUploadController::class, 'downloadFile']);
Route::delete('/delete/{filename}', [FileUploadController::class, 'deleteFile']);
