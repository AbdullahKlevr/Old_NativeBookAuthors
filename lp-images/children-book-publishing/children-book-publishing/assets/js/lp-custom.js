$(document).ready(function() {

    $('.countrylist').change(function () {
        var thisval = $(this).children('option:selected').val();
        var thiscode = $(this).children('option:selected').attr('data-abbr');
        $(this).closest('.newcountrycode ').find('.countrycode').attr("value", "+" + thisval);
    
        if (thiscode == 'CA') {
            $(this).siblings('span').removeClass();
            $(this).siblings('span').addClass('fgca');
        } else {
            $(this).siblings('span').removeClass();
            $(this).siblings('span').addClass('fg' + thisval);
        }
    });
    switchDiv();

    $("li:first-child").addClass("first");
    $("li:last-child").addClass("last");

    $('[href="#"]').attr("href", "javascript:;");

    $(".menu-Bar").click(function() {
        $(this).toggleClass("open");
        $(".menuWrap").toggleClass("open");
        $("body").toggleClass("ovr-hiddn");
    });

    $(".loginUp").click(function() {
        $(".LoginPopup").fadeIn();
        $(".overlay").fadeIn();
    });

    $(".signUp").click(function() {
        $(".signUpPop").fadeIn();
        $(".overlay").fadeIn();
    });

    $(".closePop,.overlay").click(function() {
        $(".popupMain").fadeOut();
        $(".overlay").fadeOut();
    });

    $(".menu .menu-item-has-children").addClass("dropdown-nav ");
    $(".menu .menu-item-has-children ul.sub-menu").addClass("dropdown");

    /* Tabbing Function */
    $("[data-targetit]").on("click", function(e) {
        $(this).addClass("active");
        $(this)
            .siblings()
            .removeClass("active");
        var target = $(this).data("targetit");
        $("." + target)
            .siblings('[class^="box-"]')
            .hide();
        $("." + target).fadeIn();
        $(".tabViewList").slick("setPosition", 0);
    });

    // Accordian
    $(".accordian h4").click(function() {
        $(".accordian li").removeClass("active");
        $(this)
            .parent("li")
            .addClass("active");
        $(".accordian li div").slideUp();
        $(this)
            .parent("li")
            .find("div")
            .slideDown();
    });

    $("li.dropdown-nav").hover(function() {
        $(this)
            .children("ul")
            .stop(true, false, true)
            .slideToggle(300);
    });

    $(".searchBtn").click(function() {
        $(".searchWrap").addClass("active");
        $(".overlay").fadeIn("active");
        $(".searchWrap input").focus();
        $(".searchWrap input").focusout(function(e) {
            $(this)
                .parents()
                .removeClass("active");
            $(".overlay").fadeOut("active");
            $("body").removeClass("ovr-hiddn");
        });
    });

   

    //     Slider For
    // $('.slider-for').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     dots: false,
    //     arrows: false,
    //     fade: true,
    //     asNavFor: '.slider-nav'
    // });
    // $('.slider-nav').slick({
    //     slidesToShow: 4,
    //     slidesToScroll: 1,
    //     asNavFor: '.slider-for',
    //     dots: false,
    //     focusOnSelect: true
    // });

    /* Top Scroll */
    // $('body').on('click', '.scrolldown-fl', function() {
    //     goToScroll('awardSec');
    // });
});

// $(window).on("scroll touchmove", function() {
//     $("header").toggleClass("stickyOpen", $(document).scrollTop() > 200);
// });

$(window).on("load", function() {
    var currentUrl = window.location.href.substr(
        window.location.href.lastIndexOf("/") + 1
    );
    $("ul.menu li a").each(function() {
        var hrefVal = $(this).attr("href");
        if (hrefVal == currentUrl) {
            $(this).removeClass("active");
            $(this)
                .closest("li")
                .addClass("active");
            $("ul.menu li.first").removeClass("active");
        }
    });
});

/* RESPONSIVE JS */
if ($(window).width() < 824) {}

function switchDiv() {
    var $window = $(window).outerWidth();
    if ($window <= 768) {
        $(".topAppendTxt").each(function() {
            var getdtd = $(this)
                .find(".cloneDiv")
                .clone(true);
            $(this)
                .find(".cloneDiv")
                .remove();
            $(this).append(getdtd);
        });
    }
}

function goToScroll(e) {
    $("html, body").animate({
            scrollTop: $("." + e).offset().top
        },
        1000
    );
}
$(window).on("load", function (e) {
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "");
    }

    if($('.goto').length > 0){
        if ($(window).scrollTop() >= $(".goto").offset().top - $(window).height()) {
           
            if (!$(".goto").hasClass("animated")) {
                $(".count").each(function () {
                    $(this)
                        .prop("Counter", 0)
                        .animate(
                            {
                                Counter: $(this).text(),
                            },
                            {
                                duration: 4000,
                                easing: "swing",
                                step: function (now) {
                                    $(this).text(numberWithCommas(Math.ceil(now)));
                                },
                            }
                        );
                });
                // $("#triggered").addClass("show");
                $(".goto").addClass("animated");
            }
        }
    }
   
    
});

