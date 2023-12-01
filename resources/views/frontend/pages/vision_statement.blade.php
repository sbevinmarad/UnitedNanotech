@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<div class="page-banne">
    <img @if(isset($banner) && isset($banner->banner)) src="{{asset('storage/app/public/'.$banner->banner)}}" @else src="{{asset('public/assets/images/pagebanner.png')}}" @endif/>
    <div class="container">
        <span><a href="{{route('home')}}" >Home</a> / Vision Statement</span>
    <h1>Vision Statement</h1>
    </div>
</div>


<div class="page-banne-text">
  <div class="container">
       <div class="cms-item">
         <h2>Empowering Industries with Cutting-edge Nano Solutions</h2>
         <div class="cms-item-boby">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              {!! $cms->description_1 !!}
            </div>
            <div class="col-md-6 col-sm-12">
              <img src="{{asset('storage/app/public/'.$cms->image_1) }}"/>
            </div>
          </div>
         </div>
        
       </div>
       <div class="cms-item">
        <h2>Our Commitment</h2>
        <div class="cms-item-boby">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              {!! $cms->description_2 !!}
            </div>
            <div class="col-md-6 col-sm-12">
              <img src="{{asset('storage/app/public/'.$cms->image_2) }}"/>
            </div>
          </div>
        </div>
       
      </div>
      <div class="cms-item">
        <h2>Catering to Diverse Industries</h2>
        <div class="cms-item-boby">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              {!! $cms->description_3 !!}
                
            </div>
            <div class="col-md-6 col-sm-12">
              <img src="{{asset('storage/app/public/'.$cms->image_3) }}"/>
            </div>
          </div>
        </div>
       
      </div>
      <div class="cms-item">
        <h2>Innovative Nano Solutions</h2>
        <div class="cms-item-boby">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              {!! $cms->description_4 !!}
            </div>
            <div class="col-md-6 col-sm-12">
              <img src="{{asset('storage/app/public/'.$cms->image_4) }}"/>
            </div>
          </div>
        </div>
      </div>
      <div class="cms-item">
        <h2>Collaboration and Sustainability</h2>
        <div class="cms-item-boby">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              {!! $cms->description_5 !!}
            </div>
            <div class="col-md-6 col-sm-12">
              <img src="{{asset('storage/app/public/'.$cms->image_5) }}"/>
            </div>
          </div>
        </div>
      </div>
      <div class="cms-item">
        <h2>Leading the Nano Revolution</h2>
        <div class="cms-item-boby">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              {!! $cms->description_6 !!}
            </div>
            <div class="col-md-6 col-sm-12">
              <img src="{{asset('storage/app/public/'.$cms->image_6) }}"/>
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