<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    public function start()
    {
        return view('transaction.start');
    }


    public function store(Request $request)
    {
        $transactionId = fake()->numberBetween(1, 99999999);
        session()->put('transaction', [
            'transaction_id' => $transactionId,
            'amount' => $request->input('amount'),
            'receiver_account' => $request->input('receiver_account'),
            'status' => 'pending'
        ]);

        return redirect()->route('transaction.continue');
    }


    public function continue()
    {
        if (session()->has('transaction')) {
            $transaction = session('transaction');
            return view('transaction.continue', compact('transaction'));
        } else {
            return redirect()->route('transaction.start')->with('error', 'No ongoing transaction found.');
        }
    }


    public function complete()
    {
        if (session()->has('transaction')) {
            $transactionData = session('transaction');

            Transaction::create([
                'transaction_id' => $transactionData['transaction_id'],
                'amount' => $transactionData['amount'],
                'receiver_account' => $transactionData['receiver_account'],
                'status' => 'confirmed',
            ]);

            session()->forget('transaction');

            return redirect()->route('transaction.start')->with('success', 'Transaction completed successfully.');
        } else {
            return redirect()->route('transaction.start')->with('error', 'No ongoing transaction to complete.');
        }
    }


    public function cancel()
    {
        session()->forget('transaction');
        return redirect()->route('transaction.start')->with('success', 'Transaction canceled.');
    }
}
