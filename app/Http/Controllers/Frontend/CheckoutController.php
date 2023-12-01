<?php

namespace App\Http\Controllers\Frontend;

use Str;
use Auth;
use PDF;
use Validator;
use URL;
use Mail;
use Session;
use Redirect;
use Input;
use Razorpay\Api\Api;
use Stripe\Stripe;
use Stripe\PaymentMethod;
use Stripe\PaymentIntent;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\Models\Cart;
use App\Models\Banner;
use App\Models\Coupon;
use App\Models\Setting;
use App\Models\Product;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\State;
use App\Http\Controllers\Controller;
use App\Mail\ProductOrderMail;
use Illuminate\Http\Request;
use App\Http\Livewire\Traits\AlertMessage;


class CheckoutController extends Controller
{
    private $_api_context;

    use AlertMessage;
    public function checkout()
    {
        $setting = Setting::first();
        $user_id=0;
        $data['user'] = null;
        if(Auth::user() && Auth::user()->hasRole('CLIENT'))
        {
            $user_id = Auth::user()->id;
            $data['user'] = Auth::user();
        }
        $count = Cart::where('user_id', $user_id)->orWhere('session_id',Session::get('user_session_id'))->latest()->count();
        if($count>0)
        {
            
            $data['title'] = 'Checkout';
            $data['state_list'] = State::get();
            $data['banner'] = Banner::where('slug','checkout')->where('active', 1)->first();
            return view('frontend.pages.checkout', $data);
        }
        else{
            return Redirect::route('home')->with('error','Please Add Product');
        }
    }


