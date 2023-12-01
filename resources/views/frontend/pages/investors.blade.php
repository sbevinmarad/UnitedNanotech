@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<div class="page-banne">
    <img @if(isset($banner) && isset($banner->banner)) src="{{asset('storage/app/public/'.$banner->banner)}}" @else src="{{asset('public/assets/images/pagebanner.png')}}" @endif/>
    <div class="container">
        <span><a href="{{route('home')}}" >Home</a> / Investor</span>
    <h1>Investor</h1>
    </div>
</div>


<div class="page-banne-text">
    <div class="container">
        <div class="row">
            @if(count($investors)>0)
            @foreach($investors as $investor)
            <div class="col-md-4 col-sm-6 col-xs-12">
               <div class="products-item">
                  <a href="{{ asset('storage/app/public/'.$investor->image)}}" target="_blank">
                <div class="products-item-img">
                  @if(str_ends_with($investor->image, '.pdf'))
                    <iframe src="{{ asset('storage/app/public/'.$investor->image)}}" ></iframe>
                  @else
                  <img src="{{asset('storage/app/public/'.$investor->image) }}"/>
                  @endif
                </div>
                  </a>
                <div class="products-item-dtls">
                  <a class="product-heading" >{!! $investor->name !!}</a>
                   
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
   
    
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection