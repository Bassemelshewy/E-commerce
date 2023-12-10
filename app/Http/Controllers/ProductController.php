<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    public function store(ProductRequest $request)
    {
        $category_id = $request->input('category_id');

        $image_name = upload_image('', $request->file('product_image'));
        DB::beginTransaction();

        Product::create(['product_image' => $image_name] + $request->except(['_token', '_method', 'product_image']));

        DB::commit();
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
    public function update($id, ProductRequest $request)
    {
        $product = Product::find($id);

        DB::beginTransaction();
        if ($request->hasFile('product_image')) {
            //remove old image from uploads folder
            $image = public_path('uploads'.DIRECTORY_SEPARATOR .$product->product_image); // to reach to public folder
            if (file_exists($image)) {
                unlink($image); //delete from folder
            }
            $image_name = upload_image('', $request->file('product_image'));

            $product->update(['product_image' => $image_name] + $request->except(['_token', '_method', 'product_image']));
        } else {
            // Update the product excluding the product_image field
            $product->update($request->except(['_token', '_method', 'product_image']));
        }
        DB::commit();
        return redirect()->route('admin.show', ['admin' => $product->category_id]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product)
            DB::beginTransaction();
            $product->delete();
            $image = Str::after($product->product_image, 'uploads/');
            $image = public_path('uploads'.DIRECTORY_SEPARATOR .$image); // to reach to public folder

            if (file_exists($image)) {
                unlink($image); //delete from folder
            }

            DB::commit();

        return redirect()->route('admin.show', ['admin' => $product->category_id]);
    }
}
