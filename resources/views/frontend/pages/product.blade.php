@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<div class="page-banne">
    <img @if(isset($banner) && isset($banner->banner)) src="{{asset('storage/app/public/'.$banner->banner)}}" @else src="{{asset('public/assets/images/pagebanner.png')}}" @endif/>
    <div class="container">
        <span><a href="{{route('home')}}" >Home</a> / Product</span>
    <h1>Product</h1>
    </div>
</div>


 <div class="page-banne-text">
    <div class="container">
      <div class="row">
      @if(count($categories)>0)
      @foreach($categories as $category)
        <div class="col-md-12 col-sm-12 col-xs-12 mb-4">
          <h2>{{$category->name}}</h2>
        </div>
        <div class="row">
            @if(count($category->products)>0)
            @foreach($category->products as $product)
            <div class="col-md-4 col-sm-6 col-xs-12">
               <div class="products-item">
                <div class="products-item-img">
                  <img src="{{asset('storage/app/public/'.$product->image) }}"/>
                </div>
                <div class="products-item-dtls">
                  <span><img src="{{asset('public/assets/images/tag.png')}}"/> {!! $product->category->name !!}</span>
                  <a class="product-heading" href="{{route('productDetails', [$product->slug])}}">{!! $product->name !!}</a>
                   <p>
                        @if(strlen($product->description) > 150)
                            {!! substr(strip_tags($product->description),0,160)."..." !!}
                        @else
                            {!! $product->description !!}
                        @endif
                    </p>
                   <div class="text-center">
                    <a href="javascript:void(0);" class="cmn-btn" onclick="enquiryModalBtn('{{$product->id}}');">Send Enqury</a>
                   </div>
                </div>
               </div>
              </div>
            @endforeach
            @else
             <div class="col-md-12 col-sm-12 col-xs-12">
              <p style="text-align: center;">No records found</p>
             </div>
            @endif
        </div>
        @endforeach
        @endif
      </div>
    
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection