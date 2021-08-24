<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function FrontPage()
    {
        ///all function does not work limit function only get function work
        $product = Product::all();

        return view('frontend.main', compact('product'));
    }

    function SingleProduct($slug)
    {

        $product = Product::where('slug', $slug)->first();
        $related_product = Product::where('category_id', $product->category_id)->limit(4)->inRandomOrder()->get();
        return view('frontend.single_product', compact('product', 'related_product'));
    }

    function Shop()
    {

        $categories = Category::orderBy('category_name', 'asc')->get();
        $products = Product::orderBy('product_name', 'asc')->get();

        return view('frontend.shop', compact('categories', 'products'));
    }

    //cart start

    function SingleCart($product_id){
        $user_ip = $_SERVER['REMOTE_ADDR'];
        if (Cart::where('product_id',$product_id)->where('user_ip',$user_ip)->exists()) {
            Cart::where('product_id',$product_id)->where('user_ip',$user_ip)->increment('product_quantity');
        }
        else {
            Cart::insert([
                'product_id' =>$product_id,
                'user_ip' =>$user_ip,
                'created_at'=>Carbon::now()
            ]);
        }


        return back();
    }


}
