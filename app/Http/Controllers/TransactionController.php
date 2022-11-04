<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        if (Auth::user()->roleId != 1) {
            $transaction = Transaction::where('userId', Auth::user()->id)->get();
        } else {
            $transaction = Transaction::all();
        }
        $products = Product::all();
        return view('transaction/index', compact('products', 'transaction'));
    }

    public function add()
    {
        $products = Product::all();
        return view('transaction/add', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'productId' => 'required',
                'quantity' => 'required',
            ]
        );
        $product = Product::where('id', $request->productId)->first();
        $data = $request->all();
        $data['userId'] = Auth::user()->id;
        $data['price'] = $product->price;
        $data['total'] = $product->price * $request->quantity;
        $data['kode'] = 'TRX-' . time() .'-' . $product->id . '-' . $data['userId'];

        if ($request->quantity > $product->stock) return redirect()->route('transaction.add')->with('error', 'Stock Tidak cukup');

        Product::where('id', $product->id)
            ->update([
                'stock' => $product->stock - $request->quantity,
            ]);

        Transaction::create($data);
        return redirect()->route('transaction.index')->with('massage', 'Transaction berhasi ditambahkan');
    }

    public function edit($kode)
    {
        $transaction = Transaction::where('kode', $kode)->first();
        if(!$transaction) return redirect()->route('transaction.index');
        $products = Product::all();
        return view('transaction/edit', compact('products', 'transaction'));
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'productId' => 'required',
                'quantity' => 'required',
            ]
        );
        $transaction = Transaction::where('kode', $request->kode)->first();
        if(!$transaction) return redirect()->route('transaction.index');
        $product = Product::where('id', $request->productId)->first();
        $data = $request->all();
        $data['price'] = $product->price;
        $data['total'] = $product->price * $request->quantity;
        
        $totalStock = $transaction->quantity + $product->stock;
        if ($request->quantity > $totalStock) return redirect()->route('transaction.edit', ['kode' => $transaction->kode])->with('error', 'Stock Tidak cukup');
        Product::where('id', $product->id)
            ->update([
                'stock' => $totalStock - $request->quantity,
            ]);

        Transaction::where('id', $transaction->id)
            ->update([
                'productId' => $product->id,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'total' => $product->price * $request->quantity
            ]);

        return redirect()->route('transaction.index')->with('massage', 'Transaction berhasi diupdate');
    }
}