$(document).ready(function(){
    $('.popdynamic').click(function(){
        $('.centercont.static').addClass('d-none');
        $('.centercont.dynamic').removeClass('d-none');
        $('.overlay').fadeIn();
        $('#popdynamic').fadeIn();
        $('.LoginPopup').addClass('price-margin');
        
        var packtitle = $(this).closest('.pckg').find(" .title").html();
        var packprice = $(this).closest('.pckg').find(".price .amount").html();
        
        
      
        var thisrel = $(this).attr('rel');
        $('input[name="pkg_key"]').val(thisrel);
        $('#popupform input#popuppackage').val(thisrel);
         $(".centercont.dynamic h3 span").html(packtitle);
        // $(".centercont h4").html("In Just <span>" + packprice + "</span>");
    });
    
    
    
    $('.popbtn2').click(function(){
        $('.centercont.static').addClass('d-none');
        $('.centercont.dynamic').removeClass('d-none');
        $('.overlay').fadeIn();
        $('#popdynamic').fadeIn();
        $('.LoginPopup').addClass('price-margin');
        var packtitle = $(this).closest('.pckg2').find(".label").html();
        var packprice = $(this).closest('.pckg2').find(".price").html();
        var thisrel = $(this).attr('rel');
        $('input[name="pkg_key"]').val(thisrel);
        $('#popupform input#popuppackage').val(thisrel);
         $(".centercont.dynamic h3 span").html(packtitle);
        $(".centercont h4").html("In Just <span>" + packprice + "</span>");
    });
	
     $('.closeico,.overlay').click(function(){
        
        $('.popupmain').fadeOut();
        $('.overlay').fadeOut();
       
        
    });
	
	$('.popstatic').click(function(){
	    $('.centercont.static').removeClass('d-none');
        $('.centercont.dynamic').addClass('d-none');
        $('#popstatic').fadeIn();
        $('.overlay').fadeIn();
        

        var orgtexts = '$99';
        //  $(".centercont h3 span").text('Start your Trademark Registration Now');
      $(".centercont h4").html("in Just <span>" + orgtexts + "</span>");
    });

    $(window).scroll(function(){
        var header = $('header'),
            scroll = $(window).scrollTop();
      
        if (scroll >= 1){
             header.addClass('sticky');
        }
        if (scroll <= 0){
            header.removeClass('sticky');
       }
        
      });
    //   const main = () => {
    //     const second = 1000
    //     const minute = second * 60
    //     const hour = minute * 60
    //     const day = hour * 24
            
    //     //INSERT EVENT DATE AND TIME HERE IN THIS FORMAT: 'June 1, 2023, 19:00:00'
    //     const EVENTDATE = new Date('May 1, 2024, 19:00:00');
       
    //     const countDown = new Date(EVENTDATE).getTime();
    //     const x = setInterval(() => {
             
    //           const now = new Date().getTime();
                 
    //           const distance = countDown - now
      
    //           document.getElementById("days").innerText = Math.floor(distance / day)
    //           document.getElementById("hours").innerText = Math.floor((distance % day) / (hour))
    //           document.getElementById("minutes").innerText = Math.floor((distance % hour) / (minute))
      
    //         //delay in milliseconds
    //         }, 0)
    //     }
      
    //   main();

function countdown(element, minutes, seconds) {
    // set time for the particular countdown
    var time = minutes*60 + seconds;
    var interval = setInterval(function() {
        var el = document.getElementById(element);
        // if the time is 0 then end the counter
        if (time <= 0) {
            var text = "hello";
            el.innerHTML = text;
            setTimeout(function() {
                countdown('clock', 0, 5);
            }, 2000);
            clearInterval(interval);
            return;
        }
            $("#hours").html("00");
        var minutes = Math.floor( time / 60 );
     
        
        if (minutes < 10) minutes = "0" + minutes;
        var seconds = time % 60;
        if (seconds < 10) seconds = "0" + seconds; 
         $("#minutes").html(minutes);
          $("#seconds").html(seconds);
 
      
        time--;
    }, 1000);
}
countdown('countdown', 59, 59);

      $('.accordion-list > li:not(.active) > .answer').hide();

    $('.accordion-list > li').click(function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active").find(".answer").slideUp();
        } else {
            $(".accordion-list > li.active .answer").slideUp();
            $(".accordion-list > li.active").removeClass("active");
            $(this).addClass("active").find(".answer").slideDown();
        }
        return false;
    });
});