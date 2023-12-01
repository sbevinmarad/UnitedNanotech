<footer>
          <div class="container">
             <div class="row">
              <div class="col-md-4 col-sm-12">
                 <div class="footer-details">
                  <h2>Company</h2>
                  <ul>
                    <li>
                      <a href="{{route('home')}}">Home</a>
                    </li>
                    <li>
                      <a href="{{route('products')}}">Products</a>
                    </li>
                    <li>
                      <a href="{{route('gallery')}}">Gallery</a>
                    </li>
                    <li>
                      <a href="{{route('testimonials')}}">Testimonial</a>
                    </li>
                    <!-- <li>
                      <a href="{{route('term.and.condition')}}">Terms & Condition</a>
                    </li> -->
                    <!-- <li>
                      <a href="{{route('home')}}">About Us</a>
                    </li> -->
                    <li>
                      <a href="{{route('investors')}}">Investor</a>
                    </li>
                    <li>
                      <a href="{{route('carrer')}}">Career</a>
                    </li>
                    <li>
                      <a href="{{route('contact.us')}}">Contact Us</a>
                    </li>
                  </ul>
                 </div>
              </div>
              <div class="col-md-4 col-sm-12">
                <div class="footer-details">
                  <h2>Social Media</h2>

                    <div class="social">
                     
                    @if(count($socialLinks)>0)
                    @foreach($socialLinks as $link)
                        <a href="{{$link->link}}" target="_blank"><img src="{{asset('storage/app/public/'.@$link->image) }}"/></a>
                    @endforeach
                    @endif
                    </div>
                  </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="footer-details">
                      <h2>Address</h2>
                      <p>{{$siteSetting->address}}</p>
                      <p><a href="tel:{{$siteSetting->phone}}">{{$siteSetting->phone}}</a></p>
                      <p><a href="mailto:{{$siteSetting->email}}">{{$siteSetting->email}}</a></p>
                      </div>
                      </div>
             </div>
             <div class="copyright">
              <p>&copy; Copyright {{ config('app.name', 'United Nanotech Products') }} {{date('Y')}}. All rights reeserved.</p>
              <a href="https://acuitysoftware.co/">Powered by: Acuity Software Services Pvt. Ltd.</a>
             </div>
          </div>
        </footer>