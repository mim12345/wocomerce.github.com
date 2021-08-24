<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    function cart($coupon = '')
    {
        if ($coupon == '') {
            $discount = 0;
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $Carts = Cart::with('product')->where('user_ip', $user_ip)->get();
            // Session diye coupon discount Payment Controller Niye jacce
            session(['discount' => $discount]);

            return view('frontend.cart', compact('Carts', 'discount'));
        } else {

            if (Coupon::where('coupon_code', $coupon)->exists()) {
                $validity = Coupon::where('coupon_code', $coupon)->first()->coupon_validity;

                if ( Carbon::now()->format('Y-m-d') <= $validity) {

                    $user_ip = $_SERVER['REMOTE_ADDR'];
                    $Carts = Cart::with('product')->where('user_ip', $user_ip)->get();
                    $discount = Coupon::where('coupon_code', $coupon)->first()->coupon_discount;
                    // Session diye coupon discount Payment Controller Niye jacce
                    session(['discount' => $discount]);

                    return view('frontend.cart', compact('Carts', 'discount'));
                } else {

                    $discount = Coupon::where('coupon_code', $coupon)->first();
                   Session::put('coupon',[
                    'coupon_code' => $discount->coupon_code,
                    'coupon_discount' => $discount->coupon_discount,

                   ]);
                   return back()->with('couponA','Coupon Applied Succsefully!');
                }
            } else {
               return back()->with('couponbd','Coupon Date Expiered');
            }
        }
    }

    function SingleCartDelete($cart_id)
    {

        $user_ip = $_SERVER['REMOTE_ADDR'];
        Cart::where('id', $cart_id)->where('user_ip', $user_ip)->delete();

        return back()->with('CartDelete','Cart Item Deleted Successfully!');
    }

    function CartUpdate(Request $request)
    {

        foreach ($request->Cart_id as $key => $item) {
            Cart::findOrFail($item)->update([

                'product_quantity' => $request->product_quantity[$key],
                'updated_at' => Carbon::now()
            ]);
        }
        return "ok";
    }
}
