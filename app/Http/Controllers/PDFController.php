<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use PDF;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        $payments = Payment::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = PDF::loadView('pdf.payment_history', compact('payments'));

        return $pdf->download('payment_history.pdf');
    }
}
