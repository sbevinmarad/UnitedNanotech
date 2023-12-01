@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')

<!-- Page Banner Start -->
<section class="page-banner text-white py-190 rpy-130" @if(isset($banner) && isset($banner->banner)) style="background-image: url('{{asset('storage/app/public/'.$banner->banner)}}')" @else style="background-image: url({{asset('public/assets/images/banner.jpg')}});" @endif>
    <div class="container">
        <div class="banner-inner">
            <h1 class="page-title wow fadeInRight delay-0-2s">Services</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center wow fadeInLeft delay-0-2s">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Services</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Page Banner End -->



<!-- services Area Start -->
<section class="services pt-120 rpt-90 pb-100 rpb-70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7">
                <div class="section-title text-center mb-50">
                    <h2 class="title">{!! $serviceCms->sub_title !!}</h2>
                    <p>{!! $serviceCms->description !!}</p>
                    <span class="sub-title">Feaurtes</span>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @if(count($services)>0)
            @foreach($services as $key=>$service)
            <div class="col-xl-4 col-md-6">
                <div class="service-two-item wow fadeInUp delay-0-2s">
                    <div class="image">
                        <img src="{{asset('storage/app/public/'.$service->image) }}" alt="Service">
                    </div>
                    <div class="heading">
                        <i class="flaticon-scissors"></i><h3>{{$service->name}}</h3>
                    </div>
                    <div class="hover-content">
                        <i class="flaticon-scissors"></i>
                        <h3><a href="#.html">{{$service->name}}</a></h3>
                        <p>{!! substr($service->description,0,80)."..."  !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            
        </div>
    </div>
</section>
<!-- services Area End -->

@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection