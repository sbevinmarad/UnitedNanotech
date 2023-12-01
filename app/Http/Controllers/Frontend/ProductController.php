<?php

namespace App\Http\Controllers\Frontend;

use Mail;
use Auth;
use Validator;
use Session;
use App\Models\Cms;
use App\Models\User;
use App\Models\Seo;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquery;
use App\Rules\Recaptcha;
use App\Mail\EnqueryMailSendToUser;
use App\Mail\EnqueryMailSendToAdmin;
class ProductController extends Controller
{
    public function products(Request $request)
    {
        
        $data['title'] = 'Products';
        $data['seo'] = Seo::where('slug','products')->first();
        $data['banner'] = Banner::where('slug','products')->where('active', 1)->first();
       /* $products = Product::with('category','productImages')->where('active', 1)->orderBy('id', 'asc');

        if ($request->keyword) {
            $products = $products->where('name',  'like', '%' . $request->keyword . '%');
        }

        if($request->category){

             $products = $products->whereRelation('category', 'slug', $request->category);
        }
        $data['products'] = $products->get();*/
        $data['categories'] = Category::with('products')->where('active', 1)->orderBy('id', 'asc')->get();
        return view('frontend.pages.product', $data);
    }

    public function show(Request $request)
    {
        $product = Product::with('category', 'productImages')->where('id', $request->product_id)->where('active', 1)->first();

        if(isset($product)){
           
            return response ()->json (['code'=>1, 'product' => $product]);
        }
        else
            return response ()->json (['code'=>0]);
    }

    public function productDetails($slug)
    {
        $data['title'] = 'Product Details';
        $data['seo'] = Seo::where('slug','products')->first();
        $data['banner'] = Banner::where('slug','products')->where('active', 1)->first();
        $data['product'] = Product::with('category', 'productImages','productFiles')->where('slug', $slug)->where('active', 1)->first();

        if($data['product'])
        	return view('frontend.pages.product_details', $data);
        else
        	return redirect()->route('products')->with('error', 'Product not found');
    }

   public function enqueryForm(Request $request)
    {
        $rules = [
            'name' =>'required',
            'email' =>'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,4}$/ix',
            'phone' =>'required',
            'product_id' =>'required|exists:products,id',
            'description' =>'required',
            'quantity' =>'required',
            'unit' =>'required',
            'purpose' =>'required',
            'g-recaptcha-response' =>['required',new Recaptcha()]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors(),'code'=>0]);
        }
        $product = Product::find($request->product_id);
        $data = [
            'name' => $request->name,
            'product_name' => $product->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'purpose' => $request->purpose,
            'description' => $request->description,
        ];
        $enquery =  Enquery::create($data);
        $admin = Setting::first();
        $mailData = ['id' => $enquery->id];
        //Mail::to('anim.mondal.92@gmail.com')->send(new InqueryMailSendToAdmin($data));
        Mail::to($admin->email)->send(new EnqueryMailSendToAdmin($mailData));
                
        
        
        Mail::to($request->email)->send(new EnqueryMailSendToUser($mailData));

        Session::flash('success','Form Submit succesfully.We will contact soon.');
                    return response ()->json (['code'=>1]);

    }
}
