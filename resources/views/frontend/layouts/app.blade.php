<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.png')}}" />
      @yield('head_tag')
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css" />
      <link href="{{asset('public/admin_assets/vendors/general/toastr/build/toastr.min.css')}}" rel="stylesheet" type="text/css" />
      <!-- Bootstrap CSS -->
      
     


      <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap/dist/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{asset('public/assets/css/font-awesome/css/font-awesome.css')}}"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="{{asset('public/assets/css/main.css')}}">

      <title>@if(isset($seo->title)){{$seo->title}} @else {{@$title}}@endif</title>
      <meta name="description" content="@if(isset($seo->description)){{$seo->description}} @else {{@$description}}@endif" />
      <meta name="keywords" content="@if(isset($seo->keywords)){{$seo->keywords}} @else {{@$keywords}}@endif" />
      
   </head>
   <body>
    <style type="text/css">
        .error{
          color: red !important;
        }
        .is-invalid{
              color: red;
              font-size: 14px;
              /*position: absolute;*/
              /* top: 0; */
              bottom: -23px;
              right: 0;
              font-weight: 500;
        }
        .toast-error {
          background-color: #bd362f;
        }
        .toast-success {
          background-color: #51a351;
        }
      </style>
      @livewireStyles
      @yield('css')
         
          @include('frontend.includes.header')
          @yield('content')
          @include('frontend.includes.footer')
          @livewireScripts

         

        <div class="wa_btn">
            <a href="https://api.whatsapp.com/send?phone={{$siteSetting->phone_2}}&text=Hello&type=phone_number&app_absent=0" target="_blank">
            <div class="wa_btn_content">
                <svg id="Group_1303" data-name="Group 1303" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25">
                    <path id="Path_3544" data-name="Path 3544" d="M18.122,14.946c-.3-.156-1.819-.9-2.1-1s-.488-.156-.692.156-.792,1-.977,1.208-.36.232-.664.078A8.366,8.366,0,0,1,9.5,11.731c-.315-.544.315-.505.9-1.68a.568.568,0,0,0-.028-.538c-.078-.156-.692-1.669-.949-2.285-.248-.6-.505-.516-.692-.527S8.357,6.69,8.15,6.69a1.138,1.138,0,0,0-.82.382A3.46,3.46,0,0,0,6.253,9.639a6.034,6.034,0,0,0,1.253,3.184,13.744,13.744,0,0,0,5.257,4.646c1.953.843,2.718.915,3.694.77a3.142,3.142,0,0,0,2.073-1.465,2.614,2.614,0,0,0,.179-1.465C18.633,15.172,18.427,15.094,18.122,14.946Z" fill="#fff"/>
                    <path id="Path_3545" data-name="Path 3545" d="M24.029,7.656A12.483,12.483,0,0,0,12.5,0h-.056a12.506,12.506,0,0,0-11.1,18.136v4.241a1.283,1.283,0,0,0,1.283,1.284H6.867A12.54,12.54,0,0,0,12.444,25H12.5a12.455,12.455,0,0,0,8.8-3.613,12.545,12.545,0,0,0,2.723-13.73ZM19.813,19.877a10.325,10.325,0,0,1-7.313,3h-.048a10.416,10.416,0,0,1-4.83-1.214l-.234-.126H3.46V17.612l-.126-.234A10.407,10.407,0,0,1,5.123,5.187a10.3,10.3,0,0,1,7.333-3.066H12.5a10.384,10.384,0,0,1,7.31,17.757Z" fill="#fff"/>
                </svg>
            </div>
          </a>
        </div>
          <div class="modals"  id="enquiryModal">
            <div class="modal-body">
              <div class="modal-head">
                <h2>Get a Quick Quote</h2>
                <a href="javascript:void(0);" class="close-btn"><i class="fa fa-times" aria-hidden="true"></i></a>
              </div>
              <div class="row bodyrows">
                <div class="col-md-6 col-sm-12">
                 <div class="product-img" id="imageGallery">
                 </div>
                 <div class="product-dtl">
                  <p id="type"></p>
                  <p id="size"></p>
                 </div>
                
                </div>
                <div class="col-md-6 col-sm-12">
                  <form id="enquery_form">
                    <input type="hidden" name="product_id" id="product_id">
                  <div class="enq-frm">
                   <div class="form-grp">
                    <label>Name</label>
                    <input type="text" placeholder="" name="name" />
                    <div class="is-invalid name"></div>
                   </div>
                   <div class="form-grp">
                    <label>Email</label>
                    <input type="text" placeholder="" name="email" />
                    <div class="is-invalid email"></div>
                   </div>
                   <div class="form-grp">
                    <label>Phone No</label>
                    <input type="text" placeholder="" name="phone" onkeypress="return number_check(this,event);"/>
                    <div class="is-invalid phone"></div>
                   </div>
                   <div class="row">
                    <div class="col-md-6 col-sm-12">
                      <div class="form-grp">
                        <label>Quantity</label>
                        <input type="text" placeholder="" name="quantity" />
                        <div class="is-invalid quantity"></div>
                       </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                      <div class="form-grp">
                        <label>Kg</label>
                        <input type="text" placeholder="" name="unit" />
                        <div class="is-invalid unit"></div>
                       </div>
                    </div>
                   </div>
                   <div class="form-grp">
                    <label>Purpose of Requirement</label>
                      <div class="custom-rdo">
                        <div class="custom-rdos">
                          <input type="radio" id="test2" name="purpose" value="Reselling">
                           <label for="test2">Reselling</label>
                        </div>
                        <div class="custom-rdos">
                          <input type="radio" id="test2" name="purpose" value="End Use">
                           <label for="test2">End Use</label>
                        </div>
                        <div class="is-invalid purpose"></div>
                      </div>
                   </div>
                   <div class="form-grp">
                    <label>Requirement Details</label>
                      <textarea name="description"></textarea>
                      <div class="is-invalid description"></div>
                   </div>

                   <div class="form-grp mb-4">
                      <script src="https://www.google.com/recaptcha/api.js" 
                        async defer></script>
                        <div class="g-recaptcha" id="feedback-recaptcha" 
                             data-sitekey="{{$siteSetting->google_recaptcha_key}}">
                        </div>
                        <div class="is-invalid g-recaptcha-response"></div>
                   </div>
                   <button type="submit" class="cmn-btn">Send Enqury</button>
                 </div>
               </form>
                </div>
              </div>
            </div>
          </div>
   

    <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/assets/css/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/assets/js/owl.carousel.js')}}"></script>
    <script src="{{asset('public/assets/js/slick.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('public/assets/js/main.js')}}"></script>

        <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/trumbowyg.min.js'></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
      <script src="{{asset('public/admin_assets/vendors/general/toastr/build/toastr.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('public/admin_assets/app/custom/general/components/extended/toastr.js')}}" type="text/javascript"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

        <script src="{{asset('public/assets/js/jquery.isotope.min.js')}}"></script>
        <script src="{{asset('public/assets/js/slick.js')}}"></script>
        

      
      <script type="text/javascript">

     /*$(".send-enqs").click(function(){
        $(".modals").addClass("active");
      });*/
     function enquiryModalBtn(id) {
          var id = id;
          console.log(id);
          console.log('okk');
    $.ajax({
        type: "POST",
          url:"{{route('product.show')}}",
          data: {
              'product_id': id,
              '_token':'{{@csrf_token()}}'
          },
          dataType: "JSON",
          success: function(jsn) {
          console.log(jsn);
            if(jsn.code == 1){

                var html='';
                $('#product_id').val(jsn.product.id);
                $('#type').text('Packaging Type: '+jsn.product.packaging_type);
                $('#size').text('Packaging Size: '+jsn.product.packaging_size);
                var img = "{{asset('storage/app/public/')}}/"+jsn.product.image;
                html+='<img src="'+img+'" alt="product-img">';
                $('#imageGallery').last().html(html);
          console.log(html);
                $('.modals').addClass('active');

            }
            else{
                toastr["error"]('Something went wrong');
            } 
          }
        })
          
      }
      $(".close-btn").click(function(){
        $(".modals").removeClass("active");
      });

      $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('submit','#enquery_form', function(e) {
            e.preventDefault();
            var data = $(this).serializeArray();
            $('div.is-invalid').html('');
            $.ajax({
                url: "{{route('user.enquery_form.submit')}}",
                method: "post",
                data: data,
                dataType: "json",
                success: function (result) {
                    if(result.code == 0){
                        $.each(result.error, function( key, value ) {
                            $('div.'+key).html(value);
                        });
                    }
                    else if(result.code == 1){
                        location.reload();
                    }
                }
            });
        });

       
      });
      </script>
      @include('frontend.includes.script')
      @yield('script')
      <script src="{{asset('public/assets/js/theme.js')}}"></script>
   </body>
</html>