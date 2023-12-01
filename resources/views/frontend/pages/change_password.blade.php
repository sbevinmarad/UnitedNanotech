@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')

<!-- Page Banner Start -->
<section class="page-banner text-white py-190 rpy-130" @if(isset($banner) && isset($banner->banner)) style="background-image: url('{{asset('storage/app/public/'.$banner->banner)}}')" @else style="background-image: url({{asset('public/assets/images/banner.jpg')}});" @endif>
    <div class="container">
        <div class="banner-inner">
            <h1 class="page-title wow fadeInRight delay-0-2s">My Profile</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center wow fadeInLeft delay-0-2s">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">My Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Page Banner End -->


<!--My Profile-->
<div class="my_rofile">
    <div class="container">                    
        <form method="post" action="{{route('user.change.password.save')}}">
        @csrf                                
        <div class="row clearfix">
            
            <div class="col-lg-12 col-md-12 col-sm-12">
                
                    <div class="row clearfix">
                        
                        <!--Form Group-->
                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                            <div class="field-label">Old Password <sup>*</sup></div>
                            <input type="password" name="old_password" value="" required>
                            @error('old_password') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <!--Form Group-->
                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                            <div class="field-label">New Password <sup>*</sup></div>
                            <input type="password" name="password" value="" required>
                            @error('password') <div class="error">{{ $message }}</div> @enderror
                        </div>
                        
                        <!--Form Group-->
                        <div class="form-group col-md-4 col-sm-6 col-xs-12">
                            <div class="field-label">Confirm Password <sup>*</sup></div>
                            <input type="password" name="password_confirmation" value="" required>
                            @error('password_confirmation') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        </div>
                    <div class="row align-items-center justify-content-center clearfix mt-25">
                        <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">Submit Now <i class="far fa-long-arrow-right"></i></span></button>
                    </div>                            
            </div>
        </div> 
                </form>                                  
    </div>
</div>
<!--My Profile End-->

@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection