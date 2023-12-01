<section class="cart-area pt-100 pb-80">
    <div class="container">
    <div class="row">
       <div class="col-12">
             <form action="#">
                <div class="table-content table-responsive">
                   <table class="table">
                         <thead>
                            <tr>
                               <th class="product-thumbnail">Images</th>
                               <th class="cart-product-name">Item Name</th>
                               <!-- <th class="cart-product-name">Size</th> -->
                               <th class="product-price">Unit Price</th>
                               <th class="product-quantity">Quantity</th>
                               <th class="product-subtotal">Total</th>
                               <th class="product-remove">Remove</th>
                            </tr>
                         </thead>
                         <tbody>
                            @php
                                $sub_total = 0;
                                $tax = 0;
                                $total = 0;
                            @endphp
                            @if(count($carts)>0)
                            @foreach($carts as $key=>$cart)
                                @php
                                    $sub_total+= ($cart->quantity*$cart->price);
                                    if($siteSetting->gst)
                                    {
                                      $tax+=(($siteSetting->gst*$cart->total)/100);
                                    }
                                @endphp
                            <tr>
                               <td class="product-thumbnail">
                                  <a href="javascript:void(0)">
                                     @if(isset($cart->product->latestImage))
                                        <img src="{{asset('storage/app/public/'.$cart->product->latestImage->image) }}" alt="Product">
                                    @else
                                        <img src="{{asset('public/assets/images/no_image.png')}}" alt="Product">
                                    @endif
                                  </a>
                               </td>
                               <td class="product-name">
                                  <a href="{{route('productDetails', $cart->product->slug)}}">{{$cart->product->name}}</a>
                               </td>
                               <!-- <td class="product-name">
                                  {{$cart->size}}
                               </td> -->
                               <td class="product-price">
                                  <span class="amount">{{env('CURRENCY', '₹')}} {{number_format($cart->price,2)}}</span>
                               </td>
                               
                               <td class="product-quantity">
                                <div class="plusminus">
                                      <span class="cart-minus" wire:click="qtyMinus('{{$cart->id}}')"><i class="fa-solid fa-minus"></i></span>
                                      <input class="cart-input" type="text" readonly="" wire:model="cart_quantity.{{$key}}">
                                      <span class="cart-plus" wire:click="qtyPlus('{{$cart->id}}')"><i class="fa-solid fa-plus"></i></span>
                                  </div>
                                     
                               </td>
                               <td class="product-subtotal">
                                  <span class="amount">{{env('CURRENCY', '₹')}} {{number_format(($cart->total),2)}}</span>
                               </td>
                               <td class="product-remove">
                                  <a href="javascript:void(0);" class="remove" wire:click="deleteAttempt('{{$cart->id}}')"><i class="fal fa-times"></i></a>
                               </td>
                            </tr>
                            @endforeach
                            @else
                                <tr><td colspan="6" style="text-align: center;">No records available</td></tr>
                            @endif
                         </tbody>
                   </table>
                </div>
                <div class="row">
                   <div class="col-12">
                         <div class="coupon-all">
                            
                            <div class="coupon2">
                               <a href="{{route('products')}}" class="tp-btn " name="update_cart" type="submit">Add More Products</a>
                            </div>
                         </div>
                   </div>
                </div>
                @if(count($carts)>0)
                <div class="row justify-content-end">
                   <div class="col-md-5 ">
                         <div class="cart-page-total">
                            <h2>Cart totals</h2>
                            <ul class="mb-20">
                               <li>Subtotal <span>{{env('CURRENCY', '₹')}}{{number_format($sub_total,2)}}</span></li>
                               <li> GST ({{$siteSetting->gst}} %)<span>@if(count($carts)>0) {{env('CURRENCY', '₹')}}{{number_format($tax,2)}} @else {{env('CURRENCY', '₹')}}0.00 @endif</span></li>
                               <li>Total <span>{{env('CURRENCY', '₹')}}{{number_format(($sub_total+$tax),2)}}</span></li>
                            </ul>
                            <div class="col-md-12 d-flex justify-content-end ">
                            @if(Auth::user() && Auth::user()->hasRole('CLIENT'))
                                <a href="{{route('checkout')}}" class="tp-btn ">Proceed to Checkout</a>
                            @else
                                <a href="{{route('user.login')}}" class="tp-btn ">Proceed to Checkout</a>
                            @endif
                           </div>
                         </div>
                   </div>
                </div>
                @endif
             </form>
       </div>
    </div>
    </div>
 </section>