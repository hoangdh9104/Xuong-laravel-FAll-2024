@extends('master')

@section('title')
    List Students
@endsection

@section('content')
    <h1>
        List students
        <a class="btn btn-info" href="{{ route('students.create') }}">Create new student</a>
    </h1>
    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    {{-- Hien thong bao thanh cong --}}
    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-info">
            Thao tac thanh cong
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">CLASSROOM</th>
                <th scope="col">CREATED_AT</th>
                <th scope="col">UPDATED_AT</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $student)
                <tr>
                    <th scope="row">{{ $student->id }}</th>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->classroom->name }}</td>
                    <td>{{ $student->created_at }}</td>
                    <td>{{ $student->updated_at }}</td>
                    <td>
                        <a class="btn btn-info mt-2" href="{{ route('students.show', $student) }}">Show</a>
                        <br>
                        <a class="btn btn-warning mt-2" href="{{ route('students.edit', $student) }}">Edit</a>
                        <form method="POST" enctype="multipart/form-data" action="{{ route('students.destroy', $student) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2"
                                onclick="return confirm('Do u want to delete ?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
@endsection
