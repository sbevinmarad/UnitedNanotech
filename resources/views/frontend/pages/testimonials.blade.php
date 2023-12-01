@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<div class="page-banne">
    <img @if(isset($banner) && isset($banner->banner)) src="{{asset('storage/app/public/'.$banner->banner)}}" @else src="{{asset('public/assets/images/pagebanner.png')}}" @endif/>
    <div class="container">
        <span><a href="{{route('home')}}" >Home</a> / Testimonials</span>
    <h1>Testimonials</h1>
    </div>
</div>


<div class="page-banne-text">
    <div class="container">
        <div class="row">
            @if(count($testimonials)>0)
            @foreach($testimonials as $testimonial)
            <div class="col-md-6 col-sm-12">
                <div class="testimonial-item">
                    <div class="testimonial-dec">
                        <div class="tst-top">
                          <img src="{{asset('public/assets/images/quotes.png')}}"/>
                          <span>
                                @for($i=0;$i<$testimonial->rating; $i++)
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                @endfor
                            </span>
                        </div>
                        <p>{!! $testimonial->description !!}</p>
                    </div>
                    <div class="user">
                        <div class="user-pic">
                            <img src="{{asset('storage/app/public/'.$testimonial->image) }}">
                        </div>
                        <div class="user-dtls">
                            <label>{{$testimonial->client_name}}</label>
                           <span>{{$testimonial->designation}}</span>
                  
                        </div>
                    </div>
                </div>
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