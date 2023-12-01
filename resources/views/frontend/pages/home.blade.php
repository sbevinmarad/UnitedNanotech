@extends('frontend.layouts.app')
@section('css')

@endsection

@section('content')
<div class="banner">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="3000">
        <div class="carousel-inner">
            @if(count($sliders)>0)
            @foreach($sliders as $key=>$slider)
          <div class="carousel-item @if($key == 0) active @endif">
            <img class="d-block w-100" src="{{asset('storage/app/public/'.$slider->image) }}" alt="First slide">
          </div>
          @endforeach
        @endif
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <div class="what-we-do">
      <div class="container">
        <div class="heading">
          <label>WHAT WE DO <span></span><small></small></label>
          <h2>Speciality Chemicals Manufacturer</h2>
        </div>
        <div class="row">
        @if(count($categories)>0)
        @foreach($categories as $category)
          <div class="col-md-6 col-sm-12">
            <div class="what-do-item">
              <div class="what-do-item-img">
                 <img src="{{asset('storage/app/public/'.$category->image) }}"/>
              </div>
              <div class="what-do-item-text">
                <h3>{!! $category->name !!}</h3>
                <p>{!! $category->description !!}</p>
                 <a href="{{route('products',['category' => $category->slug])}}">Read More</a>
              </div>
            </div>
          </div>
          @endforeach
            @endif
        </div>

      </div>
      </div>
      <div class="about">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-sm-12">
               <div class="about-img">
                <div class="about-img-big">
                 <img src="{{asset('storage/app/public/'.$aboutUs->image_1) }}"/>
                </div>
                <div class="about-img-small">
                  <img src="{{asset('storage/app/public/'.$aboutUs->image_2) }}"/>
                </div>
               </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="about-txt">
                <div class="heading">
                  <label>KNOW ABOUT OUR United  <span></span><small></small></label>
                  <h2>United Nanotech Products 
                    Limited (UNTPL)</h2>
                </div>
                {!! $aboutUs->description !!}
                 <a href="{{route('visionStatement')}}" class="cmn-btn">Discover More</a>
              </div>
           </div>
          </div>
        </div>
      </div>
      <div class="product">
        <div class="container">
          <div class="heading">
            <label>Product<span></span><small></small></label>
            <h2>Our Products</h2>
          </div>
          <div class="row">
            @if(count($products)>0)
            @foreach($products as $product)
             <div class="col-md-4 col-sm-6">
              <div class="product-item">
                 <img src="{{asset('storage/app/public/'.$product->image) }}"/>
                 <div class="product-item-content">
                  <h4  onclick="window.location.href='{{route('productDetails', [$product->slug])}}';">{!! $product->name !!}</h4>
                  <a href="javascript:void(0);" onclick="enquiryModalBtn('{{$product->id}}');">Send Inquiry</a>
                 </div>
              </div>
             </div>
             @endforeach
            @endif
          </div>
        </div>
        </div>
        <div class="gallery">
        <div class="container">
          <div class="heading">
            <label>Gallery<span></span><small></small></label>
            <h2>Our Gallery</h2>
          </div>
          <div class="row">
            @if(count($galleries)>0)
            @foreach($galleries as $gallery)
            <div class="col-md-4 col-sm-6">
              <div class="gallery-item">
                <a href="{{asset('storage/app/public/'.$gallery->image) }}" data-fancybox="preview">
                <img src="{{asset('storage/app/public/'.$gallery->image) }}"/>
                </a>
              </div>
            </div>
            @endforeach
            @endif
          </div>
        </div>
        

        </div>
        <div class="testimonial">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="tst-left">
                  <div class="heading">
                    <label>OUR TESTIMONIALS<span></span><small></small></label>
                    <h2>What Our Client Say 
                      About Us</h2>
                  </div>
                  <p>Our clients consistently praise United NanoTech Products Limited for its cutting-edge innovations and exceptional product quality. Their testimonials reflect unwavering satisfaction with the groundbreaking solutions offered by the company.</p>
                    <a href="javascript:void(0);" class="cmn-btn">All Testimonials</a>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="tst-right">
                  <div class="owl-carousel owl-theme" id="testimonial">
                    @if(count($testimonials)>0)
                    @foreach($testimonials as $testimonial)
                    <div class="item">
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
            </div>

          </div>
        </div>
@endsection

@section('script')

<script type="text/javascript">
   

</script>
@endsection