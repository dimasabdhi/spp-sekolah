<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Payment;
use PDF;
use App\Mail\InvoiceEmail;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
    }

    public function createPayment(Request $request)
    {
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $request->amount,
            ],
            'customer_details' => [
                'first_name' => $request->user()->name,
                'email' => $request->user()->email,
            ],
        ];

        $paymentUrl = Snap::createTransaction($params)->redirect_url;

        // Save payment to database
        Payment::create([
            'user_id' => $request->user()->id,
            'order_id' => $params['transaction_details']['order_id'],
            'amount' => $params['transaction_details']['gross_amount'],
            'status' => 'pending',
        ]);

        //pembayaran berhasil

        // Tampilkan atau unduh PDF jika perlu


        return redirect($paymentUrl);
    }

    public function paymentCallback(Request $request)
    {
        $serverKey = config('midtrans.serverKey');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            $payment = Payment::where('order_id', $request->order_id)->first();
            if ($payment) {
                $payment->update(['status' => $request->transaction_status]);
            }
        }

        return response()->json(['message' => 'Payment status updated']);
    }
}
