@extends('frontend.layouts.app')
@section('css')
@endsection

@section('content')
<div class="page-banne">
    <img @if(isset($banner) && isset($banner->banner)) src="{{asset('storage/app/public/'.$banner->banner)}}" @else src="{{asset('public/assets/images/pagebanner.png')}}" @endif/>
    <div class="container">
        <span><a href="{{route('home')}}" >Home</a> / Career</span>
    <h1>Career</h1>
    </div>
</div>


<div class="page-banne-text">
  <div class="container">
       <div class="cms-item">
         <h2>Career</h2>
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
        <h2>Global Reach and Scope</h2>
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
        <h2>Collaboration and Partnership</h2>
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
        <h2>Nanotech Expertise</h2>
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
        <h2>Products and Innovation</h2>
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
        <h2>Limited</h2>
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
        <h2>Memorability and Branding</h2>
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
        <h2>Expansion and Future Growth</h2>
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
      
        <div class="cms-item-boby">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              {!! $cms->description !!}
            </div>
           
          </div>
        </div>
      </div>
      <div class="carrer-form">
        <form method="post" action="{{route('user.carrer.submit')}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <input type="text" placeholder="Name" name="name" required="" />
                @error('name') <div class="error">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <input type="text" placeholder="Email" name="email" required=""/>
                @error('email') <div class="error">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <input type="text" placeholder="Phone" name="phone" required=""/>
                @error('phone') <div class="error">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <span>Upload CV</span>
                <input type="file" placeholder="Phone" name="document" required=""/>
                <small>Upload Format - Pdf/Word</small>
                @error('document') <div class="error">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <input type="text" placeholder="Position Applied For" name="applied_for" required=""/>
                @error('applied_for') <div class="error">{{ $message }}</div> @enderror
              </div>
            </div>

             <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <textarea  placeholder="Cover letter" name="cover_letter" required=""></textarea>
                @error('cover_letter') <div class="error">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <script src="https://www.google.com/recaptcha/api.js" 
                  async defer></script>
                  <div class="g-recaptcha" id="feedback-recaptcha" 
                       data-sitekey="{{$siteSetting->google_recaptcha_key}}">
                  </div>
                  @error('g-recaptcha-response') <div class="error">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <button type="submit" class="cmn-btn">Submit</button>
              </div>
            </div>
          </div>
        </form>
      </div>
  </div>
 </div>
@endsection

@section('script')
<script type="text/javascript">
    

    
</script>
@endsection