    public function getOrderId(Request $request)
    {
        
        $setting = Setting::first();
        $user_id=0;
        if(Auth::user() && Auth::user()->hasRole('CLIENT'))
        {
            $user_id = Auth::user()->id;
        }
        $carts = Cart::where('user_id', $user_id)->orWhere('session_id',Session::get('user_session_id'))->latest()->get();
        if(count($carts)>0)
        {
            $sub_total = 0;
            $tax = 0;
            $total = 0;
              $total_amount = 0;
            foreach ($carts as $key => $cart) {
                $sub_total+= ($cart->quantity*$cart->price);
              if($setting->gst)
              {
                $tax+=(($setting->gst*$cart->total)/100);
              }
            }
              $total_amount = $sub_total+$tax+$setting->shipping_charge;

            $today = date('Y-m-d');
            $couponData = Coupon::where('name', $request->coupon_code)->where('active', 1)->where('start_date','<=', $today)->where('end_date','>=', $today)->first();

            if($couponData)
            {
                if($couponData->discount_type == "Flat")
                {

                  $total_amount = $total_amount-$couponData->discount;
                }
                else
                {
                  $total_amount = $total_amount-(($total_amount*$couponData->discount)/100);
                }
            }
            $total_amount = round($total_amount, 2);
            $receiptid = Str::random(20);
            //dd($total_amount);
            $api = new Api ($setting->razor_pay_key , $setting->razor_pay_secret);
            $order  = $api->order->create([
                    'receipt'         => $receiptid,
                    'amount'          => $total_amount*100,
                    'currency'        => 'INR',
                ]);
            if($order)
            {
                //dd($order);
                return response ()->json (['order_id'=>$order->id, 'total_amount' => $total_amount]);
            }
            return response ()->json (['order_id'=>null]);

        }
    }
    public function payment(Request $request)
    {
        //dd($request->all());
        $user_id=0;
        if(Auth::user() && Auth::user()->hasRole('CLIENT'))
        {
            $user_id = Auth::user()->id;
        }
        $setting = Setting::first();
        $carts = Cart::where('user_id', $user_id)->orWhere('session_id',Session::get('user_session_id'))->latest()->get();
        $sub_total = 0;
        $tax = 0;
        $total = 0;
        if(count($carts)>0)
        {
            foreach($carts as $key=>$cart)
            {
                $sub_total+= ($cart->quantity*$cart->product->price);
                $tax+=(($setting->gst*$cart->total)/100);
            }
        }
        $total = ($sub_total+$tax+$setting->shipping_charge);

        $today = date('Y-m-d');
        $couponData = Coupon::where('name', $request->coupon_code)->where('active', 1)->where('start_date','<=', $today)->where('end_date','>=', $today)->first();
        if($couponData)
        {
            if($couponData->discount_type == "Flat")
            {

              $total = $total-$couponData->discount;
              $discount = $couponData->discount;
            }
            else
            {
              $total = $total-(($total*$couponData->discount)/100);
              $discount = ($total*$couponData->discount)/100;
            }
        }

        if($request->paymentMethod ==  'Razorpay')
        {


            $order = Order::create([
                'customer_name' =>$request->name,
                'payment_mode' =>'Razorpay',
                'customer_email' =>$request->email,
                'customer_phone' =>$request->phone,
                'city' =>$request->city,
                'discount_code' =>@$couponData->name,
                'discount' =>@$discount,
                'address' =>$request->address,
                'pin_code' =>$request->pin_code,
                'state_id' =>$request->state_id,
                'country_id' =>$request->country_id,
                'district' =>$request->district,
                'r_payment_id' =>$request->razorpay_payment_id,
                'r_order_id' =>$request->razorpay_order_id,
                'road' =>$request->road,
                'user_id' =>$user_id?$user_id:null,
                'sub_total' =>$sub_total,
                'tax' =>$tax,
                'active' =>1,
                'total' =>$total,
                'shipping_charge' =>$setting->shipping_charge,
                'total' =>$total,
            ]);

           
            foreach ($carts as $key => $cart) {
            $total_tax =0;
                $total_tax=(($setting->gst*$cart->total)/100);
                OrderDetails::create([
                    'order_id' => $order->id,
                    'user_id' => $user_id?$user_id:null,
                    'product_id' => $cart->product->id,
                    'product_name' => $cart->product->name,
                    'price' => $cart->price,
                    'size' => $cart->size,
                    'total_gst' => $total_tax,
                    'quantity' => $cart->quantity,
                    'total' => $cart->total,
                ]);
            }

            
            if($order)
            {
                $data['id'] = $order->id;
                $data['setting'] = $setting;
                foreach ($carts as $key => $cart) {
                        $cart->delete();
                    }
                Mail::to($setting->email)->send(new ProductOrderMail($data));
                Mail::to($order->customer_email)->send(new ProductOrderMail($data));
                $url = route('payment.success.view', $request->razorpay_order_id);
                return response ()->json (['status'=>true, 'order_id' => $request->razorpay_order_id, 'url' => $url]);
            }
            return response ()->json (['status'=>false]);

        }
        else{

            $order_id = null;
            while (true) {
                $numSeed = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnoprrstuvwxyz";
                $shuffled = str_shuffle($numSeed);
                $temp_order_id  =  substr($shuffled,1,14);
                $order_id = 'order_'.$temp_order_id;
                $oldData = Order::where('r_order_id', $order_id)->count();
                if($oldData == 0)
                {
                    break;
                }
            }

            $order = Order::create([
                'customer_name' =>$request->name,
                'payment_mode' =>'Cash on Delivery',
                'customer_email' =>$request->email,
                'customer_phone' =>$request->phone,
                'city' =>$request->city,
                'discount_code' =>@$couponData->name,
                'discount' =>@$discount,
                'address' =>$request->address,
                'pin_code' =>$request->pin_code,
                'state_id' =>$request->state_id,
                'country_id' =>$request->country_id,
                'district' =>$request->district,
                'r_order_id' =>$order_id,
                'road' =>$request->road,
                'user_id' =>$user_id?$user_id:null,
                'sub_total' =>$sub_total,
                'tax' =>$tax,
                'active' =>1,
                'total' =>$total,
                'shipping_charge' =>$setting->shipping_charge,
                'total' =>$total,
            ]);

           
            foreach ($carts as $key => $cart) {
            $total_tax =0;
                $total_tax=(($setting->gst*$cart->total)/100);
                OrderDetails::create([
                    'order_id' => $order->id,
                    'user_id' => $user_id?$user_id:null,
                    'product_id' => $cart->product->id,
                    'product_name' => $cart->product->name,
                    'price' => $cart->price,
                    'size' => $cart->size,
                    'total_gst' => $total_tax,
                    'quantity' => $cart->quantity,
                    'total' => $cart->total,
                ]);
            }

            
            if($order)
            {
                $data['id'] = $order->id;
                $data['setting'] = $setting;
                foreach ($carts as $key => $cart) {
                        $cart->delete();
                    }
                Mail::to($setting->email)->send(new ProductOrderMail($data));
                Mail::to($order->customer_email)->send(new ProductOrderMail($data));
                $url = route('payment.success.view', $order_id);
                return response ()->json (['status'=>true, 'order_id' => $order_id, 'url' => $url]);
            }
            return response ()->json (['status'=>false]);

        }
        

        
         
    }

