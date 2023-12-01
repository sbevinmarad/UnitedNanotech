@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<div class="page-banne">
    <img @if(isset($banner) && isset($banner->banner)) src="{{asset('storage/app/public/'.$banner->banner)}}" @else src="{{asset('public/assets/images/pagebanner.png')}}" @endif/>
    <div class="container">
        <span><a href="{{route('home')}}" >Home</a> / Product Details</span>
    <h1>Product Details</h1>
    </div>
</div>


 <div class="page-banne-text product-details">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <div class="slider-container">
          <div class="slider-for">
            <img class="item-slick" src="{{asset('storage/app/public/'.$product->image) }}" alt="Alt">
            @if(count($product->productImages))
            @foreach($product->productImages as $key=>$image)
              <img class="item-slick" src="{{asset('storage/app/public/'.$image->image) }}" alt="Alt">
            @endforeach
            @endif
          </div>
          <div class="slider-nav"> 
            <img class="item-slick" src="{{asset('storage/app/public/'.$product->image) }}" alt="Alt">
            @if(count($product->productImages))
            @foreach($product->productImages as $key=>$image)
              <img class="item-slick" src="{{asset('storage/app/public/'.$image->image) }}" alt="Alt">
            @endforeach
            @endif
          </div>
      </div>
      </div>
      <div class="col-md-6 col-sm-12">
        <div class="products-item-dtls">
          <span><img src="{{asset('public/assets/images/tag.png')}}"/> {!! $product->category->name !!}</span>
          <a class="product-heading" href="javascript:void(0);">{!! $product->name !!}</a>
           {!! $product->description !!}
           <div class="btn-grp">
            @if(count($product->productFiles))
            @foreach($product->productFiles as $key=>$image)
            <a href="{{asset('storage/app/public/'.$product->file) }}" download="" class="pdf-btn"><span><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>To know more, Download PDF</a>
            @endforeach
            @endif
            <a href="javascript:void(0);" class="cmn-btn" onclick="enquiryModalBtn('{{$product->id}}');">Send Enqury</a>
           </div>
        </div>
      </div>
    </div>
  </div>
 </div>

@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection