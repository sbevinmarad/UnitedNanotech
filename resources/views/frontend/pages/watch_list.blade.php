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
                    <h2>Watch List</h2>
                    <div class="pageBannerPath">
                        <a href="{{route('home')}}">Home</a>&nbsp;&nbsp; / &nbsp;&nbsp;<span>Watch List</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->



<!-- BEGIN: Shop Page Section -->
<section class="shopPageSection shopPageHasSidebar">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12 col-xl-12">
                <div class="row shopProductRow">
                        @if(count($products)>0)
                        @foreach($products as $key=>$product)
                    <div class="col-sm-6 col-lg-4 col-xl-4">
                        <!-- tpproduct -->
                            <div class="tpproduct p-relative">
                                <div class="tpproduct__thumb p-relative text-center">
                                    @if(Auth::user() && Auth::user()->hasRole('CLIENT'))
                                        @if(in_array($product->id, Auth::user()->favouitable_products()->pluck('product_id')->toArray()))
                                            <div class="common_post_heart"  onclick="addToFavorite(this,'{{$product->id}}')">
                                                <img src="{{asset('public/assets/images/heart.svg')}}" alt="">
                                            </div>
                                        @else
                                            <div class="common_post_heart"  onclick="addToFavorite(this,'{{$product->id}}')">
                                                <img src="{{asset('public/assets/images/heart-empty.svg')}}" alt="">
                                            </div>
                                        @endif
                                    @else
                                    <a href="{{route('user.login')}}">
                                        <div class="common_post_heart" >
                                            <img src="{{asset('public/assets/images/heart-empty.svg')}}" alt="">
                                        </div>
                                    </a>
                                    @endif
                                   <!-- <a href="{{route('productDetails', $product->slug)}}"> --><img src="{{asset('storage/app/public/'.$product->latestImage->image) }}" alt=""><!-- </a> -->
                                </div>
                                <div class="tpproduct__content">
                                   <h4 class="tpproduct__title">
                                      <a href="{{route('productDetails', $product->slug)}}">
                                        @if(strlen($product->name) > 20)
                                            {!! substr($product->name,0,20)."..." !!}
                                        @else
                                            {!! $product->name !!}
                                        @endif</a>
                                   </h4>
                                   <span class="tpproduct__content-weight">
                                      <a href="{{route('productDetails', $product->slug)}}">
                                        @if(strlen($product->description) > 60)
                                            {!! substr(strip_tags($product->description),0,60)."..." !!}
                                        @else
                                            {!! strip_tags($product->description) !!}
                                        @endif
                                      </a>
                                   </span>
                                   <div class="tpproduct__price">
                                      <span>{{env('CURRENCY', '₹')}} {{number_format($product->price,2)}}</span>
                                   </div>
                                </div>
                                @php
                                    $product_quantity= 0;
                                    $user_id= 0;
                                    if(Auth::user() && Auth::user()->hasRole('CLIENT'))
                                    {
                                        $user_id = Auth::user()->id;
                                    }
                                    
                                    $cartItem = \App\Models\Cart::where(function($q) use($user_id){
                                        $q->where('user_id', $user_id)->orWhere('session_id',Session::get('user_session_id'));
                                    })->where('product_id',  $product->id)->first();
                                    if(isset($cartItem))
                                    {
                                        $product_quantity = $cartItem->quantity;
                                    }
                                @endphp

                                <div class="cartbox">
                                    <button class="plusbtn cartBtn" id="cartBtn{{$product->id}}" onclick="cartBtn({{$product->id}});" @if($product_quantity > 0) style="display : none;" @endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                        <g id="Union_1" data-name="Union 1" transform="translate(1764 326)" fill="#fff">
                                            <path d="M -1757.499877929688 -314.5001220703125 L -1758.499633789062 -314.5001220703125 L -1758.499633789062 -318.9996032714844 L -1758.499633789062 -319.4996032714844 L -1758.999633789062 -319.4996032714844 L -1763.5 -319.4996032714844 L -1763.5 -320.5003051757812 L -1758.999633789062 -320.5003051757812 L -1758.499633789062 -320.5003051757812 L -1758.499633789062 -321.0003051757812 L -1758.499633789062 -325.4998168945312 L -1757.499877929688 -325.4998168945312 L -1757.499877929688 -321.0003051757812 L -1757.499877929688 -320.5003051757812 L -1756.999877929688 -320.5003051757812 L -1752.500366210938 -320.5003051757812 L -1752.500366210938 -319.4996032714844 L -1756.999877929688 -319.4996032714844 L -1757.499877929688 -319.4996032714844 L -1757.499877929688 -318.9996032714844 L -1757.499877929688 -314.5001220703125 Z" stroke="none"/>
                                            <path d="M -1753.000366210938 -319.9996032714844 L -1753.000366210938 -320.0003051757812 L -1763 -319.9996032714844 L -1753.000366210938 -319.9996032714844 M -1756.999877929688 -314.0001220703125 L -1758.999633789062 -314.0001220703125 L -1758.999633789062 -318.9996032714844 L -1764 -318.9996032714844 L -1764 -321.0003051757812 L -1758.999633789062 -321.0003051757812 L -1758.999633789062 -325.9998168945312 L -1756.999877929688 -325.9998168945312 L -1756.999877929688 -321.0003051757812 L -1752.000366210938 -321.0003051757812 L -1752.000366210938 -318.9996032714844 L -1756.999877929688 -318.9996032714844 L -1756.999877929688 -314.0001220703125 Z" stroke="none" fill="#fff"/>
                                        </g>
                                        </svg>
                                    </button>

                                    <div class="cartboxin" id="cartboxin{{$product->id}}" @if($product_quantity > 0) style="display : flex;" @endif>
                                        <button class="cartminus" onclick="cartminus({{$product->id}});">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="2" viewBox="0 0 12 2">
                                                <g id="Rectangle_364" data-name="Rectangle 364" transform="translate(0 2) rotate(-90)" fill="#fff" stroke="#fff" stroke-width="1">
                                                  <rect width="2" height="12" stroke="none"/>
                                                  <rect x="0.5" y="0.5" width="1" height="11" fill="none"/>
                                                </g>
                                              </svg>
                                              
                                        </button>
                                        <input type="text" class="cartvalue" id="quantity{{$product->id}}" readonly="" name="quantity" value="{{$product_quantity}}">
                                        <button class="cartplus" onclick="cartplus({{$product->id}});">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                <g id="Union_1" data-name="Union 1" transform="translate(1764 326)" fill="#fff">
                                                    <path d="M -1757.499877929688 -314.5001220703125 L -1758.499633789062 -314.5001220703125 L -1758.499633789062 -318.9996032714844 L -1758.499633789062 -319.4996032714844 L -1758.999633789062 -319.4996032714844 L -1763.5 -319.4996032714844 L -1763.5 -320.5003051757812 L -1758.999633789062 -320.5003051757812 L -1758.499633789062 -320.5003051757812 L -1758.499633789062 -321.0003051757812 L -1758.499633789062 -325.4998168945312 L -1757.499877929688 -325.4998168945312 L -1757.499877929688 -321.0003051757812 L -1757.499877929688 -320.5003051757812 L -1756.999877929688 -320.5003051757812 L -1752.500366210938 -320.5003051757812 L -1752.500366210938 -319.4996032714844 L -1756.999877929688 -319.4996032714844 L -1757.499877929688 -319.4996032714844 L -1757.499877929688 -318.9996032714844 L -1757.499877929688 -314.5001220703125 Z" stroke="none"/>
                                                    <path d="M -1753.000366210938 -319.9996032714844 L -1753.000366210938 -320.0003051757812 L -1763 -319.9996032714844 L -1753.000366210938 -319.9996032714844 M -1756.999877929688 -314.0001220703125 L -1758.999633789062 -314.0001220703125 L -1758.999633789062 -318.9996032714844 L -1764 -318.9996032714844 L -1764 -321.0003051757812 L -1758.999633789062 -321.0003051757812 L -1758.999633789062 -325.9998168945312 L -1756.999877929688 -325.9998168945312 L -1756.999877929688 -321.0003051757812 L -1752.000366210938 -321.0003051757812 L -1752.000366210938 -318.9996032714844 L -1756.999877929688 -318.9996032714844 L -1756.999877929688 -314.0001220703125 Z" stroke="none" fill="#fff"/>
                                                </g>
                                                </svg>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            <!-- tpproduct -->
                    </div>
                        @endforeach
                        @else
                            <div class="col-sm-6 col-lg-12 col-xl-12">
                                <div class="tpproduct p-relative">
                                    <h4 style="text-align: center;">No records available</h4>
                                </div>
                            </div>
                        
                        @endif

                    


                </div>
                <!-- <div class="row shopPaginationRow">
                    <div class="col-lg-12 text-center">
                        <div class="shopPagination">
                            <span class="current">1</span>
                            <a href="javascript:void(0);">2</a>
                            <a href="javascript:void(0);">3</a>
                            <a href="javascript:void(0);"><i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>
<!-- END: Shop Page Section -->


@endsection

@section('script')
<script type="text/javascript">
    
 $(document).ready(function() { 
   $('input[name=price_filter]').change(function(){
        $('#product_form').submit();
   });
  });
    
</script>
@endsection