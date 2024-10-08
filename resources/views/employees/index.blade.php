@extends('master')

@section('title')
    Quan ly nhan vien
@endsection

@section('content')
    <a href="{{ route('employees.create') }}" class="btn btn-light">Add</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">FIRST NAME</th>
                <th scope="col">LAST NAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">PHONE</th>
                <th scope="col">HIRE DATE</th>
                <th scope="col">SALARY</th>
                <th scope="col">IS ACTIVE</th>
                <th scope="col">PROFILE PICTURE</th>
                <th scope="col">CREATED AT</th>
                <th scope="col">UPDATE AT</th>
                <th scope="col">ACTION</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($data as $employee)
                <tr>
                    <th scope="row">{{ $employee->id }}</th>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->email }}</td>
                    <th>{{ $employee->phone }}</th>
                    <td>{{ $employee->hire_date }}</td>
                    <td>{{ $employee->salary }}</td>
                    <td>
                        @if ($employee->is_active)
                            <span class="badge text-bg-primary">YES</span>
                        @else
                            <span class="badge text-bg-danger">NO</span>
                        @endif
                    </td>
                    <th>{{ $employee->profile_picture }}</th>
                    <td>{{ $employee->created_at }}</td>
                    <td>{{ $employee->updated_at }}</td>
                    <td>
                        <a href="{{ route('employees.show', $employee) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-dark">Edit</a>
                        <form action="{{ route('employees.destroy', $employee) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-warning"
                                onclick="return confirm('Ban muon xoa khong ?')">Xoa mem</button>
                        </form>
                        <form action="{{ route('employees.forceDestroy', $employee) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Ban muon xoa vinh vien khong ?')">Xoa cung</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
@endsection
