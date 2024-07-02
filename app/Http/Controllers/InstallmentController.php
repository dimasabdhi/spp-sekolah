<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Installment;
use App\Models\Payment;

class InstallmentController extends Controller
{
    public function create($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        return view('installments.create', compact('payment'));
    }

    public function store(Request $request, $paymentId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $payment = Payment::findOrFail($paymentId);

        Installment::create([
            'user_id' => $request->user()->id,
            'payment_id' => $payment->id,
            'amount' => $request->amount,
        ]);

        // Update the payment status if the total installment amount matches the payment amount
        $totalInstallments = $payment->installments()->sum('amount');
        if ($totalInstallments >= $payment->amount) {
            $payment->update(['status' => 'paid']);
        }

        return redirect()->route('payments.show', $paymentId)->with('success', 'Installment added successfully');
    }
}
