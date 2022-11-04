<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return view('product/index', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required',
            ]
        );
        
        Product::create($request->all());

        return redirect()->route('product.index')->with('massage', 'Product berhasi ditambahkan');
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required',
            ]
        );

        Product::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock
            ]);

        return redirect()->route('product.index')->with('massage', 'Product berhasi diupdate');
    }

    public function destroy($id)
    {
        Product::destroy($id);

        return redirect()->route('product.index')->with('massage', 'Product berhasi Dihapus');
    }
}
