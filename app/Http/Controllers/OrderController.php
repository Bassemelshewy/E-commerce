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

    public function addToOrder($id){

        // You can use sessions to store the order details temporarily
        $order = session()->get('order', []);

        // Add the product to the order with quantity
        if (isset($order[$id])) {
            $order[$id]['quantity'] += request('quantity');
        } else {
            $order[$id] = [
                'product_id' => $id,
                'quantity' => request('quantity')
            ];
        }
        // dd($order);

        session()->put('order', $order);

        return redirect()->Route('category.index');
    }

    public function showOrderSummary()
    {
        $orders = session()->get('order');
        // dd($orders);
        $productDetails = [];
        $total_amount = 0;

        if ($orders) {
            foreach ($orders as $order) {
                $productId = $order['product_id'];
                $quantity = $order['quantity'];

                // Retrieve the product details using the Product model
                $product = Product::find($productId);

                // Add the product details to the array
                if ($product) {
                    $productDetails[] = [
                        'product' => $product,
                        'quantity' => $quantity,
                    ];
                    $total_amount += $product->product_price * $quantity;
                }
            }
        }
        return view('order.show', ['productDetails'=>$productDetails, 'total_amount'=>$total_amount]);
    }


    public function removeFromOrder($id)
    {
        $order = session()->get('order', []);
        // $quantity = request()->input('quantity');
        $quantity = request('quantity');
        // Check if the item with the specified ID exists in the order
        if (array_key_exists($id, $order)) {
            if ($order[$id]['quantity'] > $quantity) {
                $order[$id]['quantity'] -= $quantity;
            } else {
                unset($order[$id]);
            }
            session()->put('order', $order);
        }

        return redirect()->Route('order.showOrderSummary');
    }

    static function getOrderNumber(){
        $userId = Auth::user()->id;
        return Order::where('user_id', $userId)->count();
    }

    public function store(Request $request){

        $request->validate([
            'shipping_address' => 'required|max:100',
            'order_date' => 'required'
        ]);

        $orderData = session()->get('order', []);

        $user_id = Auth::user()->id;
        $request->merge(['user_id' => $user_id]);

        // Create a new order
        $order = Order::create($request->all());


        // Attach products to the order with quantities
        foreach ($orderData as $item) {
            $product = Product::find($item['product_id']);
            $order->products()->attach($product, ['quantity' => $item['quantity']]);
        }

        // Clear the session data
        session()->forget('order');


        return redirect()->route('category.index');
    }

    function show(){
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', $user_id)->with('products')->paginate(25);
        // dd($orders);

        return view('order.showOrder', compact('orders'));
    }

    function destroy($id){
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('order.show');
    }

    // public function store(Request $request){
    //     $request->validate([
    //         'shipping_address' => 'required|max:100',
    //         'order_date' => 'required'
    //     ]);

    //     $user_id = Auth::user()->id;
    //     $request->merge(['user_id' => $user_id]);

    //     // dd($request);
    //     $order = Order::create($request->all());

    //     // $order = Order::create([
    //     //     'quantity' => $request->input('quantity'),
    //     //     'price' => $totalPrice,
    //     //     'user_id' => $user,
    //     //     'product_id' => $request->input('product_id')]);

    //     // session()->flash('success', 'Order completed successfully.');
    //     return redirect()->route('category.index');
    // }

    // function show(){
    //     $user_id = Auth::user()->id;
    //     $orders = Order::where('user_id', $user_id)->paginate(25);
    //     // dd($orders);
    //     $products = [];

    //     // Loop through each order to retrieve its associated products
    //     foreach ($orders as $order) {
    //         // Use the "products" relationship to get the related products
    //         $orderProducts = $order->products()->paginate(25);

    //         // Add the products for this order to the "products" array
    //         $products[$order->id] = $orderProducts;
    //     }
    // // in veiws order
    // @foreach ($products[$order->id] as $product)
    //     <p>{{$product->product_name}}</p>
    // @endforeach
    //     return view('order.showOrder', compact('orders', 'products'));
    // }




}
