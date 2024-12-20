<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\Course;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('students.index', [
            'students' => Student::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create')
            ->with('courses', Course::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        //OLD CODE
        // Student::create($request->validated());
        // return redirect()->route('students.index');

        //NEW CODE FOR ATTACH() 
        $student = Student::create($request->validated());
        $student->courses()->attach($request->courses);
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit')
            ->with('student', $student)
            ->with('courses', Course::all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student -> update($request->validated());
        $student->courses()->sync($request->courses);
        return redirect()->route('students.index');        
    }

    /**
     * This is a custom piece of deletion method, its temporary delete
     */
    public function trash($id)
    {
        Student::destroy($id);
        return redirect() -> route('students.trashed');        
    }

    /**
     * This is the recycle bin, it uses an inbuilt function called onlyTrashed, which shows all the deleted students within the database
     */
    public function trashed()
    {
        $students = Student::onlyTrashed() -> get();
        return view('students.trashed', ['students' => $students]);  
    }

    /**
     * Remove the specified resource from storage, this is permanent delete
     */
    public function destroy($id)
    {
        $student = Student::withTrashed() -> where('id', $id) -> first();
        $student -> forceDelete();
        return redirect() -> route('students.index');   
    }

    public function restore($id)
    {
        $student = Student::withTrashed() -> where('id', $id) -> first();
        $student -> restore();
        return redirect() -> route('students.index');        
    }


}
