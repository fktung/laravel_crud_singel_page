<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::all();
        $product = Product::all();
        return view('transaction/index', compact('product', 'transaction'));
    }
}
