  
  // fixed navbar
$(document).ready(function(){
   
        $(document).on('scroll', function() {
            var scrollPos = $(this).scrollTop();
    
            if( scrollPos > 10 ) {
                $("._header_sec").addClass("_header_sec_fixed");
            }
    
            else {
                $("._header_sec").removeClass("_header_sec_fixed");
            }
        });
});
// fixed navber end

// Side Menu
$(document).ready(function(){
    $("._sidemenu_button").click(function(){
        $("._mobile_sidemenu").addClass("_mobile_sidemenu_open");
    })
    $("._menu_close, ._sidemenu_overlay").click(function(){
        $("._mobile_sidemenu").removeClass("_mobile_sidemenu_open");
    })
});


// Mobile Menu
$(document).ready(function(){
    $("._mobile_button").click(function(){
        $("._mobile_menu").addClass("_mobile_menu_open");
    })
    $("._menu_close, .overlay_div").click(function(){
        $("._mobile_menu").removeClass("_mobile_menu_open");
    })
});



$(document).ready(function(){
     $('._banner_slider_active').owlCarousel({
        loop:true,
        nav: false,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        // navText:['<i class="fas fa-long-arrow-alt-left"></i>', '<i class="fas fa-long-arrow-alt-right"></i>'],
        responsiveClass:true,
        autoplay: true,
        autoplayTimeout: 7000,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,
            },
            1000:{
                items:1,
            }
        }
    });

     $('._card_slider_active').owlCarousel({
        loop:true,
        nav: false,
        
        dotsEach: false,
        // animateIn: 'fadeIn',
        // animateOut: 'fadeOut',
        // navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsiveClass:true,
        // autoplay: true,
        autoplayTimeout: 7000,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:3,
            }
        }
    });

     $('.sponsar_all').owlCarousel({
        loop:true,
        nav: true,
         dotsEach: true,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
         navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsiveClass:true,
        autoplay: true,
        autoplayTimeout: 7000,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:7,
            }
        }
    });
});

// menu language
$("._lng_drop_down").click(function(){
    $("._lng_drop_down_ul").toggleClass("_lng_drop_down_ul_none");
  })

//SOOMTH SCROLLING 
$("#crse_rivew").click(function() {
    $('html, body').animate({
        scrollTop: $("#rivew_all").offset().top
    }, 1000);
})

//count down
jQuery(document).ready(function($) {
    $(".counter").counterUp({
        delay: 10,
        time: 1000
    });
});

 //fixed teacher
function scrollCon() {
    var windowWidth =  $(window).width();

    if(windowWidth > 767) {
        var scrollPos = $(this).scrollTop();
    
        if( scrollPos > 450 ) {
            $(".course_top_info").addClass("course_top_info_fixed");
        }

        else {
            $(".course_top_info").removeClass("course_top_info_fixed");
        }
    }
}

$(document).on('scroll', function() {
    scrollCon();
});

//
   
$(document).ready(function(){
        // // search open
        $(".search_btn").on("click", function(event) {
            $("#search").addClass("open");
            $("#search > form > input[type='search']").focus();
        });

        $("#search button.close").on("click keyup", function(event) {
            event.preventDefault();
            if (event.target == this || event.target.className == "close" || event.keyCode == 27) {
                $("#search").removeClass("open");
            }
        });
});




$(".icon_click").click(function() {
    $(".mobile_menu_dropdown").addClass("active");
    $("html").addClass("modal-open");
    $(".all_toggles").addClass("active");
    $(".icon_click").addClass("active");
    $(".icon_rmv").addClass("active");
});

$(".icon_rmv, .all_toggles").click(function() {
    $(".mobile_menu_dropdown").removeClass("active");
    $("html").removeClass("modal-open");
    $(".all_toggles").removeClass("active");
    $(".icon_rmv").removeClass("active");
    $(".icon_click").removeClass("active");
});
// Mobile Menu iteam select
$(document).ready(function(){

  $(".mbl_select_iteam_in").click(function(){
    $(this).toggleClass("pm").siblings().slideToggle(300);
  })


});

// Mobile search
$(".icon_one").click(function() {
    $(".mobile_menu_btm").addClass("active");
    $(".icon_one").addClass("active");
      $("html").addClass("modal-open");
      $(".all_toggles").addClass("active");
    $(".icon_two").addClass("active");
});

$(".icon_two, .all_toggles").click(function() {
    $(".mobile_menu_btm").removeClass("active");
     $(".icon_two").removeClass("active");
       $("html").removeClass("modal-open");
     $(".all_toggles").removeClass("active");
    $(".icon_one").removeClass("active");
});

// reply box
  
     $(".post_reply").click(function(){
        $(this).siblings(".new_cmnt_form").show(300);
      });
      $(".close_reply").click(function() {
        $(this).parent(".new_cmnt_form").hide(300);
      });
       