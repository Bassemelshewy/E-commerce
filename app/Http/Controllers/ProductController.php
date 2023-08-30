<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $category_id = $request->input('category_id');

        return view('product.create', compact('category_id'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name'=>'required|string|min:3|max:100',
            'product_price'=>'required',
            'product_availability'=>'required',
            'product_image'=>['required', 'image']
        ]);

        $category_id = $request->input('category_id');
        // $product = Product::create(array_merge($validated, ['category_id' => $category_id]));
        // dd($request->all());
        $product = Product::create($request->all());

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/', $image_name);

            $product->update([
                'product_image' => $image_name
            ]);
        }

        return redirect()->route('admin.show', ['admin' => $category_id]);
    }


    /**
     * Show the form for editing the specified resource.
    */
    public function show(Product $product)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'product_name'=>'required|string|min:3|max:100',
            'product_price'=>'required',
            'product_availability'=>'required',
            'product_image'=>'required|image'
        ]);
        $product = Product::find($id);

        $product->update($request->all());

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/', $image_name);

            $product->update([
                'product_image' => $image_name,
            ]);
        }
        return redirect()->route('admin.show', ['admin' => $product->category_id]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('admin.show', ['admin' => $product->category_id]);
    }
}
