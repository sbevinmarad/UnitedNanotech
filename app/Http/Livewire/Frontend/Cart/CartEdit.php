<?php

namespace App\Http\Livewire\Frontend\Cart;

use Auth;
use Hash;
use Session;
use App\Models\Cart;
use App\Models\Banner;
use App\Models\Setting;
use App\Models\Product;
use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;

class CartEdit extends Component
{
	use AlertMessage;
	public $carts,$cart_quantity=[];
	 protected $listeners = ['deleteConfirm', 'changeStatus'];
	
    public function render()
    {
    	$user_id=0;
    	if(Auth::user() && Auth::user()->hasRole('CLIENT'))
        {
            $user_id = Auth::user()->id;
        }
    	$this->carts = Cart::where('user_id', $user_id)->orWhere('session_id',Session::get('user_session_id'))->latest()->get();
    	if(count($this->carts))
    	{
    		foreach ($this->carts as $key => $value) {
    			$this->cart_quantity[$key] =$value->quantity;
    		}
    	}
        return view('livewire.frontend.cart.cart-edit');
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

    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You want to delete!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); 
    }

    public function deleteConfirm($id)
    {
    	$cart =  Cart::find($id['id']);
    	$cart->delete();
    	$msgAction = 'Product Removed Successfully';
        $this->showToastr("success",$msgAction);
        return redirect()->route('cart');
    }
}