    public function stripeStatus(Request $request)
    {
        dd($request->all());
    }

    public function paymentStatus(Request $request)
    {
        try{
            $user_id=0;
            if(Auth::user() && Auth::user()->hasRole('CLIENT'))
            {
                $user_id = Auth::user()->id;
            }
            $payment_id = Session::get('paypal_payment_id');
            $order_id = Session::get('order_id');
            $setting = Setting::first();
            $carts = Cart::where('user_id', $user_id)->orWhere('session_id',Session::get('user_session_id'))->latest()->get();
            Session::forget('paypal_payment_id');
            Session::forget('order_id');
            $order = Order::find($order_id);
                $this->_api_context = new ApiContext(new OAuthTokenCredential(
                 $setting->paypal_client_id,
                 $setting->paypal_client_secret)
             );
             //dd($paypal_conf);
            $settings = array(
              'mode' => $setting->payment_mode,
              'http.ConnectionTimeOut' => 1000,
              'log.LogEnabled' => true,
              'log.FileName' => storage_path() . '/logs/paypal.log',
              'log.LogLevel' => 'FINE'
              );
            $this->_api_context->setConfig($settings);
            if (empty($request->input('PayerID')) || empty($request->input('token'))) {
                \Session::put('error','Payment failed');
                return Redirect::route('carts');
            }
            $payment = Payment::get($payment_id, $this->_api_context);        
            $execution = new PaymentExecution();
            $execution->setPayerId($request->input('PayerID'));        
            $result = $payment->execute($execution, $this->_api_context);
            
            if ($result->getState() == 'approved') 
            {   
                $order->update([
                    'active' => 1,
                    'txn_id' => $payment_id,
                    'payment_token' => $request->input('token'),
                    'paypal_payer_id' => $request->input('PayerID'),
                ]);

                foreach ($carts as $key => $cart) {
                    $cart->delete();
                }
                /*$datas['order'] = $order;
                $pdf = PDF::loadView('frontend.pdf.purchase_pdf', $datas);
                $data['pdf'] = $pdf;
                $data['id'] = $order->id;
                $data['setting'] = $setting;
                Mail::to($order->customer_email)->send(new ProductOrderMail($data));*/
                $msgAction = 'Your Order successfully';
                $this->showToastr("success",$msgAction);
                return Redirect::route('payment.success.view', encrypt($order->id));
            }
            $msgAction = 'Payment failed !!';
            $this->showToastr("error",$msgAction);
            return Redirect::route('checkout');
        }
        catch (\Exception $e) {
            $this->showToastr("error",$e->getMessage());
            return Redirect::route('checkout');
        }
    }

    public function emails()
    {
        /*$data['id'] = 5;
        $datas['order'] = Order::find(3);
        $pdf = PDF::loadView('frontend.pdf.purchase_pdf', $datas);
        $data['pdf'] = $pdf;
        Mail::to('anim.mondal.92@gmail.com')->send(new ProductOrderMail($data));
        dd('okk');*/
        $data['setting'] = Setting::first();
        $data['order'] = Order::with('order_details')->where('id',2)->first();
        return view('emails.product_order_mail', $data);
    }

    public function paymentSuccessView($order_id)
    {
        //$order_id = decrypt($id);

        $order = Order::with('order_details')->where('r_order_id',$order_id)->first();
        $data['banner'] = Banner::where('slug','products')->where('active', 1)->first();
        if($order)
        {
            $data['title'] = 'Order Success';
            $data['order'] = $order;
            return view('frontend.pages.success', $data);
        }
        $this->showToastr("error",'Something Went Wrong');
        return Redirect::route('home');
    }
}
