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
                    <h2>My Account</h2>
                    <div class="pageBannerPath">
                        <a href="{{route('home')}}">Home</a>&nbsp;&nbsp; / &nbsp;&nbsp;<span>My Account</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->

<!-- Account Start -->
<section class="account_section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="L_common_W">
                    <div class="usercol">
                        <div class="user_img">
                        @if(isset($user->profile_photo_path))
                        <img src="{{asset('storage/app/public/'.$user->profile_photo_path) }}" alt="user">
                        @else
                        <img src="{{asset('public/assets/images/no_image.png')}}" alt="user">
                        @endif</div>
                        <h5>{{$user->full_name}}</h5>
                    </div>
                    
                    <div id="filter" class="innerfilter">
                        <ul>                            
                            <li><a class="selected" data-filter=".psdbox" href="">My Account</a></li>
                            <li><a data-filter=".edit_profile" href="">Edit Profile</a></li>
                            <li><a data-filter=".changepassword" href="">Change Password</a></li>
                            <li><a data-filter=".orderhistory" href="">Order History</a></li>
                            <li><a href="javascript:void(0)" onclick="event.preventDefault();
                                      document.getElementById('user-logout-form').submit();">Logout</a></li>       
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="R_common_W overflow-auto">
                    <div id="content">


                        <!--tab1-->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 psdbox" >
                            <div class="Achd">ACCOUNT INFORMATION</div>
                            
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">  
                                    <div class="Acountdet">
                                        <div class="Acountdet_name"> 
                                            Contact Details                                            
                                            <!-- <div class="Acountdet_edit" id="edit_profile">Edit</div> --> 
                                        </div>
                                        <div class="Acname">Name : <span>{{$user->full_name}}</span></div>
                                        <div class="Acname">Phone : <span> {{$user->phone}}</span></div>
                                        <div class="Acname">Email ID : <span> {{$user->email}}</span></div>
                                        
                                        <!-- <div class="Acountdet_name"> 
                                            Change Password ?                                      
                                            <input type="password" placeholder="******" class="Acpass">
                                        </div> -->
                                    </div>                                
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
                                    <div class="Acountdet_name"> Address Details </div>
                                    <div class="Acname">Address : <span>{{$user->address}} {{$user->road}} {{$user->city}} {{$user->district}} {{$user->state?$user->state->state:""}} {{$user->pin_code}}</span></div>

                                    <!-- <button type="button" class="tcBTN"><span>Add Address</span></button> -->
                                </div>
                                </div>                                                    
                                                                           
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 edit_profile" >
                            <div class="Achd">EDIT ACCOUNT INFORMATION</div>
                            
                                <form method="post" action="{{route('user.profile.save')}}" enctype="multipart/form-data">
                            @csrf 
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">  
                                    <div class="Acountdet_name"> 
                                        <label>Name</label>                                     
                                        <input type="text" name="name" placeholder="Name" class="Acpass" value="{{$user->full_name}}" required="">
                                        @error('name') <div class="error">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>Phone     </label>                                
                                        <input type="text" name="phone" placeholder="Phone" class="Acpass" value="{{$user->phone}}" required="">
                                        @error('phone') <div class="error">{{ $message }}</div> @enderror
                                    </div>     
                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>Profile Image </label>                                    
                                        <input type="file" name="profile_image"  class="Acpass"  accept="image/png,image/jpg,image/jpeg">
                                        @error('profile_image') <div class="error">{{ $message }}</div> @enderror
                                    </div>     
                                </div>    
                                 
                                @if(isset($user->profile_photo_path))
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                        <div class="user_img">
                                            <img src="{{asset('storage/app/public/'.$user->profile_photo_path) }}"  alt="user">
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>Address </label>
                                        <textarea name="address" rows="6" placeholder="Address" class="Acpass"  required="">{{$user->address}}</textarea>
                                        @error('address') <div class="error">{{ $message }}</div> @enderror
                                    </div>     
                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>City  </label>                                   
                                        <input type="text" name="city" placeholder="City" class="Acpass" value="{{$user->city}}" required="">
                                        @error('city') <div class="error">{{ $message }}</div> @enderror
                                    </div>     
                                    
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>Road  </label>                                   
                                        <input type="text" name="road" placeholder="Road" class="Acpass" value="{{$user->road}}" required="">
                                        @error('road') <div class="error">{{ $message }}</div> @enderror
                                    </div>     
                                    
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>District  </label>                                   
                                        <input type="text" name="district" placeholder="District" class="Acpass" value="{{$user->district}}" required="">
                                        @error('district') <div class="error">{{ $message }}</div> @enderror
                                    </div>     
                                    
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>Pin Code  </label>                                   
                                        <input type="text"  placeholder="Pin Code" class="Acpass" name="pin_code" value="{{$user->pin_code}}" required="">
                                        @error('pin_code') <div class="error">{{ $message }}</div> @enderror
                                    </div>     
                                    
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                    <div class="Acountdet_name"> 
                                        <label>State </label> 
                                        <select name="state_id" class="Acpass" required>
                                            <option value="">Select an option</option>
                                            @if(count($state_list)>0)
                                            @foreach($state_list as $key=>$state)
                                                <option value="{{$state->id}}" @if($user->state_id == $state->id) selected @endif>{{$state->state}}</option>
                                            @endforeach
                                            @endif
                                        </select>                                  
                                        
                                        @error('state_id') <div class="error">{{ $message }}</div> @enderror
                                    </div>     
                                    
                                </div>

                                

                                
                            </div>                                    
                                <button type="submit" class="tcBTN"><span>Submit</span></button>
                            </form> 
                        </div>

                        
                        <!--tab1 end-->


                        <!--tab2-->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 changepassword">
                            <div class="Achd">Change Password</div>
                            <form method="post" action="{{route('user.change.password.save')}}">
                            @csrf 
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                                    <div class="Acountdet_name"> 
                                        <label>Old Password  </label>                                    
                                        <input type="password" name="old_password" placeholder="******" class="Acpass" required="">
                                        @error('old_password') <div class="error">{{ $message }}</div> @enderror
                                    </div>    
                                    <div class="Acountdet_name"> 
                                        <label>New Password   </label>                                  
                                        <input type="password" name="password" placeholder="******" class="Acpass" required="">
                                         @error('password') <div class="error">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="Acountdet_name"> 
                                        <label>Confirm Password </label>                                     
                                        <input type="password" name="password_confirmation" placeholder="******" class="Acpass" required="">
                                        @error('password_confirmation') <div class="error">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>                                    
                                <button type="submit" class="tcBTN"><span>Submit</span></button>
                            </form>
                        </div>
                        <!--tab2 end-->


                        <!--tab3-->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 orderhistory">
                            <div class="Achd">My Order INFORMATION</div>
                            
                            <div class="row">


                                @if(count($orders)>0)
                                @foreach($orders as $order)
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                                    <div class="orderrow">
                                        <div class="orderimg">@if(isset($order->order_details[0]->product->latestImage))
                                        <img src="{{asset('storage/app/public/'.$order->order_details[0]->product->latestImage->image) }}" alt="Product">
                                    @else
                                        <img src="{{asset('public/assets/images/no_image.png')}}" alt="Product">
                                    @endif</div>
                                        <div class="orderinfo">
                                            <h4>{{$order->r_order_id}} </h4>
                                            <div class="orderprice">{{env('CURRENCY', '₹')}}{{number_format(($order->total),2)}}</div>
                                            <div class="orderpay">Payment : <label>{{$order->payment_mode}}</label></div>
                                        </div>
                                        <div class="orderedit">
                                            <div class="order-remove"><a href="{{route('orders.details', $order->r_order_id)}}">View</a></div>
                                            
                                            <div class="orderstatus">
                                                <div class="orderstatusin">Status : <label>
                                                    @if($order->status == '0')
                                                        Pending
                                                    @elseif($order->status == '1')
                                                        Accepted
                                                    @elseif($order->status == '2')
                                                        Delivered
                                                    @elseif($order->status == '3')
                                                        Cancelled
                                                    @endif  
                                                </label></div>
                                            </div>
                                            
                                            <div class="orderstatus">
                                                <div class="orderstatusin"><label><i class="fa fa-clock-o"></i></label> <span>{{$order->created_at->format('d M Y')}}</span></div>
                                            </div>
                                        </div>
                                    </div>                                
                                </div>

                                
                                @endforeach
                                @else
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="orderrow">
                                        <div class="orderinfo">
                                            <h4>No records available </h4>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                



                            </div> 
                            

                            
                        </div>
                        <!--tab3 end-->


                    </div>

                </div>
            </div>
        </div>
        
        
    </div>
</section>
<!-- Account End -->



@endsection

@section('script')
<script type="text/javascript">

$('#edit_profile').click(function(){
    $("#edit_user_profile").css("display", "none");
$("#update_user_profile").css("display", "block");
})

</script>
@endsection