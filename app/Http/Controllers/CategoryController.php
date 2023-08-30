<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
    * Display a listing of the resource.
    */

    public function index(Request $request)
    {
        $search = $request->input('category_name');

        if($search){
            $categories = Category::where('category_name', 'like', $search . '%')->paginate(25);
        }else{
            $categories = Category::paginate(25);
        }
        $user = Auth::user();

        if($user->user_type == 'admin'){
            return view('admin.index', compact('categories'));
        }else{
            return view('category.index', compact('categories'));
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $category = Category::find($id);
        $user = Auth::user();
        $search = $request->input('product_name');

        if($search){
            $products = $category->Product()->where('product_name', 'like', $search . '%')->paginate(25);
        }else{
            $products = $category->Product()->paginate(25);
        }
        // dd($products);
        if($user->user_type == 'admin'){
            return view('admin.show', compact('category', 'products'));
        }else{
            return view('category.show', compact('category', 'products'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'category_name'=>'required',
        ]);

        Category::create($request->all());
        return redirect()->route('admin.index');
    }


    /**
     * Update the specified resource in storage.
     */

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.edit', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function update($id, Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:100',
        ]);

        $category = Category::find($id);
        if (!$category) {
            abort(404); // Category not found
        }

        // dd($request->all(), $category);

        $category->update($request->all());

        return redirect()->route('admin.show', ['admin' => $id]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::where('id',$id)->delete();
        return redirect()->route('admin.index');
    }

}
