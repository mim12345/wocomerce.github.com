<?php

namespace App\Http\Controllers;

use App\Billings;
use App\Cart;
use App\Product;
use App\Sale;
use App\Shippings;
use Carbon\Carbon;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
   function Payment(Request $request){

   $sub_total = $request->session()->get('sub_total');
   $discount = $request->session()->get('discount');

    $user_ip = $_SERVER['REMOTE_ADDR'];
    $Carts = Cart ::with('product')->where('user_ip', $user_ip)->get();
    $shipping_id = Shippings::insertGetId([
            'user_id'=> Auth::user()->id,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'company_name'=>$request->company_name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'address'=>$request->address,
            'country_id'=>$request->country_id,
            'state_id'=>$request->state_id,
            'city_id'=>$request->city_id,
            'zipcode'=>$request->zipcode,
            'notes'=>$request->notes,
            // 'payment_status'=>$request->payment_status,
            "created_at" =>Carbon::now()
    ]);

    $sale_id = Sale::insertGetId([
        'user_id' => Auth::user()->id,
        'shipping_id' => $shipping_id,
        'grand_total' => $sub_total,
        'discount' => $discount,
        "created_at" =>Carbon::now()

    ]);

    $user_ip = $_SERVER['REMOTE_ADDR'];
    $Carts = Cart ::with('product')->where('user_ip', $user_ip)->get();

    foreach ($Carts as $item) {
        Billings::insert([
        'user_id' =>Auth::user()->id,
       'sale_id' =>$sale_id,
       'shipping_id' =>$shipping_id,
       'product_id' =>$item->product_id,
       'product_price' =>$item->product->product_price,
       'product_quantity' =>$item->product_quantity,
            "created_at" =>Carbon::now()

        ]);

        Product::findOrFail($item->product_id)->decrement('product_quantity',$item->product_quantity);
        $item->delete();
    }
    //payment method
    \Stripe\Stripe::setApiKey('sk_test_51HU2C9HXkxQk5u8RTU00Gqk5M9odELMAXMT1OMyfuwBjZs5MxzNxt6ma5WQuQsuzlcbndQjZPkDjbmn0m7U20Icd001VZoXPiP');
    \Stripe\Charge::create([
        'amount' => $sub_total * 100,
        'currency' => 'usd',
        "source" => $request->stripeToken,
      ]);
///Invoice Order Send Mail

     $orderdate = Billings::where('shipping_id',$shipping_id)->get();

      Mail::to(Auth::user()->email)->send(new OrderShipped($orderdate));


    return "ok";
   }
}
