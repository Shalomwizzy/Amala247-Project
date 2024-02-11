<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class OrderNowController extends Controller
{

    public function orderNow()
    {
        $products = Products::orderBy('created_at', 'desc')->paginate(8);
    
        $productCount = Products::count(); // Count all products
    
        return view('order-now', compact('products', 'productCount'));
    }


    

    public function breakFast()
    {
        $breakfastCategory = Categories::where('name', 'Breakfast')->first();
        
        if (!$breakfastCategory) {
            return view::make('breakfast')->with('products', collect())->with('productCount', 0);
        }
        
        $products = Products::where('category_id', $breakfastCategory->id)
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    
        $productCount = $products->count();
    
        return view('breakfast', compact('products', 'productCount'));
    }



    public function swallows()
    {
        $swallowsCategory = Categories::where('name', 'Swallows')->first();
    
        if (!$swallowsCategory) {
            return View::make('swallows')->with('products', collect())->with('productCount', 0);
        }
    
        $products = Products::where('category_id', $swallowsCategory->id)
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    
        $productCount = $products->count();
    
        return view('swallows', compact('products', 'productCount'));
    }




    public function meals()
    {
        $mealsCategory = Categories::where('name', 'Meals')->first();
    
        if (!$mealsCategory) {
            return View::make('meals')->with('products', collect())->with('productCount', 0);
        }
    
        $products = Products::where('category_id', $mealsCategory->id)
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    
        $productCount = $products->count();
    
        return view('meals', compact('products', 'productCount'));
    }



    
    public function soups()
    {
        $soupsCategory = Categories::where('name', 'Soups')->first();
    
        if (!$soupsCategory) {
            return View::make('soups')->with('products', collect())->with('productCount', 0);
        }
    
        $products = Products::where('category_id', $soupsCategory->id)
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    
        $productCount = $products->count();
    
        return view('soups', compact('products', 'productCount'));
    }



    public function protein()
    {
        $proteinCategory = Categories::where('name', 'Protein')->first();
    
        if (!$proteinCategory) {
            return View::make('protein')->with('products', collect())->with('productCount', 0);
        }
    
        $products = Products::where('category_id', $proteinCategory->id)
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    
        $productCount = $products->count();
    
        return view('protein', compact('products', 'productCount'));
    }


    
    public function sauce()
    {
        $sauceCategory = Categories::where('name', 'Sauce')->first();
    
        if (!$sauceCategory) {
            return View::make('sauce')->with('products', collect())->with('productCount', 0);
        }
    
        $products = Products::where('category_id', $sauceCategory->id)
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    
        $productCount = $products->count();
    
        return view('sauce', compact('products', 'productCount'));
    }


    
    
    public function drinks()
    {
        $drinksCategory = Categories::where('name', 'Drinks')->first();
    
        if (!$drinksCategory) {
            return View::make('drinks')->with('products', collect())->with('productCount', 0);
        }
    
        $products = Products::where('category_id', $drinksCategory->id)
            ->orderBy('created_at', 'desc')
            ->paginate(8);
    
        $productCount = $products->count();
    
        return view('drinks', compact('products', 'productCount'));
    }
    




    public function search(Request $request)
    {
        $searchTerm = $request->query('search_term');

        // Search for products based on the search term
        $products = Products::where('product_name', 'like', "%$searchTerm%")
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        $productCount = $products->count();

        return view('search-results', compact('products', 'productCount', 'searchTerm'));
    }
    

    public function sort(Request $request, $method)
{
    $searchTerm = $request->input('search_term'); // Retrieve the search term from the request
    
    $productsQuery = Products::where('product_name', 'LIKE', '%' . $searchTerm . '%');

    switch ($method) {
        case 'low_to_high':
            $productsQuery->orderBy('product_price');
            break;
        case 'high_to_low':
            $productsQuery->orderByDesc('product_price');
            break;
        case 'latest':
            $productsQuery->orderByDesc('created_at');
            break;
        default:
            // Handle invalid sorting method, e.g., redirect back or default sorting
            break;
    }

    $products = $productsQuery->paginate(8);
    $productCount = $products->count();

    return view('search-results', compact('products', 'productCount', 'searchTerm'));
}


public function showDetails(Products $product)
{
    $relatedProducts = Products::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->inRandomOrder()
        ->limit(4)
        ->get();

    return view('product-details', compact('product', 'relatedProducts'));
}

     
}
