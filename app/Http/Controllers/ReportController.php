<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('reports.index', compact('payments'));
    }

    public function monthly()
    {
        $payments = Payment::whereMonth('created_at', Carbon::now()->month)->get();

        return view('reports.monthly', compact('payments'));
    }

    public function yearly()
    {
        $payments = Payment::whereYear('created_at', Carbon::now()->year)->get();

        return view('reports.yearly', compact('payments'));
    }
}
