$(function() {

    var a = window.location.pathname;

    var b = a.substring(a.lastIndexOf("/") + 1);

    $(".head_top ul li a").each(function() {

        var c = this.href.substring(this.href.lastIndexOf("/") + 1);

        if (b == c) {

            $(this).parent().addClass("active")

        }

    })

});

if ($(window).width() < 1180) {

    $(".dropdown-toggle11").click(function() {

        $(".dropdown-menu11").toggleClass("active_drop")

    })

}

if ($(window).width() < 1180) {

    $(".dropdown-toggle22").click(function() {

        $(".dropdown-menu22").toggleClass("active_drop")

    })

}

$(document).ready(function() {

    var b = "5XpThOAEkfgOvEJ";

    var c = $("meta[name=ip2loc]").attr("content");

    var a = $("meta[name=page_url]").attr("content");

    $.ajax({

        method: "get",

        url: "//pro.ip-api.com/json/" + c,

        data: {

            key: b

        },

        success: function(d) {

            if (d) {

                $("input[name=ip2loc_ip]").val(d.query);

                $("input[name=ip2loc_isp]").val(d.isp);

                $("input[name=ip2loc_org]").val(d.org);

                $("input[name=ip2loc_country]").val(d.country);

                $("input[name=ip2loc_region]").val(d.regionName);

                $("input[name=ip2loc_city]").val(d.city);

                $("input[name=pageurl]").val(a)

            }

        }

    })

});

$(".bnr-slider").slick({

    dots: true,

    arrows: false,

    fade: true,

    cssEase: "linear"

});

$(".feed-bck-slider").slick({

    dots: true,

    arrows: false,

    fade: true,

    cssEase: "linear"

});

$(".global-slider").slick({

    dots: false,

    arrows: false,

    infinite: true,

    autoplay: true,

    autoplaySpeed: 0,

    speed: 5000,

    pauseOnHover: false,

    cssEase: "linear",

    slidesToShow: 5,

    slidesToScroll: 1,

    responsive: [{

        breakpoint: 1024,

        settings: {

            slidesToShow: 4,

            arrows: false,

            slidesToScroll: 1,

            dots: false

        }

    }, {

        breakpoint: 600,

        settings: {

            slidesToShow: 3,

            slidesToScroll: 1

        }

    }, {

        breakpoint: 480,

        settings: {

            slidesToShow: 3,

            slidesToScroll: 1

        }

    }]

});

$(".quality-content").owlCarousel({

    loop: !0,

    margin: 30,

    nav: !0,

    dots: !1,

    autoplay: !0,

    autoplayTimeout: 4000,

    autoplayHoverPause: !0,

    responsive: {

        0: {

            items: 1

        },

        600: {

            items: 1

        },

        991: {

            items: 1

        },

        1024: {

            items: 1

        }

    }

});

$(document).ready(function() {

    $(".clickbutton").click(function() {

        $(".floatbutton").toggleClass("active");

        $(".crossplus").toggleClass("rotate")

    });

    $(".topformswitch").click(function() {

        $(".topformwrap").toggleClass("active")

    })

});

$(".services-slider").slick({

    dots: true,

    infinite: true,

    arrows: false,

    speed: 300,

    slidesToShow: 1,

    slidesToScroll: 1,

    responsive: [{

        breakpoint: 1024,

        settings: {

            slidesToShow: 1,

            slidesToScroll: 1,

            infinite: true,

            dots: true

        }

    }, {

        breakpoint: 600,

        settings: {

            slidesToShow: 2,

            slidesToScroll: 2

        }

    }, {

        breakpoint: 480,

        settings: {

            slidesToShow: 1,

            slidesToScroll: 1

        }

    }]

});

$(".our_work_slider").slick({

    dots: true,

    infinite: true,

    arrows: false,

    speed: 2000,

    autoplay: true,

    slidesToShow: 4,

    slidesToScroll: 4,

    responsive: [{

        breakpoint: 1024,

        settings: {

            slidesToShow: 3,

            slidesToScroll: 1,

            infinite: true,

            dots: true

        }

    }, {

        breakpoint: 600,

        settings: {

            slidesToShow: 2,

            slidesToScroll: 2

        }

    }, {

        breakpoint: 480,

        settings: {

            slidesToShow: 2,

            slidesToScroll: 2

        }

    }]

});
$('.sucess-slider').slick({
  dots: true,
  infinite: false,
  speed: 300,
  arrows: false,
  slidesToShow: 4,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
     
$('.video-testi').slick({
  dots: true,
  arrows:false,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

$('.testi-slider-new').slick({
  dots: true,
  infinite: false,
  speed: 300,
  arrows: false,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
        
$(".why_choose_slider").slick({

    dots: false,

    infinite: true,

    arrows: true,

    speed: 2000,

    autoplay: true,

    slidesToShow: 1,

    slidesToScroll: 1,

    responsive: [{

        breakpoint: 1024,

        settings: {

            slidesToShow: 1,

            slidesToScroll: 1,

            infinite: true,

            dots: true

        }

    }, {

        breakpoint: 600,

        settings: {

            slidesToShow: 1,

            slidesToScroll: 1

        }

    }, {

        breakpoint: 480,

        settings: {

            slidesToShow: 1,

            slidesToScroll: 1

        }

    }]

});

$(".open-popup").click(function() {

    $("#input-box").html(""), null != $(this).data("price") && ($("#input-box").append('<input type="hidden" name="customers_meta[price]" value="' + $(this).data("price") + '">'), $("#input-box").append('<input type="hidden" name="customers_meta[name]" value="' + $(this).data("name") + '">')), $("#entry-popup").css("display", "flex").fadeIn()

});

$("#entry-box_close").click(function() {

    $("#entry-popup").fadeOut()

});

$(document).ready(function() {

    $(".process-box").click(function() {

        $(".process-box").removeClass("active"), $(this).addClass("active")

    })

});

$(document).ready(function() {

    $(".fancybox").fancybox()

});

wow = new WOW({

    animateClass: "animated",

    offset: 100,

    callback: function(a) {

        console.log("WOW: animating <" + a.tagName.toLowerCase() + ">")

    }

});






wow.init();



$(".tabs-custom").click(function() {

    $(".tabs-custom").removeClass("active"), $(this).addClass("active")

});

$(".tabs-custom").click(function() {

    console.log($(this).attr("tab-panel")), $(".tab-pane").removeClass("active"), $("#" + $(this).attr("tab-panel")).addClass("active")

});

$(".chat, .chatt").click(function() {

    $zopim.livechat.window.toggle()

})