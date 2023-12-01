@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" @if(isset($banner) && isset($banner->banner)) style="background-image: url('{{asset('storage/app/public/'.$banner->banner)}}')" @else style="background-image: url({{asset('public/assets/images/inner_header.jpg')}});" @endif>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2>Order Success</h2>
                    <div class="pageBannerPath">
                        <a href="{{route('home')}}">Home</a>&nbsp;&nbsp; / &nbsp;&nbsp;<span>Order Success</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->

<!-- ayment Success Start -->
<section class="success-page">
    <div class="container">
        <div class="success-img">
            <img src="{{asset('public/assets/images/success-banner.svg')}}" alt="success">
        </div>

        <h2>Payment Successful !</h2>
        <h4>Thank You For Your Purchase</h4>
        <p>You will receive an order confirmation email details of your order.</p>
        <p style="color: #8e3ef3;">Your Order {{$order->r_order_id}}</p>

        <div class="row justify-content-md-center mt-50">
            <div class="col-lg-5 col-md-12 newbox">
                   <h3>Your order</h3>
                   <div class="your-order-table table-responsive">
                         <table>
                            <thead>
                               <tr>
                                  <th class="product-name">Product</th>
                                  <th class="product-total">Total</th>
                               </tr>
                            </thead>
                            <tbody>
                                @php
                                $sub_total = 0;
                                $tax = 0;
                                $total = 0;
                                @endphp
                                @if(count($order->order_details)>0)
                                @foreach($order->order_details as $order_details)
                                @php
                                    $sub_total+= ($order_details->quantity*$order_details->price);
                                    if($siteSetting->gst)
                                    {
                                      $tax+=(($siteSetting->gst*$order_details->total)/100);
                                    }
                                @endphp
                               <tr class="cart_item">
                                     <td class="product-name">{{$order_details->product_name}} <strong class="product-quantity"> × {{$order_details->quantity}}</strong></td>
                                     <td class="product-total"><span class="amount">{{env('CURRENCY', '₹')}}{{number_format(($order_details->quantity*$order_details->price),2)}}</span></td>
                               </tr>
                               @endforeach
                               @endif
                            </tbody>
                            <tfoot>
                              <tr class="cart-subtotal">
                                    <th>Subtotal</th>
                                    <td><span class="amount">{{env('CURRENCY', '₹')}}{{number_format($sub_total,2)}}</span></td>
                              </tr>
                              <tr class="cart-subtotal">
                                    <th>Vat / GST</th>
                                    <td><span class="amount">{{env('CURRENCY', '₹')}}{{number_format($tax,2)}}</span></td>
                              </tr>

                              @if($order->discount)
                              <tr class="cart-subtotal">
                                    <th>Discount</th>
                                    <td><span class="amount">{{env('CURRENCY', '₹')}}{{number_format($order->discount,2)}}</span></td>
                              </tr>
                              @endif
                              
                              <tr class="order-total">
                                    <th>Order Total</th>
                                    <td><span class="amount">{{env('CURRENCY', '₹')}}{{number_format(((($sub_total+$tax+$siteSetting->shipping_charge)-$order->discount)),2)}}</span></strong></td>
                              </tr>                                          
                           </tfoot>
                         </table>
                   </div>
             </div>
        </div>
    </div>
</section>
<!-- Payment Success End -->

@endsection
@section('script')
<script type="text/javascript">
    

    
</script>
@endsection