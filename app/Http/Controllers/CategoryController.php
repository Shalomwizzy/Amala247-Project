<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


      $categories = Categories::OrderBy('name', 'asc')->paginate(10);


        return view('admin/category.index', compact('categories'));
    }

    

  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
         'name' => "required|max:80|string|unique:categories,name"
       ]);

      $category = Categories::create([
       'name' => $request->input('name'),
      ]);
      if ($category){
        return back()->with('success', "Category Created Successfully");

      }

      else{
        return back()->with('error', "Something went wrong please try again!");
      }
    }

    /**
     * Display the specified resource.
     */
  

    public function show($id)
    {
        $cat = Categories::with('products')->findOrFail($id);
    
        return view('admin/category.show', ['cat' => $cat]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */


    public function edit(string $id){

      $category = Categories::findOrFail($id);
      return view('admin/category.edit', compact('category'));

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      $request->validate([
        'name' => "required|max:80|string|unique:categories,name,$id",
        'image' => ["nullable", "image", "mimes:png,jpg,jpeg,gif", "max:2024"]

      ]);

      if($request->hasFile('image')){
        $file = $request->file('image');
        $fileName = "category_".$id . '.' . $file->extension();
        $location = public_path('categories');

        $file->move($location, $fileName);
        $category = Categories::findOrFail($id)->update([
          'name' => $request->input('name'),
          'image' => $fileName
        ]);
      }

      else{
        $category = Categories::findOrFail($id)->update([
          'name' => $request->input('name')
        ]);
      }

      return redirect()->route('category.index')->with('success', 'Category Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $delete = Categories::where('id', '=', $id)->delete();

      return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }

 

}
