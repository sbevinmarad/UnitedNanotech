@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<div class="page-banne">
    <img @if(isset($banner) && isset($banner->banner)) src="{{asset('storage/app/public/'.$banner->banner)}}" @else src="{{asset('public/assets/images/pagebanner.png')}}" @endif/>
    <div class="container">
        <span><a href="{{route('home')}}" >Home</a> / Our Team</span>
    <h1>Our Team</h1>
    </div>
</div>


<div class="page-banne-text">
  <div class="container">
       <div class="cms-item">
         <h2>Our Team and Workforce of United Nanotech Products Limited</h2>
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
        <h2>Leadership Team</h2>
        <div class="cms-item-boby">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              {!! $cms->description_2 !!}
            </div>
            <div class="col-md-6 col-sm-12">
              <img src="{{asset('storage/app/public/'.$cms->image_2) }}"/>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <img src="{{asset('storage/app/public/'.$cms->image_3) }}"/>
            </div>
            <div class="col-md-6 col-sm-12">
              {!! $cms->description_3 !!}
            </div>
          </div>
        </div>
       
      </div>
      
      <div class="cms-item">
        <h2>Research and Development</h2>
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
        <h2>Production and Quality Assurance</h2>
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
        <h2>Sales and Business Development</h2>
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
      <div class="cms-item">
        <h2>Customer Support and Services</h2>
        <div class="cms-item-boby">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              {!! $cms->description_7 !!}
            </div>
            <div class="col-md-6 col-sm-12">
              <img src="{{asset('storage/app/public/'.$cms->image_7) }}"/>
            </div>
            
          </div>
        </div>
      </div>
      <div class="cms-item">
        <h2>Administration and Operations</h2>
        <div class="cms-item-boby">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              {!! $cms->description_8 !!}
            </div>
            <div class="col-md-6 col-sm-12">
              <img src="{{asset('storage/app/public/'.$cms->image_8) }}"/>
            </div>
          </div>
        </div>
      </div>
      <div class="cms-item">
        <h2>Collaborative Culture</h2>
        <div class="cms-item-boby">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              {!! $cms->description_9 !!}
            </div>
            <div class="col-md-6 col-sm-12">
              <img src="{{asset('storage/app/public/'.$cms->image_9) }}"/>
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