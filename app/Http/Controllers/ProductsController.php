<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // public function __construct(){
    //     return $this ->middleware(['auth', 'verified', 'role.checker']);
    // }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::OrderBy('id', 'desc')->paginate(12);
        return view('admin/products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all()->sortBy('name');
        return view('admin/products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_category' => 'required|integer',
            'product_name' => 'required|max:80|string',
            'product_price' => 'required|numeric',
            'product_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:5028',

        ]);

        $file = $request->file('product_image');
        $fileName = "category_" . time() . '.' . $file->extension();
        $location = public_path('products');

        $file->move($location, $fileName);
        $filepath = 'products/' .$fileName;

        $product = Products::create([
            'category_id' => $request->input('product_category'),
            'product_name' => $request->input('product_name'),
            'product_price' => $request->input('product_price'),
            'product_image' => $filepath,
    
        ]);

        if($product){
            return back()->with('success', "Product Created Successfully");
        }

        else{
            return back()->with('error', "Product Creation Failed Please Try Again Later!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        return view('admin/products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $request->validate([
            'product_name' => 'nullable|string|max:80',
            'product_price' => 'required|numeric',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:5028',
        

            // Add other validation rules for your product fields
        ]);

        // Update the product with the new data from the edit form
        $product->update($request->all());

        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $fileName = "category_" . time() . '.' . $file->extension();
            $location = public_path('products');
            $file->move($location, $fileName);
            $filepath = 'products/' . $fileName;
            
            // Update the product's image path
            $product->product_image = $filepath;
            $product->save();
        }

        // Redirect back to the product index page with a success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
         // Delete the product
         $product->delete();

        // Redirect back to the product index page with a success message
         return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

}

