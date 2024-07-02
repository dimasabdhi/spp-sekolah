<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Auth;

class PaymentHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $payments = $user->payments()->with('installments')->get();

        return view('payment_history.index', compact('payments'));
    }
}
