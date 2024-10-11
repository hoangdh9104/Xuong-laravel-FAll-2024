@extends('master')

@section('title')
    Transaction
@endsection

@section('content')
    <h1>Continue Transaction</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Transaction ID</th>
                <th scope="col">Amount:</th>
                <th scope="col">Receiver Account:</th>
                <th scope="col">Status: </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ $transaction['transaction_id'] }}</th>
                <td>{{ $transaction['amount'] }}</td>
                <td>{{ $transaction['receiver_account'] }}</td>
                <td>{{ $transaction['status'] }}</td>
            </tr>
        </tbody>
    </table>

    <form action="{{ route('transaction.complete') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Complete Transaction</button>
    </form>

    <form action="{{ route('transaction.cancel') }}" method="POST" style="margin-top: 10px;">
        @csrf
        <button type="submit" class="btn btn-danger">Cancel Transaction</button>
    </form>
@endsection
