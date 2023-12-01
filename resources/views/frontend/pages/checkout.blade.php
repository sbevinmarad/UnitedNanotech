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
                    <h2>Checkout</h2>
                    <div class="pageBannerPath">
                        <a href="{{route('home')}}">Home</a>&nbsp;&nbsp; / &nbsp;&nbsp;<span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->

<!-- BEGIN: Checkout Page Section -->
<section class="coupon-area pt-70 pb-30">
    <div class="container">
    <div class="row">
       <div class="col-md-12">
        @if(Auth::user() && Auth::user()->hasRole('CLIENT'))
          
          @else
          <div class="coupon-accordion">
                <!-- ACCORDION START -->
                <h3>Returning customer? <a href="{{route('user.login')}}">Click here to login</a></h3>
                <!-- ACCORDION END -->
          </div>
          @endif
       </div>
    </div>
 </div>
 </section>

<!-- END: Checkout Page Section -->

<!-- BEGIN: Checkout Page Section -->
  <!-- checkout-area start -->
    <section class="checkout-area pb-50">
  <div class="container">
     <form method="post" action="{{route('payment')}}" id="payment_form">
      @csrf
        <div class="row">
              <div class="col-lg-6 col-md-12">
                 <div class="checkbox-form checkoutForm">
                    <h3>Shipping Address</h3>
                    <div class="row">
                          
                          <div class="col-md-6">
                             <div class="checkout-form-list">
                                <label> Name <span class="required">*</span></label>
                                <input type="text" placeholder="" id="name" value="{{old('name',@$user->name)}}" name="name"  required>
                                @error('name') <div class="error">{{ $message }}</div> @enderror
                             </div>
                          </div>

                          <div class="col-md-6">
                              <div class="checkout-form-list">
                                 <label>Email  <span class="required">*</span></label>
                                 <input type="email" placeholder="" value="{{old('email',@$user->email)}}" id="email" name="email" required>
                                 @error('email') <div class="error">{{ $message }}</div> @enderror
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="checkout-form-list">
                                 <label>Phone <span class="required">*</span></label>
                                 <input type="text" placeholder="" value="{{old('phone',@$user->phone)}}" onkeypress="return number_check(this,event);" id="phone" name="phone" required>
                                 @error('phone') <div class="error">{{ $message }}</div> @enderror
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="checkout-form-list">
                                 <label>Address <span class="required">*</span></label>
                                 <input type="text" placeholder="" id="address" value="{{old('address',@$user->address)}}" name="address" required>
                                 @error('address') <div class="error">{{ $message }}</div> @enderror
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="checkout-form-list">
                                 <label>Road</label>
                                 <input type="text" placeholder="" value="{{old('road',@$user->road)}}" name="road">
                                 @error('road') <div class="error">{{ $message }}</div> @enderror
                              </div>
                           </div>


                           <div class="col-md-6">
                              <div class="checkout-form-list">
                                 <label>Town / City <span class="required">*</span></label>
                                 <input type="text" placeholder="" value="{{old('city',@$user->city)}}" name="city" required>
                                 @error('city') <div class="error">{{ $message }}</div> @enderror
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="checkout-form-list">
                                 <label>Postcode / Zip <span class="required">*</span></label>
                                 <input type="text" placeholder="" onkeypress="return number_check(this,event);" value="{{old('pin_code',@$user->pin_code)}}" name="pin_code" required maxlength="6" minlength="6">
                                 @error('pin_code') <div class="error">{{ $message }}</div> @enderror
                              </div>
                           </div>

                           

                           <div class="col-md-6">
                              <div class="checkout-form-list">
                                 <label>District <span class="required">*</span></label>
                                 <input type="text" placeholder="" value="{{old('district',@$user->district)}}" name="district" required>
                                 @error('district') <div class="error">{{ $message }}</div> @enderror
                              </div>
                           </div>


                           <div class="col-md-12">
                              <div class="checkout-form-list">
                                 <label>State<span class="required">*</span></label>
                                 <select  name="state_id" required>
                                  @if(count($state_list)>0)
                                  @foreach($state_list as $key=>$state)
                                      <option value="{{$state->id}}" @if(@$user->state_id == $state->id) selected @endif>{{$state->state}}</option>
                                  @endforeach
                                  @endif
                              </select>
                              @error('state_id') <div class="error">{{ $message }}</div> @enderror
                              </div>
                           </div>

                           

                    </div>
                 
                 </div>
              </div>
              <div class="col-lg-6 col-md-12">
                 <div class="your-order mb-30 ">
                    <h3>Summery Table</h3>

                          
                          <livewire:frontend.cart.checkout />
                    
                    <ul class="wc_payment_methods">
                      
                      <li class="active">
                          <input type="radio" value="3" name="paymentMethod" id="Razorpay" checked="">
                          <label for="Razorpay">
                              <svg id="razorpay-icon" xmlns="http://www.w3.org/2000/svg" width="92.635" height="20" viewBox="0 0 92.635 20">
                                  <path id="Path_6097" data-name="Path 6097" d="M8.436,9.03l-2.45,9.378H0l1.214-4.614Z" transform="translate(0 -2.223)" fill="#072654"/>
                                  <path id="Path_6098" data-name="Path 6098" d="M25.274,5.08a3.855,3.855,0,0,1,2.948.942,2.765,2.765,0,0,1,.384,2.684,4.589,4.589,0,0,1-1.2,2.111,4.89,4.89,0,0,1-2.164,1.266,1.46,1.46,0,0,1,1.131,1.349l.023.166.452,3.837H24.06L23.593,13.3a.9.9,0,0,0-.113-.392.868.868,0,0,0-.279-.294,1.742,1.742,0,0,0-.754-.188H20.57l-1.312,5H16.65L19.892,5.08ZM96.733,8.314l-3.317,4.78L89.5,18.763l-.03.03L88.6,20.059l-.03.045-.038.06-.754,1.086H85.184l3.031-4.274-1.372-8.36h2.691l.678,5.45L93.5,9.4l.045-.068.053-.075.053-.068.407-.867h2.676Zm-22.978.663a2.774,2.774,0,0,1,.935,1.651,5.4,5.4,0,0,1-.158,2.427,7.192,7.192,0,0,1-1.1,2.4,5.39,5.39,0,0,1-1.772,1.606,4.466,4.466,0,0,1-2.149.55,2.766,2.766,0,0,1-1.523-.384,1.856,1.856,0,0,1-.776-.92l-.045-.151L65.832,21.25H63.246l2.646-10.1.015-.045.008-.045.648-2.45h2.525l-.43,1.417-.008.06a3.8,3.8,0,0,1,1.44-1.236A3.958,3.958,0,0,1,71.938,8.4a2.733,2.733,0,0,1,1.817.58Zm-3.121,1.4a2.272,2.272,0,0,0-.89.166,2.386,2.386,0,0,0-.754.5,3.994,3.994,0,0,0-1.025,1.915,2.687,2.687,0,0,0,.015,1.907,1.324,1.324,0,0,0,1.3.663,2.281,2.281,0,0,0,1.643-.648,3.963,3.963,0,0,0,1-1.877,2.821,2.821,0,0,0-.023-1.937,1.277,1.277,0,0,0-1.266-.686Zm11.61-1.6a1.932,1.932,0,0,1,.769.927l.053.143L83.4,8.6H85.93l-2.322,8.82H81.068l.339-1.3a4.062,4.062,0,0,1-3.076,1.44A2.927,2.927,0,0,1,76.462,17a2.572,2.572,0,0,1-.935-1.591,5.232,5.232,0,0,1,.143-2.39,7.388,7.388,0,0,1,1.123-2.42,5.665,5.665,0,0,1,1.794-1.643,4.257,4.257,0,0,1,2.133-.58,2.691,2.691,0,0,1,1.523.407ZM80.932,10.4a2.271,2.271,0,0,0-.9.181,2.379,2.379,0,0,0-.761.513,4.083,4.083,0,0,0-1.025,1.922,2.6,2.6,0,0,0,.03,1.877,1.343,1.343,0,0,0,1.319.656,2.272,2.272,0,0,0,.89-.166,2.3,2.3,0,0,0,.754-.5,4.07,4.07,0,0,0,.95-1.674l.06-.234a2.6,2.6,0,0,0-.023-1.907,1.33,1.33,0,0,0-1.3-.671ZM65.259,8.51l.166.068-.648,2.4a2.525,2.525,0,0,0-1.184-.294,2.617,2.617,0,0,0-1.711.565,2.919,2.919,0,0,0-.89,1.372l-.053.2-1.206,4.606H57.155l2.337-8.82h2.541l-.332,1.3a3.772,3.772,0,0,1,1.184-1.055,3.35,3.35,0,0,1,1.674-.445,1.721,1.721,0,0,1,.7.1Zm-9.521.422a2.611,2.611,0,0,1,1.146,1.6,4.654,4.654,0,0,1-.083,2.427,6.414,6.414,0,0,1-1.191,2.427,5.532,5.532,0,0,1-1.99,1.6,5.842,5.842,0,0,1-2.525.55,4.188,4.188,0,0,1-2.262-.55,2.633,2.633,0,0,1-1.161-1.6,4.817,4.817,0,0,1,.083-2.427,6.525,6.525,0,0,1,1.191-2.427,5.6,5.6,0,0,1,2.005-1.6,5.866,5.866,0,0,1,2.556-.55,4.078,4.078,0,0,1,2.231.55Zm-2.759,1.44a2.345,2.345,0,0,0-1.643.648,3.947,3.947,0,0,0-1.025,1.937q-.678,2.59,1.312,2.586a2.253,2.253,0,0,0,1.621-.641,4.02,4.02,0,0,0,1.01-1.945,2.8,2.8,0,0,0,.008-1.937,1.279,1.279,0,0,0-1.282-.648ZM47.739,8.608l-.452,1.749L41.6,15.385h4.568l-.543,2.058H38.06l.475-1.817,5.6-4.953H39.877l.543-2.058h7.32Zm-12.763.173a1.932,1.932,0,0,1,.769.927l.053.143L36.13,8.6H38.67l-2.314,8.82H33.815l.339-1.3A4.094,4.094,0,0,1,32.76,17.18a4.047,4.047,0,0,1-1.711.377A2.9,2.9,0,0,1,29.2,17a2.572,2.572,0,0,1-.935-1.591,5.232,5.232,0,0,1,.143-2.39,7.237,7.237,0,0,1,1.123-2.42A5.721,5.721,0,0,1,31.32,8.955a4.25,4.25,0,0,1,2.133-.573,2.746,2.746,0,0,1,1.523.4Zm-1.3,1.621a2.3,2.3,0,0,0-.9.181,2.379,2.379,0,0,0-.761.513,4.018,4.018,0,0,0-1.025,1.922,2.64,2.64,0,0,0,.03,1.877,1.343,1.343,0,0,0,1.319.656,2.272,2.272,0,0,0,.89-.166,2.3,2.3,0,0,0,.754-.5,3.943,3.943,0,0,0,.95-1.674l.06-.234a2.768,2.768,0,0,0-.023-1.907,1.337,1.337,0,0,0-1.3-.671ZM24.339,7.138H21.92l-.852,3.227h2.42a3.3,3.3,0,0,0,1.772-.392,1.968,1.968,0,0,0,.852-1.229,1.147,1.147,0,0,0-.2-1.221,2.435,2.435,0,0,0-1.568-.384Z" transform="translate(-4.098 -1.25)" fill="#072654"/>
                                  <path id="Path_6099" data-name="Path 6099" d="M15.56,0,11.308,16.185H8.39L11.263,5.224l-4.4,2.9.784-2.887Z" transform="translate(-1.688)" fill="#3395ff"/>
                                </svg>
                                
                          </label>
                      </li>
                      <li>
                          <input type="radio" value="Cash on Delivery" name="paymentMethod" id="cash_on_delivery" checked="">
                          <label for="cash_on_delivery">Cash On Delivery</label>
                      </li>
                  </ul>

                  <div class="order-button-payment mt-20">
                      <button type="submit" id="rzp-button1" class="tp-btn tp-color-btn w-100 banner-animation">Place order</button>
                      <!-- <button id="rzp-button1">Pay Now</button> -->
                   </div>
                      


                 </div>
              </div>
        </div>
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
     </form>
  </div>
