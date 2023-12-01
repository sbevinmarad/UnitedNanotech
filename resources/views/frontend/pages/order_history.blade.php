@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<!-- Page Banner Start -->
<section class="page-banner text-white py-190 rpy-130" @if(isset($banner) && isset($banner->banner)) style="background-image: url('{{asset('storage/app/public/'.$banner->banner)}}')" @else style="background-image: url({{asset('public/assets/images/banner.jpg')}});" @endif>
    <div class="container">
        <div class="banner-inner">
            <h1 class="page-title wow fadeInRight delay-0-2s">Order History</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center wow fadeInLeft delay-0-2s">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Order History</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Page Banner End -->


<!--Cart Section-->
<section class="cart-section">
    <div class="container">
        
        <!--Cart Outer-->
        <div class="cart-outer">
            <div class="table-outer">
                <table class="cart-table">
                    <thead class="cart-header">
                        <tr>
                            <th class="prod-column">Product Name</th>
                            <th>Quantity</th>
                            <th class="price">Price</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <!-- <th>Remove</th> -->
                        </tr>
                    </thead>
                    
                    <tbody>
                        @php
                            $sub_total = 0;
                            $tax = 0;
                            $total = 0;
                        @endphp
                        @if(count($orders)>0)
                        @foreach($orders as $key=>$order)
                            @php
                                $sub_total+= ($order->quantity*$order->price);
                                $tax+=(($sub_total*$siteSetting->tax)/100);
                            @endphp
                            <tr>
                                <td class="prod-column">
                                  <h6 class="prod-title">{{@$order->product_name}}</h6>
                                </td>
                                <td class="qty">{{$order->quantity}}</td>
                                <td class="price">{{env('CURRENCY', '₹')}}{{$order->price}}</td>
                                <td class="qty">{{env('CURRENCY', '₹')}}{{$order->total}}</td>
                                <td class="qty">{{$order->created_at->format('d M, Y')}}</td>
                                <!-- <td class="remove"><a href="javascript:void(0)" class="remove-btn" onclick="deleteCart({{$order->id}})" ><span class="fa fa-times"></span></a></td> -->
                            </tr>
                        @endforeach
                        @else
                        <tr><td colspan="5" style="text-align: center;">No records available</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
            

    </div>
</section>
@endsection

@section('script')
<script type="text/javascript">


                function qtyChange(id) {   
                    var value = $('#qty'+id).val();
                    $.ajax({
                        type: "POST",
                          url:"{{route('cart.quantity')}}",
                          data: {
                              'id': id,
                              'value': value,
                              '_token':'{{@csrf_token()}}'
                          },
                          dataType: "JSON",
                          success: function(jsn) {
                            if(jsn.code == 1){
                                location.reload();
                            }
                            else{
                                toastr["error"]('Something went wrong');
                            } 
                          }
                        })
                    }

                    

                    function deleteCart(id) {   

                        Swal.fire({
                      title: 'Are you sure?',
                      text: "You want to delete!",    
                      icon: 'error',
                      showCancelButton: true,
                      confirmButtonText: 'Yes',
                      cancelButtonText: 'No',
                      reverseButtons: true 
                    }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                          url:"{{route('cart.delete')}}",
                          data: {
                              'id': id,
                              '_token':'{{@csrf_token()}}'
                          },
                          dataType: "JSON",
                          success: function(jsn) {
                            if(jsn.code == 1){
                                location.reload();
                            }
                             
                          }
                        })
                    }
                    })
                    }
                    
                        
            </script>
@endsection