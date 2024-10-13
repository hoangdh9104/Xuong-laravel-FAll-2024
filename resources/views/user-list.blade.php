@extends('master')

@section('title')
List User
@endsection

@section('content')

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">UserID</th>
            <th scope="col">Phone</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($data as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->phone->value }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $data->links() }}
@endsection