</section>
    
  <!-- checkout-area end -->
<!-- END: Checkout Page Section -->

 

@endsection

@section('script')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    var order_id = '';
    var name;
    var email;
    var phone;
    var address;
    var total_amount =0.00;
    
    
    document.getElementById('rzp-button1').onclick = function(e) {
      $("#payment_form").validate({
      rules: {
        name: "required",
        email: "required",
        phone: "required",
        address: "required",
        city: "required",
        state_id: "required",
        pin_code: "required"
      },
      submitHandler:function(){
            name =$('#name').val();
            email =$('#email').val();
            phone =$('#phone').val();
            address =$('#address').val();
            coupon_code =$('#coupon_code').val();
           
        if(document.getElementById('Razorpay').checked) {
              $.ajax({
              type: "POST",
                url:"{{route('get-order-id')}}",
                data: {
                    'coupon_code': 0,
                    '_token':'{{@csrf_token()}}'
                },
                dataType: "JSON",
                success: function(jsn) {
                  
                  order_id = jsn.order_id;
                  total_amount = jsn.total_amount*100;
                  
                var options = {
                "key": "{{$siteSetting->razor_pay_key}}",
                "order_id": order_id,
                "amount": total_amount,
                "currency": "INR",
                "name": name,
                "description": "Zadekart Product Purchase",
                "image": "{{asset('storage/app/public/'.@$siteSetting->logo) }}",
                "handler": function(response) {
                  if(response.razorpay_order_id != "")
                  {
                    
                    $('#razorpay_payment_id').val(response.razorpay_payment_id);
                    $('#razorpay_order_id').val(response.razorpay_order_id);
                    var data = $('#payment_form').serialize()
                    $.ajax({
                    type: "POST",
                       url: "{{route('payment')}}",
                      method: "post",
                      data: data,
                      dataType: "json",
                      success: function(jsn) {
                        if(jsn.status == true)
                        {
                          //toastr["success"]('Your order placed successfully');
                          window.location = jsn.url;
                        }
                        else{
                           toastr["error"]('Something went wrong');
                        }
                      }
                    });
                  }
              },
              "prefill": {
                  "name": name,
                  "email": email,
                  "contact": phone
              },
              "notes": {
                  "address": address
              },
              "theme": {
                  "color": "#528FF0"
              }
          };
          var rzp1 = new Razorpay(options);
                  rzp1.open();
                  e.preventDefault();
                }
              });
            }
            else{
              var data = $('#payment_form').serialize()
                $.ajax({
                type: "POST",
                   url: "{{route('payment')}}",
                  method: "post",
                  data: data,
                  dataType: "json",
                  success: function(jsn) {
                    if(jsn.status == true)
                    {
                      //toastr["success"]('Your order placed successfully');
                      window.location = jsn.url;
                    }
                    else{
                       toastr["error"]('Something went wrong');
                    }
                  }
                });
            }
        }
    });
    }
</script>
@endsection