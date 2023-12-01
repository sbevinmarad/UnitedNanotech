@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<div class="page-banne">
    <img @if(isset($banner) && isset($banner->banner)) src="{{asset('storage/app/public/'.$banner->banner)}}" @else src="{{asset('public/assets/images/pagebanner.png')}}" @endif/>
    <div class="container">
        <span><a href="{{route('home')}}" >Home</a> / Gallery</span>
    <h1>Gallery</h1>
    </div>
</div>


 <div class="page-banne-text">
    <div class="container">
        <div class="row">
            @if(count($galleries)>0)
            @foreach($galleries as $gallery)
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="gallery-item">
                    <a href="{{asset('storage/app/public/'.$gallery->image) }}" data-fancybox="preview">
                    <img src="{{asset('storage/app/public/'.$gallery->image) }}"/>
                </a>
              </div>
            </div>
            @endforeach
            @endif
        </div>
   <!-- <div class="text-center">
    <a href="javascript:void(0);" class="cmn-btn">Load More</a>
   </div> -->
    
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection