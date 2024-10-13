@extends('master')

@section('title')
    List Classrooms
@endsection

@section('content')
    <h1>
        List Classrooms
        <a class="btn btn-info" href="{{ route('students.create') }}">Create new student</a>
    </h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">TEACHER NAME</th>
                <th scope="col">CREATED_AT</th>
                <th scope="col">UPDATED_AT</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($data as $classroom)
                <tr>
                    <th scope="row">{{ $classroom->id }}</th>
                    <td>{{ $classroom->name }}</td>
                    <td>{{ $classroom->teacher_name	 }}</td>
                    <td>{{ $classroom->created_at }}</td>
                    <td>{{ $classroom->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
@endsection
