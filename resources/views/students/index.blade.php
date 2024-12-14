@extends('layout.admin')
@section('content')

    <div class="row">
        <div class="col">
            <h1 class="display-2">All Students</h1>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            @foreach ($students as $student)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $student->fname . ' ' . $student->lname }}
                            </h5>
                            <p class="card-text">
                                {{ $student->email }}
                            </p>
                            <p class="card-text">
                                Courses Enrolled: <br>
                                @if ($student->courses->isEmpty())
                                    No courses enrolled
                                @else
                                    @foreach ($student->courses as $course)
                                        {{ $course->name}} <br>
                                    @endforeach
                                @endif
                            </p>
                            <a href="{{ route('students.edit', $student -> id) }}">
                                Edit
                            </a>
                            <a href="{{ route('students.trash', $student -> id) }}">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>        
    </div>

@endsection