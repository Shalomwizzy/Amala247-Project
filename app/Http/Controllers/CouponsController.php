<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{


    public function index()
    {


      $coupons = Coupon::OrderBy('code', 'asc')->paginate(10);


        return view('admin/coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin/coupons.create');
    }

    

    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
    
        return view('admin/coupons.show', ['coupon' => $coupon]);
    }
    




    public function store(Request $request)
    {
        $request->validate([
            'code' => "required|string|unique:coupons",
            'type' => "required",
            'value' => "required|numeric",
            'cart_value' => "required|numeric",
            'expiry_date' => 'required|date',
        ]);
    
        $coupon = Coupon::create([
            'code' => $request->input('code'),
            'type' => $request->input('type'),
            'value' => $request->input('value'),
            'cart_value' => $request->input('cart_value'),
            'expiry_date' => $request->input('expiry_date'),
        ]);
    
        if ($coupon) {
            return redirect()->route('coupon.index')->with('success', "Coupon Created Successfully");
        } else {
            return back()->with('error', "Something went wrong, please try again!");
        }
    }
    


    // public function 
    

    public function update(Request $request, string $id)
    {
        $request->validate([
            'code' => "required|string|unique:coupons,code,$id",
            'type' => "required",
            'value' => "required|numeric",
            'cart_value' => "required|numeric",
            'expiry_date' => 'required|date',
        ]);
    
        $coupon = Coupon::findOrFail($id);
    
        $coupon->update([
            'code' => $request->input('code'),
            'type' => $request->input('type'),
            'value' => $request->input('value'),
            'cart_value' => $request->input('cart_value'),
            'expiry_date' => $request->input('expiry_date'),
        ]);
    
        return redirect()->route('coupon.index')->with('success', 'Coupon updated successfully.');
    }
    




    public function edit(string $id){

        $coupon = Coupon::findOrFail($id);
        return view('admin/coupons.edit', compact('coupon'));
  
      }


    public function destroy(string $id)
    {
      $delete = Coupon::where('id', '=', $id)->delete();

      return redirect()->route('coupon.index')->with('success', 'Coupon deleted successfully.');
    }
}
