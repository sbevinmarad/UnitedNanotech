<a href="javascript:void(0);" class="sndenq">Send Enqury</a>
    <div class="header">
   
        <div class="top-header">
          <div class="container">
            <div class="logo">
              <a href="{{route('home')}}">
                <img src="{{asset('storage/app/public/'.@$siteSetting->logo) }}"/>
              </a>
            </div>
          <div class="top-left">
            @if(count($socialLinks)>0)
            @foreach($socialLinks as $link)
                <a href="{{$link->link}}" target="_blank"><i class="{{$link->icon}}" aria-hidden="true"></i></a>
            @endforeach
            @endif
          </div>
          <div class="top-right">
            <a href="tel:{{$siteSetting->phone}}"><i class="fa fa-phone" aria-hidden="true"></i>{{$siteSetting->phone}}</a>
            <a href="mailto:{{$siteSetting->email}}"><i class="fa fa-envelope" aria-hidden="true"></i>{{$siteSetting->email}}</a>
          </div>
          </div>
      </div>
      <nav>
        <div class="container">
          <div class="ul-logo">
            <a href="{{route('home')}}">
              <img src="{{asset('storage/app/public/'.@$siteSetting->logo) }}"/>
            </a>
          </div>
          <button type="button" class="menu-btn"><i class="fa fa-bars" aria-hidden="true"></i></button>
        <ul class="site-menu">
        
          <li>
            <a class="{{ Request::is('/') ? 'active' : '' }}" href="{{route('home')}}">Home</a>
          </li>
          <li>
            <a class="{{ Request::is('vision-statement') ? 'active' : '' }}{{ Request::is('mission-statement') ? 'active' : '' }}{{ Request::is('founder-message') ? 'active' : '' }}{{ Request::is('our-team') ? 'active' : '' }}{{ Request::is('our-clients') ? 'active' : '' }}{{ Request::is('our-presence') ? 'active' : '' }}" href="{{route('ourPresence')}}" href="javascript:void:(0);">About Us <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul>
              <li>
                <a class="{{ Request::is('vision-statement') ? 'active' : '' }}" href="{{route('visionStatement')}}">Vision Statement</a>
              </li>
              <li>
                <a class="{{ Request::is('mission-statement') ? 'active' : '' }}" href="{{route('missionStatement')}}">Mission Statement</a>
              </li>
              <li>
                <a class="{{ Request::is('founder-message') ? 'active' : '' }}" href="{{route('founderMessage')}}">Founder's Message</a>
              </li>
              <li>
                <a class="{{ Request::is('our-team') ? 'active' : '' }}" href="{{route('ourTeam')}}">Our Team</a>
              </li>
              <li>
                <a class="{{ Request::is('our-clients') ? 'active' : '' }}" href="{{route('ourClients')}}">Our Clients</a>
              </li>
              
              <li>
                <a class="{{ Request::is('our-presence') ? 'active' : '' }}" href="{{route('ourPresence')}}">Our Presence</a>
              </li>
            </ul>
          </li>
          <li>
            <a class="{{ Request::is('products') ? 'active' : '' }}" href="{{route('products')}}">Products</a>
          </li>
          <li>
            <a class="{{ Request::is('infrastructure') ? 'active' : '' }}" href="{{route('infrastructure')}}">Infrastructure</a>
          </li>
          <li>
              <a class="{{ Request::is('investors') ? 'active' : '' }}" href="{{route('investors')}}">Investor</a>
            </li>
          <li>
            <a class="{{ Request::is('gallery') ? 'active' : '' }}" href="{{route('gallery')}}">Gallery</a>
          </li>
          <li>
            <a class="{{ Request::is('career') ? 'active' : '' }}" href="{{route('carrer')}}">Career</a>
          </li>
          <li>
            <a class="{{ Request::is('testimonials') ? 'active' : '' }}" href="{{route('testimonials')}}">Testimonial</a>
          </li>
          <li>
            <a class="{{ Request::is('contact-us') ? 'active' : '' }}" href="{{route('contact.us')}}">Contact Us</a>
          </li>
         <!--  <li class="searchbox">
            <form action="{{route('products')}}">
            <input type="text" name="keyword"   placeholder="Search" value="{{Request::get('Request')}}"/>
            <a href="javascript:void:(0);" class="search" >
              <img src="{{asset('public/assets/images/search.png')}}"/>
            </a>
          </form>
          </li> -->
          <li>
            <a href="{{route('contact.us')}}" class="sendEnqury">Send Inquiry</a>
          </li>
        </ul>
        </div>
      </nav>
   
      
    </div>