<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Hash;
use Session;
use App\Models\Cart;
use App\Models\Banner;
use App\Models\Setting;
use App\Models\Product;
use App\Models\ProductSize;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $user_id=0;
    	$data['title'] = 'Cart';
        $data['banner'] = Banner::where('slug','carts')->where('active', 1)->first();
        if(Auth::user() && Auth::user()->hasRole('CLIENT'))
        {
            $user_id = Auth::user()->id;
        }
        $data['carts'] = Cart::where('user_id', $user_id)->orWhere('session_id',Session::get('user_session_id'))->latest()->get();
    	return view('frontend.pages.cart', $data);
    }

    public function addToCart(Request $request)
    {
    	$user_id= 0;
    	if(Auth::user() && Auth::user()->hasRole('CLIENT'))
    	{
    		$user_id = Auth::user()->id;
    	}

        $user_session_id = Session::get('user_session_id');
        if(is_null($user_session_id))
        {
            $numSeed = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $shuffled = str_shuffle($numSeed);
            $user_session_id  =  Hash::make(substr($shuffled,1,50));
            Session::put('user_session_id',$user_session_id);
        }
        
    	
		$product = Product::find($request->product_id);
		if(is_null($product))
		{
            return response ()->json (['code'=>2]);
		}
		
		
        $session_id = Session::get('user_session_id');
        $cartItem = Cart::where(function($q) use($session_id, $user_id){
            $q->where('user_id', $user_id)->orWhere('session_id',$session_id);
        })->where('product_id',  $product->id)->first();
        if ($user_id == 0) {
            $user_id = null;
        }
        if($cartItem)
        {
            $qty = $cartItem->quantity+1;
            $price = ($cartItem->total+$product->price);
            $cart = $cartItem->update([
                'quantity' => $qty,
                'total' => $price,
            ]);
            return response ()->json (['code'=>4]);
        }
        else{

            $size = ProductSize::where('product_id', $product->id)->first();
            $cart = Cart::create([
                'user_id'=> $user_id,
                'session_id'=> Session::get('user_session_id'),
                'product_id' => $product->id,
                'price' => $product->price,
                'size' => $size?$size->size:null,
                'quantity' => 1,
                'total' => $product->price,

            ]);
            return response ()->json (['code'=>1]);
        }

		

		return response ()->json (['code'=>0]);
    	
    }

    public function removeToCart(Request $request)
    {
        $user_id= 0;
        if(Auth::user() && Auth::user()->hasRole('CLIENT'))
        {
            $user_id = Auth::user()->id;
        }

        $user_session_id = Session::get('user_session_id');
        if(is_null($user_session_id))
        {
            $numSeed = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $shuffled = str_shuffle($numSeed);
            $user_session_id  =  Hash::make(substr($shuffled,1,50));
            Session::put('user_session_id',$user_session_id);
        }
        
        
        $product = Product::find($request->product_id);
        if(is_null($product))
        {
            return response ()->json (['code'=>2]);
        }
        $cartItem = Cart::where(function($q) use ($user_id) {$q->where('user_id',@$user_id)->orWhere('session_id',Session::get('user_session_id'));})->where('product_id',$request->product_id)->first();
        if($cartItem)
        {
            
            if($cartItem->quantity == 1)
            {
                $cartItem->delete();
                return response ()->json (['code'=>4]);
            }
            else{

                $cart = $cartItem->update([
                    'quantity' => ($cartItem->quantity-1),
                    'total' => ($cartItem->total-$product->price),
                ]);
                return response ()->json (['code'=>1]);
            }
        }
        
        return response ()->json (['code'=>0]);
        
    }

    public function cartQuantity(Request $request)
    {
        $setting = Setting::first();
        $user_id= 0;
        if(Auth::user() && Auth::user()->hasRole('CLIENT'))
        {
            $user_id = Auth::user()->id;
        }
        $cart = Cart::find($request->id);
        if($cart)
        {
            $cart->update([
                'quantity' => $request->value,
                'total' => ((int)$request->value*$cart->price),
            ]);

            $item = Cart::find($request->id);
            $total_gst = ($item->product->gst_amount*$item->quantity);
            $total = ($item->total+$total_gst);
            $carts = Cart::where('user_id', $user_id)->orWhere('session_id',Session::get('user_session_id'))->sum('total');
            return response ()->json (['code'=>1, 'price' => $price, 'tax' =>$tax]);
        }
        return response ()->json (['code'=>0]);
    }

    public function cartDelete(Request $request)
    {
        $cart = Cart::find($request->id);
        if($cart)
        {
            $cart->delete();
            Session::flash('success','Product Removed Successfully');
            return response ()->json (['code'=>1]);
        }
        Session::flash('error','Something went wrongy');
        return response ()->json (['code'=>0]);
    }

    public function productCart(Request $request)
    {

        $user_id= 0;
        if(Auth::user() && Auth::user()->hasRole('CLIENT'))
        {
            $user_id = Auth::user()->id;
        }

        $user_session_id = Session::get('user_session_id');
        if(is_null($user_session_id))
        {
            $numSeed = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $shuffled = str_shuffle($numSeed);
            $user_session_id  =  Hash::make(substr($shuffled,1,50));
            Session::put('user_session_id',$user_session_id);
        }
        
        
        $product = Product::find($request->product_id);
        if(is_null($product))
        {
            return response ()->json (['code'=>2]);
        }
        
        
        $session_id = Session::get('user_session_id');
        $cartItem = Cart::where(function($q) use($session_id, $user_id){
            $q->where('user_id', $user_id)->orWhere('session_id',$session_id);
        })->where('product_id',  $product->id)->first();
        if ($user_id == 0) {
            $user_id = null;
        }
        if($cartItem)
        {
            $cart = $cartItem->update([
                'quantity' => $request->value,
                'price' => $product->price,
                'total' => ($request->value*$product->price),
            ]);
            return response ()->json (['code'=>4]);
        }
        else{

            $cart = Cart::create([
                'user_id'=> $user_id,
                'session_id'=> Session::get('user_session_id'),
                'product_id' => $product->id,
                'quantity' => $request->value,
                'price' => $product->price,
                'total' => ($request->value*$product->price),

            ]);
            return response ()->json (['code'=>1]);
        }

        

        return response ()->json (['code'=>0]);
        
    }
}
