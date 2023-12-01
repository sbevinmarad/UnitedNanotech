<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Hash;
use App\Models\Banner;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index($order_id)
    {
        $data['title'] = 'Orders Details';
        $user = Auth::user();
        $data['banner'] = Banner::where('slug','my-account')->where('active', 1)->first();
        $data['order'] = Order::with('order_details')->where('r_order_id', $order_id)->where('user_id', $user->id)->first();
        $data['user'] = $user;
        if($data['order'])
        	return view('frontend.pages.order_details', $data);
        else
        	return redirect()->route('user.profile')->with('error', 'Order not found');
    }	
}
