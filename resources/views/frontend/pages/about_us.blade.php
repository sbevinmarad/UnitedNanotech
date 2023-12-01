@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<!-- BEGIN: Page Banner Section -->
<section class="pageBannerSection" @if(isset($banner) && isset($banner->banner)) style="background-image: url('{{asset('storage/app/public/'.$banner->banner)}}')" @else style="background-image: url({{asset('public/assets/images/inner_header.jpg')}});" @endif>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pageBannerContent text-center">
                    <h2>About Us</h2>
                    <div class="pageBannerPath">
                        <a href="{{route('home')}}">Home</a>&nbsp;&nbsp; / &nbsp;&nbsp;<span>About</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Page Banner Section -->

<!-- BEGIN: About Section -->
        <section class="aboutPageSection01">
            <div class="container">
                <div class="aboutPageSection_inner">
                    <div class="row">

                        <div class="col-xl-6">
                            <div class="aboutContent">
                                
                                {!! $aboutUs->content_1 !!}
                                

                            </div>
                        </div>


                        <div class="col-xl-6">
                            <div class="aboutImage">
                                <img src="{{asset('storage/app/public/'.$aboutUs->image_1) }}" alt="about">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- END: About Section -->


        <!-- BEGIN: About Section -->
        <section class="aboutSection2">



            <div class="about_box">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="about_img"><img src="{{asset('storage/app/public/'.$aboutUs->image_3) }}" alt="about"></div>
        
                        </div>
                        <div class="col-xl-6">
                            <div class="title-area mb-15">
                                <h2 class="sec-title">Our Vission</h2>
                            </div>
                            <p class="mt-n2 mb-35">
                                {!! $aboutUs->content_3 !!}
                            </p>                        
                        </div>
                    </div>
                </div>
            </div>


            <div class="about_box aboutbg">
                <div class="container">
                    <div class="row">

                        <div class="col-xl-6">
                            <div class="title-area mb-15">
                                <h2 class="sec-title">Our Mission</h2>
                            </div>
                            <p class="mt-n2 mb-35">
                               {!! $aboutUs->content_2 !!}
                            </p>                        
                        </div>

                        <div class="col-xl-6">
                            <div class="about_img"><img src="{{asset('storage/app/public/'.$aboutUs->image_2) }}" alt="about"></div>        
                        </div>

                    </div>
                </div>
            </div>


            <div class="about_box">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="about_img"><img src="{{asset('storage/app/public/'.$aboutUs->image_4) }}" alt="about"></div>
        
                        </div>
                        <div class="col-xl-6">
                            <div class="title-area mb-15">
                                <h2 class="sec-title">Key Impact </h2>
                            </div>
                            <p class="mt-n2 mb-35">
                                {!! $aboutUs->content_4 !!}
                            </p>                        
                        </div>
                    </div>
                </div>
            </div>


        </section>
        <!-- END: About Section -->

        <!-- feature-area-start -->
        <section class="feature-area mainfeature__bg">
            <div class="container">
            <div class="mainfeature__border pb-15">
                <div class="row row-cols-lg-5 row-cols-md-3 row-cols-2">
                    <div class="col">
                        <div class="mainfeature__item text-center mb-30">
                        <div class="mainfeature__icon">
                            <img src="{{asset('public/assets/images/feature-icon-1.svg')}}" alt="">
                        </div>
                        <div class="mainfeature__content">
                            <h4 class="mainfeature__title">Fast Delivery</h4>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mainfeature__item text-center mb-30">
                        <div class="mainfeature__icon">
                            <img src="{{asset('public/assets/images/feature-icon-2.svg')}}" alt="">
                        </div>
                        <div class="mainfeature__content">
                            <h4 class="mainfeature__title">safe payment</h4>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mainfeature__item text-center mb-30">
                        <div class="mainfeature__icon">
                            <img src="{{asset('public/assets/images/feature-icon-3.svg')}}" alt="">
                        </div>
                        <div class="mainfeature__content">
                            <h4 class="mainfeature__title">Help Center</h4>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mainfeature__item text-center mb-30">
                        <div class="mainfeature__icon">
                            <img src="{{asset('public/assets/images/feature-icon-4.svg')}}" alt="">
                        </div>
                        <div class="mainfeature__content">
                            <h4 class="mainfeature__title">Online Discount</h4>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mainfeature__item text-center mb-30">
                        <div class="mainfeature__icon">
                            <img src="{{asset('public/assets/images/feature-icon-5.svg')}}" alt="">
                        </div>
                        <div class="mainfeature__content">
                            <h4 class="mainfeature__title">ASSURED QUALITY</h4>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- feature-area-end -->

        <!-- BEGIN: Blogs Section -->
        <section class="Popular-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secTitle">Our Blogs</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="categoryCarousel11 owl-carousel">

                            @if(count($blogs)>0)
                            @foreach($blogs as $blog)
                            <!-- blog  Slider-->
                            <div class="blogItem04">
                                <div class="bi04Thumb">
                                    <img src="{{asset('storage/app/public/'.$blog->image) }}" alt="Blog Image">
                                </div>
                                <div class="bi04Detail">
                                    <div class="bi01Meta clearfix">
                                        <span><i><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="16" viewBox="0 0 15 16">
                                            <defs>
                                              <pattern id="pattern" preserveAspectRatio="none" width="100%" height="100%" viewBox="0 0 135 136">
                                                <image width="135" height="136" xlink:href="data:image/png;base64,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"/>
                                              </pattern>
                                            </defs>
                                            <rect id="_222" data-name="222" width="15" height="16" fill="url(#pattern)"/>
                                          </svg>
                                          </i><a href="javascript:void(0)">ZadeKart</a></span>
                                        <span><i class="fal fa-clock"></i><a href="{{route('blogDetails', $blog->slug)}}">{{ $blog->created_at->format('M d, Y') }}</a></span>
                                    </div>
                                    <h2><a href="{{route('blogDetails', $blog->slug)}}">{{$blog->title}}</a></h2>
                                    <div class="bi04Footer">
                                        <a href="{{route('blogDetails', $blog->slug)}}" class="ulinaBTN"><span>Read More</span></a>
                                    </div>
                                </div>
                            </div>
                            <!-- blog  Slider-->
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END: Blogs Section -->

@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection