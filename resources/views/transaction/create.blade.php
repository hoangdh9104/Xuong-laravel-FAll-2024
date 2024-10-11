@extends('master')

@section('title')
    Transaction
@endsection

@section('content')
    <h1>Create Transaction</h1>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
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

    <form method="POST" action="{{ route('transactions.store') }}">
        @csrf
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
        </div>
        <div class="mb-3">
            <label for="receiver_account" class="form-label">Receiver Account</label>
            <input type="text" class="form-control" id="receiver_account" name="receiver_account" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Transaction</button>
    </form>
@endsection
