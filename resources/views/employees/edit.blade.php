@extends('master')

@section('title')
    Cap nhat nhan vien
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
    <form method="POST" enctype="multipart/form-data" action="{{ route('employees.update', $employee) }}">
        @csrf
        @method('PUT')


        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" value="{{ $employee->first_name }}" name="first_name">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" class="form-control" id="last_name" value="{{ $employee->last_name }}" name="last_name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="{{ $employee->email }}" name="email">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" class="form-control" id="phone" value="{{ $employee->phone }}" name="phone">
        </div>
        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date Of Birth</label>
            <input type="date" class="form-control" id="date_of_birth" value="{{ $employee->date_of_birth }}"
                name="date_of_birth">
        </div>
        <div class="mb-3">
            <label for="hire_date" class="form-label">Hire Date</label>
            <input type="date" class="form-control" id="hire_date"
                value="{{ \Carbon\Carbon::parse($employee->hire_date)->format('Y-m-d') }}" name="hire_date">
        </div>
        <div class="mb-3">
            <label for="salary" class="form-label">salary</label>
            <input type="number" class="form-control" id="salary" value="{{ $employee->salary }}" name="salary">
        </div>
        <div class="mb-3">
            <label for="is_active" class="form-label">Is Active</label>
            <input type="checkbox" class="form-checkbox" @checked($employee->is_active) id="is_active" value="1"
                name="is_active">
        </div>
        <div class="mb-3">
            <label for="department_id" class="form-label">Department Id</label>
            <input type="number" class="form-control" id="department_id" value="{{ $employee->department_id }}"
                name="department_id">
        </div>
        <div class="mb-3">
            <label for="manager_id" class="form-label">Manager Id</label>
            <input type="number" class="form-control" id="manager_id" value="{{ $employee->manager_id }}"
                name="manager_id">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" value="{{ $employee->address }}" name="address">
        </div>
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <input type="number" class="form-control" id="profile_picture" value="{{ $employee->profile_picture }}"
                name="profile_picture">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
