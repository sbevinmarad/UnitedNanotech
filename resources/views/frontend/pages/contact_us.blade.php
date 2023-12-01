@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<div class="page-banne">
    <img @if(isset($banner) && isset($banner->banner)) src="{{asset('storage/app/public/'.$banner->banner)}}" @else src="{{asset('public/assets/images/pagebanner.png')}}" @endif/>
    <div class="container">
        <span><a href="{{route('home')}}" >Home</a> / Contact Us</span>
    <h1>Contact Us</h1>
    </div>
</div>


<div class="page-banne-text product-details">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <div class="contact-info">
                    <!-- <span><img src="{{asset('public/assets/images/tag.png')}}"/> ANIMAL NUTRITION</span> -->
                    <h3>United Nanotech Products Limited</h3>
                    <div class="contact-item">
                        <h4>Office:</h4>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$siteSetting->address}}</p>
                        <p><a href="tel:{{$siteSetting->phone}}"><i class="fa fa-phone" aria-hidden="true"></i> {{$siteSetting->phone}}</a></p>
                        <p><a href="tel:+{{$siteSetting->phone_2}}"><i class="fa fa-fax" aria-hidden="true"></i> +{{$siteSetting->phone_2}}</a></p>
                        <h4>Factory:</h4>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$siteSetting->address_2}}</p>
                        <h4>Marketing Executive:</h4>
                        <p><i class="fa fa-user" aria-hidden="true"></i> Mr. Avijit Mondal</p>
                        <p><i class="fa fa-phone" aria-hidden="true"></i> +91 8910823707 </p>
                        <p><i class="fa fa-envelope" aria-hidden="true"></i> avijituntpl@gmail.com </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <form class="contact-frm" action="{{route('contact.us.form.submit')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <input type="text" placeholder="Your Name" name="name" required="" value="{{old('name')}}"/>
                            @error('name') <div class="error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <input type="text" placeholder="Your Email" name="email" required="" value="{{old('email')}}"/>
                            @error('email') <div class="error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <input type="text" placeholder="Your Phone" name="phone" required="" value="{{old('phone')}}"  onkeypress="return number_check(this,event);"/>
                            @error('phone') <div class="error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group" >
                            <textarea placeholder="Your Message" required name="message">{{old('message')}}</textarea>
                            @error('message') <div class="error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group" >
                            <script src="https://www.google.com/recaptcha/api.js" 
                            async defer></script>
                            <div class="g-recaptcha" id="feedback-recaptcha" 
                                 data-sitekey="{{$siteSetting->google_recaptcha_key}}">
                            </div>
                            @error('g-recaptcha-response') <div class="error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <button type="submit" class="cmn-btn">Send Your Message</button>
                    </div>

                </div>
            </form>
            </div>
        </div>

    </div>
</div>

<div class="map">
    <iframe src="{{$siteSetting->map}}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection