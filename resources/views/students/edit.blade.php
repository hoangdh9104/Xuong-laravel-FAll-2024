@extends('master')

@section('title')
    List Students
@endsection

@section('content')
    <h1>
        Update students: {{ $student->name }}
    </h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form enctype="multipart/form-data" action="{{ route('students.update', $student) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}">
        </div>
        <div class="mb-3">
            <label for="classroom_id" class="form-label">Classroom</label>
            <select class="form-select" aria-label="Default select example" name="classroom_id">
                <option selected disabled>Choose a classroom</option>
                @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" @if (isset($student) && $classroom->id == $student->classroom_id) selected @endif>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="subjects" class="form-label">Select Subjects</label>
            <select multiple class="form-select" name="subjects[]" required>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}"
                        @if(in_array($subject->id, $student->subjects->pluck('id')->toArray())) selected @endif>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="passport_number" class="form-label">Passport Number</label>
            <input type="text" class="form-control" id="passport_number" name="passport_number"
                value="<?php
                if (isset($student->passport->passport_number)) {
                    echo $student->passport->passport_number;
                } else {
                    echo '';
                }
                ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
