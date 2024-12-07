<?php
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
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


// This route is for courses

Route::get('courses', function () {
    return view('');
});

//This route is for courses deletion
Route::get(
    'courses/trash/{id}',
    [CourseController::class, 'trash']
)->name('courses.trash');

//This route is for courses that got deleted temporarily, basically a recycle bin
Route::get(
    'courses/trashed',
    [CourseController::class, 'trashed']
)->name('courses.trashed');

//This route is for courses to be restored after trashed
Route::get(
    'courses/restore/{id}',
    [CourseController::class, 'restore']
)->name('courses.restore');

Route::resource('courses', CourseController::class);

//This route is for students to be restored after trashed
Route::get(
    'courses/destroy/{id}',
    [CourseController::class, 'destroy']
)->name('courses.destroy');
