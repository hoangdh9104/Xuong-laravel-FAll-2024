@extends('master')

@section('title')
    List Students
@endsection

@section('content')
    <h1>
        Create students
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

    <form enctype="multipart/form-data" action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label for="issued_date" class="form-label">Issued date</label>
            <input type="date" class="form-control" id="issued_date" name="issued_date" value="{{ old('issued_date') }}">
        </div>
        <div class="mb-3">
            <label for="expiry_date" class="form-label">Expiry date</label>
            <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
        </div>
        <div class="mb-3">
            <label for="classroom_id" class="form-label">Classroom</label>
            <select class="form-select" aria-label="Default select example" name="classroom_id">
                <option selected disabled>Choose a classroom</option>
                @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="subjects" class="form-label">Select Subjects</label>
            <select multiple class="form-select" name="subjects[]" required>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="passport_number" class="form-label">Passport Number</label>
            <input type="text" class="form-control" id="passport_number" name="passport_number" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
