@extends('master')

@section('title')
    List Students
@endsection

@section('content')
    <div class="container">
        <h2>Student Details: {{ $student->name }}</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Field</th>
                    <th scope="col">Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Tên sinh viên</th>
                    <td>{{ $student->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td>{{ $student->email }}</td>
                </tr>
                <tr>
                    <th scope="row">Lớp</th>
                    <td>{{ $student->classroom->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Số hộ chiếu</th>
                    <td>
                        @if ($student->passport)
                            {{ $student->passport->passport_number }}
                        @else
                            No Passport
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Ngày cấp</th>
                    <td>
                        @if ($student->passport)
                            {{ \Carbon\Carbon::parse($student->passport->issued_date)->format('d/m/Y') }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">Ngày hết hạn</th>
                    <td>
                        @if ($student->passport)
                            {{ \Carbon\Carbon::parse($student->passport->expiry_date)->format('d/m/Y') }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>

            </tbody>
        </table>
        <h3>Các môn đang học</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Môn học</th>
                    <th scope="col">Số tín</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($student->subjects as $subject)
                    <tr>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->credits }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No subjects registered.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
