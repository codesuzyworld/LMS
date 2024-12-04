<?php
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('students', function () {
    return view('');
});

//This route is for students deletion
Route::get(
    'students/trash/{id}',
    [StudentController::class, 'trash']
)->name('students.trash');

//This route is for students that got deleted temporarily, basically a recycle bin
Route::get(
    'students/trashed',
    [StudentController::class, 'trashed']
)->name('students.trashed');

//This route is for students to be restored after trashed
Route::get(
    'students/restore/{id}',
    [StudentController::class, 'restore']
)->name('students.restore');

Route::resource('students', StudentController::class);

//This route is for students to be restored after trashed
Route::get(
    'students/destroy/{id}',
    [StudentController::class, 'destroy']
)->name('students.destroy');

