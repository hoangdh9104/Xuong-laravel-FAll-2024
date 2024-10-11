@extends('master')

@section('title')
    Transaction
@endsection

@section('content')
    <h1>Transaction Details</h1>

    <div class="alert alert-info">
        <ul>
            <li><strong>Transaction ID:</strong> {{ $transaction->transaction_id }}</li>
            <li><strong>Amount:</strong> {{ $transaction->amount }}</li>
            <li><strong>Receiver Account:</strong> {{ $transaction->receiver_account }}</li>
            <li><strong>Status:</strong> {{ $transaction->status }}</li>
        </ul>
    </div>

    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning">Edit Transaction</a>

    <form method="POST" action="{{ route('transactions.destroy', $transaction->id) }}" class="mt-2">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Transaction</button>
    </form>
@endsection
