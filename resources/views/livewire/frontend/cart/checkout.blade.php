<div>
  <div class="your-order-table table-responsive">
    <table>
     <thead>
        <tr>
           <th class="product-name">Description</th>
           <th>&nbsp;</th>
           <th class="product-total text-end">Amount</th>
        </tr>
     </thead>
     <tbody>
      @php
          $sub_total = 0;
          $tax = 0;
          $total = 0;
          $itemCount = 0;
      @endphp
      @if(count($carts)>0)
      @foreach($carts as $key=>$cart)
          @php
              $sub_total+= ($cart->quantity*$cart->price);
              if($siteSetting->gst)
              {
                $tax+=(($siteSetting->gst*$cart->total)/100);
              }
              $itemCount+=$cart->quantity;
          @endphp
        <tr class="cart_item">
              <td class="product-name">@if(strlen($cart->product->name) > 20)
                    {!! substr($cart->product->name,0,20)."..." !!}
                @else
                    {!! $cart->product->name !!}
                @endif <strong class="product-quantity"> × {{$cart->quantity}}</strong></td>
              <td>
                  <div class="plusminus">
                      <span class="cart-minus" wire:click="qtyMinus('{{$cart->id}}')"><i class="fa-solid fa-minus"></i></span>
                  <input class="cart-input" type="text" readonly="" wire:model.defer="cart_quantity.{{$key}}">
                  <span class="cart-plus" wire:click="qtyPlus('{{$cart->id}}')"><i class="fa-solid fa-plus"></i></span>
                  </div>
              </td>
              <td class="product-total text-end"><span class="amount">{{env('CURRENCY', '₹')}} {{number_format(($cart->total),2)}}</span></td>
        </tr>
        @endforeach
      @endif
     </tbody>
     <tfoot>
        <tr class="cart-subtotal">
              <th>Items Total</th>
              <td>&nbsp;</td>
              <td class="text-end"><span class="amount">{{$itemCount}}</span></td>
        </tr>
        <tr class="cart-subtotal">
              <th>Subtotal</th>
              <td>&nbsp;</td>
              <td class="text-end"><span class="amount">{{env('CURRENCY', '₹')}} {{number_format(($sub_total),2)}}</span></td>
        </tr>
        <tr class="cart-subtotal">
              <th>Vat / GST</th>
              <td>&nbsp;</td>
              <td class="text-end"><span class="amount">@if(count($carts)>0) {{env('CURRENCY', '₹')}}{{number_format($tax,2)}} @else {{env('CURRENCY', '₹')}}0.00 @endif</span></td>
        </tr>
        @php
          $total_amount = 0;
          $discount = 0;
          $total_amount = $sub_total+$tax+$setting->shipping_charge;
          if(isset($couponData))
          {
            if($couponData->discount_type == "Flat")
            {

              $total_amount = ($total_amount-$couponData->discount);
              $discount = $couponData->discount;
            }
            else
            {
              $total_amount = $total_amount-(($total_amount*$couponData->discount)/100);
              $discount = ($total_amount*$couponData->discount)/100;
            }
          }

        @endphp
        @if(isset($couponData))
        <tr class="cart-subtotal">
              <th>Discount</th>
              <td>&nbsp;</td>
              <td class="text-end"><span class="amount" style="color: #3F8E02;">{{env('CURRENCY', '₹')}}{{number_format($discount,2)}}</span></td>
        </tr>
        @endif
        <tr class="cart-subtotal">
              <th>Shipping</th>
              <td>&nbsp;</td>
              <td class="text-end"><span class="amount">@if($setting->shipping_charge) {{env('CURRENCY', '₹')}}{{number_format($setting->shipping_charge,2)}} @else {{env('CURRENCY', '₹')}}0.00 @endif</span></td>
        </tr>
        
        <tr class="order-total">
              <th>Order Total</th>
              <td>&nbsp;</td>
              <td class="text-end"><span class="amount">
                
                {{env('CURRENCY', '₹')}}{{number_format($total_amount,2)}}</span></td>
        </tr>                                          
     </tfoot>
     <input type="hidden" id="total_amount" name="total_amount" value="{{$total_amount}}">
     <input type="hidden" id="coupon_code" name="coupon_code" value="{{$coupon_code}}">
    </table>

    </div>

    <!-- promosec -->
   <!--  <div>
      <div class="promosec">
        <span>Use Promo Code</span>
        <input type="text" wire:model="coupon_code">
        <button type="button" wire:click="checkPromo()">Apply</button>
      </div>
      @if(isset($error_coupon_code))<div class="is-invalid">{{$error_coupon_code}}</div>@endif
    </div> -->

    <!-- promosec -->

</div>