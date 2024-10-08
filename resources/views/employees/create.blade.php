@extends('master')

@section('title')
    Them moi nhan vien
@endsection

@section('content')
    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" enctype="multipart/form-data" action="{{ route('employees.store') }}">
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}"> 
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
        </div>
        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date Of Birth</label>
            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
        </div>
        <div class="mb-3">
            <label for="hire_date" class="form-label">Hire Date</label>
            <input type="date" class="form-control" id="hire_date" name="hire_date" value="{{ old('hire_date') }}">
        </div>
        <div class="mb-3">
            <label for="salary" class="form-label">salary</label>
            <input type="number" class="form-control" id="salary" name="salary" value="{{ old('salary') }}">
        </div>
        <div class="mb-3">
            <label for="is_active" class="form-label">Is Active</label>
            <input type="checkbox" class="form-checkbox" id="is_active" value="1" name="is_active">
        </div>
        <div class="mb-3">
            <label for="department_id" class="form-label">Department Id</label>
            <input type="number" class="form-control" id="department_id" name="department_id" value="{{ old('department_id') }}">
        </div>
        <div class="mb-3">
            <label for="manager_id" class="form-label">Manager Id</label>
            <input type="number" class="form-control" id="manager_id" name="manager_id" value="{{ old('manager_id') }}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
        </div>
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <input type="number" class="form-control" id="profile_picture" name="profile_picture" value="{{ old('profile_picture') }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
