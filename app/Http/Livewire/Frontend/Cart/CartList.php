<?php

namespace App\Http\Livewire\Frontend\Cart;

use Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Session;
use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;

class CartList extends Component
{
	use AlertMessage;
    public $sub_total,$total, $user, $user_id=0, $arr_count;
    public $qty=[], $carts = [];


    public function mount()
    {
    	if(Auth::user() && Auth::user()->hasRole('CLIENT'))
    	{
    		$this->user_id = Auth::user()->id();
    	}

    	
    }
    public function render()
    {
    	$this->carts = Cart::where('user_id', $this->user_id)->orWhere('session_id',session()->getId())->latest()->get();
    	if(count($this->carts))
    	{
    		foreach ($this->carts as $key => $value) {
    			$this->qty[$key] =$value->quantity;
    		}
    	}
        return view('livewire.frontend.cart.cart-list');
    }

    public function updatedQty()
    {
    	
		if(isset($this->qty) && $this->qty !="" && is_numeric($this->qty))
        {
            $total = floatval($this->qty)*($this->carts[$this->arr_count]->price);
             $this->carts[$this->arr_count]->update([
	    		'quantity' => $this->qty,
	    		'total' => $total,
	    	]);
        }
    }
}
