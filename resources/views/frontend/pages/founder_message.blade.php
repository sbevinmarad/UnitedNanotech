@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<div class="page-banne">
    <img @if(isset($banner) && isset($banner->banner)) src="{{asset('storage/app/public/'.$banner->banner)}}" @else src="{{asset('public/assets/images/pagebanner.png')}}" @endif/>
    <div class="container">
        <span><a href="{{route('home')}}" >Home</a> / Founder's Message</span>
    <h1>Founder's Message</h1>
    </div>
</div>


<div class="page-banne-text">
  <div class="container">
       <div class="cms-item">
         <h2>Founder's Message: United Nanotech Products Limited</h2>
         <div class="cms-item-boby">
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  {!! $cms->description_1 !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                  <img src="{{asset('storage/app/public/'.$cms->image_1) }}"/>
                </div>
                <div class="col-md-6 col-sm-12">
                  <img src="{{asset('storage/app/public/'.$cms->image_2) }}"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                  {!! $cms->description_2 !!}
                </div>
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