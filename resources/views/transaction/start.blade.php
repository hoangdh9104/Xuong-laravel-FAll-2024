@extends('master')

@section('title')
    Transaction
@endsection

@section('content')
    <h1>New Transaction</h1>
    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <form action="{{ route('transaction.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="amount" class="form-label">Amount:</label>
            <input type="number" class="form-control" name="amount" required><br>
        </div>
        <div class="mb-3">
            <label for="receiver_account" class="form-label">Receiver Account:</label>
            <input type="text" class="form-control" name="receiver_account" required><br>
        </div>
        <button type="submit" class="btn btn-primary">Create Transaction</button>
    </form>
@endsection
