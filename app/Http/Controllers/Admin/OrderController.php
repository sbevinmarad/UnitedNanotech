<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.order.order-list');
    }

    public function completedOrder()
    {
        return view('admin.order.completed-order');
    }

    public function show($id)
    {
    	$order = Order::with('order_details')->find($id);
    	if($order){
    		$data['order'] = $order;
	        return view('admin.order.order-view', $data);
    	}
	    else
    		return redirect()->route('orders.index');
    }

    public function completedOrderView($id)
    {
        $order = Order::with('order_details')->find($id);
        if($order){
            $data['order'] = $order;
            return view('admin.order.completed-order-view', $data);
        }
        else
            return redirect()->route('completed.orders');
    }
}
