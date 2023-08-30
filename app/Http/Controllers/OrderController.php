<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function create($id){
        $product = Product::find($id);
        return view('order.create', compact('product'));
    }

    function store(Request $request){
        $request->validate([
            'quantity' => 'required',
            'product_id' => 'required|exists:products,id',
        ]);

        $totalPrice = $request->input('price');
        $user = Auth::user()->id;

        $order = Order::create([
            'quantity' => $request->input('quantity'),
            'price' => $totalPrice,
            'user_id' => $user,
            'product_id' => $request->input('product_id')]);

        // session()->flash('success', 'Order completed successfully.');
        return redirect()->route('category.index');
    }

    function show(){
        $user = Auth::user();

        $orders = $user->orders()->with('product')->paginate(25);
        return view('order.show', compact('orders'));
    }

    function destroy($id){
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('order.show');
    }

}
