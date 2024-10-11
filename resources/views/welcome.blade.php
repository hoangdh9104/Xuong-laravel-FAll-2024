@extends('master')

@section('content')
    <h1>Welcome to my website</h1>
    @if (session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif
@endsection
