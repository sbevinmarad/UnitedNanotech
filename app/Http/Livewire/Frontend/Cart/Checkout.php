<?php

namespace App\Http\Livewire\Frontend\Cart;

use Str;
use Auth;
use PDF;
use Validator;
use URL;
use Mail;
use Session;
use Redirect;
use Input;
use Livewire\Component;
use App\Models\Cart;
use App\Models\Banner;
use App\Models\Setting;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Order;
use App\Models\State;
use App\Models\OrderDetails;
use App\Mail\ProductOrderMail;
use App\Http\Livewire\Traits\AlertMessage;

class Checkout extends Component
{
	use AlertMessage;
	public $cart_quantity=[], $user, $user_id,  $setting, $coupon_code, $error_coupon_code, $couponData;
	 protected $listeners = ['deleteConfirm', 'changeStatus'];

	 public $address,
        $name,
        $email,
        $phone,
        $city,
        $pin_code,
        $country_id,
        $company_name,
        $district,
        $road,
        $state_id;


	public function mount()
	{
		$this->user_id=0;
        if(Auth::user() && Auth::user()->hasRole('CLIENT'))
        {
            $this->user_id = Auth::user()->id;
			$this->user = Auth::user();
            //$this->fill($this->user);
        }
		$this->setting = Setting::first();
		/*$this->state_list = State::get();*/
        
	}
    public function render()
    {
    	$carts = Cart::where('user_id', $this->user_id)->orWhere('session_id',Session::get('user_session_id'))->latest()->get();
    	if(count($carts))
    	{
    		foreach ($carts as $key => $value) {
    			$this->cart_quantity[$key] =$value->quantity;
    		}
    	}
        return view('livewire.frontend.cart.checkout', ['carts' => $carts]);
    }

    public function qtyMinus($id)
    {
    	$cart =  Cart::find($id);
    	if($cart->quantity == 1)
    	{

    	}
    	else{
    		$cart->update([
    			'quantity' => ($cart->quantity-1),
                'total' => ($cart->total-$cart->price),
    		]);
    	}
    }
    public function qtyPlus($id)
    {
    	$cart =  Cart::find($id);
    	
		$cart->update([
			'quantity' => ($cart->quantity+1),
            'total' => ($cart->total+$cart->price),
		]);
    }

    public function checkPromo()
    {
    	if($this->coupon_code)
        {
            $today = date('Y-m-d');
            $this->couponData = Coupon::where('name', $this->coupon_code)->where('active', 1)->where('start_date','<=', $today)->where('end_date','>=', $today)->first();
            if(is_null($this->couponData))
            {
/*                $this->error_coupon_code = "Invalid coupon code";
*/                $this->showModal('error', 'Error', 'Invalid coupon code');
            }
        }
        else{
            //$this->error_coupon_code = "This field required";
            $this->showModal('error', 'Error', 'This field required');

        }
    	
    }
}
