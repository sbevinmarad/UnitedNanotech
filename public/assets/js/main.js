$('#testimonial').owlCarousel({
    loop:true,
    margin:10,
    autoplay:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:false
        },
        800:{
            items:1,
            nav:false
        },
        1000:{
            items:1,
            nav:true,
            loop:false
        }
    }
});

// tab

// Show the first tab and hide the rest
$('#tabs-nav li:first-child').addClass('active');
$('.tab-content').hide();
$('.tab-content:first').show();

// Click function
$('#tabs-nav li').click(function(){
  $('#tabs-nav li').removeClass('active');
  $(this).addClass('active');
  $('.tab-content').hide();
  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn();
  return false;
});

// menu collaps

$(".menu-btn").click(function(){
    $(".site-menu").slideToggle();
  });

  // toggle class
  $(".search").click(function(){
    $(".searchbox").toggleClass("active");
  });
  
    // toggle class
    
      // produtc slider
      $(function() { 
        // Card's slider
          var $carousel = $('.slider-for');
        
          $carousel
            .slick({
              slidesToShow: 1,
              slidesToScroll: 1,
              arrows: false,
              fade: true,
              adaptiveHeight: true,
              asNavFor: '.slider-nav'
            })
            
          $('.slider-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            variableWidth: true,
            responsive: [
              {
                breakpoint: 991,
                settings: {
                  slidesToShow: 4,
                }
              },
              {
                breakpoint: 767,
                settings: {
                  slidesToShow: 3,
                }
              },
              {
                breakpoint: 400,
                settings: {
                  slidesToShow: 2,
                }
              },
            ]
          });
        });