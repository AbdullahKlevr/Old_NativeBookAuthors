$(window).on("scroll", function () {
    AOS.init();
    AOS.init({disable: 'mobile'});
});

var currentTab = 0;

function showTab(e) {
    var t = document.getElementsByClassName("tab");
    (t[e].style.display = "block"),
        0 == e
            ? ((document.getElementById("prevBtn").style.display = "none"),
                (document.getElementById("signupBtn").style.display = "none"),
                (document.getElementById("nextBtn").style.display = "inline"))
            : (document.getElementById("prevBtn").style.display = "inline"),
        e == t.length - 1
            ? ((document.getElementById("nextBtn").style.display = "none"),
                (document.getElementById("signupBtn").style.display = "inline"))
            : (document.getElementById("nextBtn").innerHTML = "Next");
}

function nextPrev(e) {
    var t = document.getElementsByClassName("tab");
    if (1 == e && !validateForm()) return !1;
    (t[currentTab].style.display = "none"), showTab((currentTab += e));
}

function validateForm() {
    var e,
        t,
        n = !0;
    for (
        e = document
            .getElementsByClassName("tab")
            [currentTab].getElementsByTagName("input"),
            t = 0;
        t < e.length;
        t++
    )
        "" == e[t].value && ((e[t].className += " invalid"), (n = !1));
    return n;
}

var currentTab02 = 0;

function showTabPopup(e) {
    var t = document.getElementsByClassName("tab02");
    (t[e].style.display = "block"),
        0 == e
            ? ((document.getElementById("prevBtn02").style.display = "none"),
                (document.getElementById("signupBtn02").style.display = "none"),
                (document.getElementById("nextBtn02").style.display = "inline"))
            : (document.getElementById("prevBtn02").style.display = "inline"),
        e == t.length - 1
            ? ((document.getElementById("nextBtn02").style.display = "none"),
                (document.getElementById("signupBtn02").style.display = "inline"))
            : (document.getElementById("nextBtn02").innerHTML = "Next");
}

function nextPrevPopup(e) {
    var t = document.getElementsByClassName("tab02");
    if (1 == e && !validateFormPopup()) return !1;
    (t[currentTab02].style.display = "none"),
        showTabPopup((currentTab02 += e)),
        0 == currentTab02
            ? document
                .getElementsByClassName("popup_form_wrap")[0]
                .classList.remove("dynamicClass")
            : document
                .getElementsByClassName("popup_form_wrap")[0]
                .classList.add("dynamicClass");
}

function validateFormPopup() {
    var e,
        t,
        n = !0;
    for (
        e = document
            .getElementsByClassName("tab02")
            [currentTab02].getElementsByTagName("input"),
            t = 0;
        t < e.length;
        t++
    )
        "" == e[t].value && ((e[t].className += " invalid"), (n = !1));
    return n;
}

var currentTab03 = 0;

function showTabPopupExit(e) {
    var t = document.getElementsByClassName("tab03");
    (t[e].style.display = "block"),
        0 == e
            ? ((document.getElementById("prevBtn03").style.display = "none"),
                (document.getElementById("signupBtn03").style.display = "none"),
                (document.getElementById("nextBtn03").style.display = "inline"))
            : (document.getElementById("prevBtn03").style.display = "inline"),
        e == t.length - 1
            ? ((document.getElementById("nextBtn03").style.display = "none"),
                (document.getElementById("signupBtn03").style.display = "inline"))
            : (document.getElementById("nextBtn03").innerHTML = "Next");
}

function nextPrevPopupExit(e) {
    var t = document.getElementsByClassName("tab03");
    if (1 == e && !validateFormPopupExit()) return !1;
    (t[currentTab03].style.display = "none"),
        showTabPopupExit((currentTab03 += e)),
        0 == currentTab03
            ? document
                .getElementsByClassName("popupExit_form_wrap")[0]
                .classList.remove("dynamicClass")
            : document
                .getElementsByClassName("popupExit_form_wrap")[0]
                .classList.add("dynamicClass");
}

function validateFormPopupExit() {
    var e,
        t,
        n = !0;
    for (
        e = document
            .getElementsByClassName("tab03")
            [currentTab03].getElementsByTagName("input"),
            t = 0;
        t < e.length;
        t++
    )
        "" == e[t].value && ((e[t].className += " invalid"), (n = !1));
    return n;
}

// AOS.init({
//     disable: function () {
//         return window.innerWidth < 991;
//     },
// });

$(".slides_bookplatform").not(".slick-initialized").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    dots: false,
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: false,
    responsive: [

        {
            breakpoint: 768,
            settings: {
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 540,
            settings: {
                arrows: false,
                slidesToShow: 2,
                slidesToScroll: 1,
            }
        }
    ]
});


$(".testi-slider").slick({
    infinite: true,
    slidesToShow: 1,
    autoplay: false,
    slidesToScroll: 1,
    centerMode: true,
    centerPadding: "0px",
    arrows: false,

});

$(".testimonial-two").slick({
    infinite: true,
    slidesToShow: 4,
    autoplay: true,
    slidesToScroll: 1,
    centerPadding: "0px",
    arrows: true,
    responsive: [
        {
            breakpoint: 1370,
            settings: {
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 999,
            settings: {
                arrows: false,
                slidesToShow: 2,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }
    ]
});


$(".blogslider-two").slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    responsive: [
        {
            breakpoint: 1370,
            settings: {
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 999,
            settings: {
                arrows: false,
                dots: true,
                slidesToShow: 2,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                dots: true,
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }
    ]
});

$(".service-blogslider").slick({
    infinite: true,
    slidesToShow: 3,
    autoplay: false,
    slidesToScroll: 1,
    centerPadding: "0px",
    centerMode: true,
    arrows: true,
    responsive: [
        {
            breakpoint: 1370,
            settings: {
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 999,
            settings: {
                arrows: false,
                dots: true,
                slidesToShow: 2,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                dots: true,
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }
    ]
});

$(".teamslider-abt").slick({

    slidesToShow: 5,
    autoplay: true,
    slidesToScroll: 1,
    centerMode: true,
    centerPadding: "0px",
    arrows: true,
    responsive: [
        {
            breakpoint: 1370,
            settings: {
                arrows: false,
                slidesToShow: 4,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 999,
            settings: {
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                slidesToShow: 2,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 450,
            settings: {
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }
    ]
});


$(".our-client-slide").slick({
    slidesToShow: 1,
    autoplay: true,
    slidesToScroll: 1,
    centerMode: true,
    centerPadding: "0px",
    arrows: true,
    vertical: true,

});

$('.menu-Bar').click(function () {
    $(this).toggleClass('open');
    $('.menuWrap').toggleClass('open');
    $('body').toggleClass('ovr-hiddn');
});


$(".dropdown-mm").mouseover(function () {
    $(this).find('a').addClass('is-active');
    $(this).find(".dropdown-menu").addClass('is-active');
});

$(".dropdown-mm").mouseleave(function () {
    $(this).find('a').removeClass('is-active');
    $(this).find(".dropdown-menu").removeClass('is-active');
});


var topnav = $(".topnavs ul").html();
var submenu = $(".submenu_sec .navbar-nav").html();


if ($(window).width() >= 991) {
    $(".menuWrap ul.menu").append(topnav + submenu);
}
$(".books_slides .row").slick({
    slidesToShow: 3,
    autoplay: false,
    dots: true,
    slidesToScroll: 3,
    adaptiveHeight: true,
    arrows: false,
    responsive: [
        {
            breakpoint: 1370,
            settings: {
                arrows: false,
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 999,
            settings: {
                arrows: false,
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 450,
            settings: {
                arrows: false,
                slidesToShow: 1,
            }
        }
    ]

});


if ($(window).width() <= 991) {

    $(".premium-ghost .row").slick({
        slidesToShow: 1,
        autoplay: true,
        slidesToScroll: 1,
        arrows: false,

    });

    $(".main-raing").slick({
        slidesToShow: 1,
        autoplay: false,
        slidesToScroll: 1,
        arrows: false,

    });

    $(".responsive-sliders").slick({
        slidesToShow: 1,
        autoplay: false,
        slidesToScroll: 1,
        arrows: false,

    });


}


if ($(window).width() <= 850) {


    $(".our-range-grid").slick({
        slidesToShow: 1,
        autoplay: false,
        dots: true,
        slidesToScroll: 1,
        arrows: false,

    });


    $(".service-genre .row").slick({
        slidesToShow: 1,
        autoplay: false,
        dots: true,
        slidesToScroll: 1,
        arrows: false,

    });


//    $(".dropdown-mm a").click(function() {
//         $(this).next().slideToggle();
//    });


    $(".dropdown-mm a.dropdown-toggle").on("click", function (e) {
        e.preventDefault();
        var alreadyActive = $(this).parent().hasClass("active");
        var getParentClass = $(this).parent().attr("class");
        var h = $(this).attr("href");
        $(this).parent().siblings().children("ul,div").slideUp();
        $(this).next().slideToggle();
        w("alreadyActive: " + alreadyActive);
        if (!alreadyActive) {
            $(this).parent().toggleClass("active");
            //showActivePanel(this);
        } else {
            $(this).parent().removeClass("active");
        }
        //w(h);
    });


}


$("[data-targetit]").on("click", function (e) {
    $(this).addClass("active");
    $(this).siblings().removeClass("active");
    var target = $(this).data("targetit");
    $("." + target)
        .siblings('[class^="box-"]')
        .hide();
    $("." + target).fadeIn();
    $(".package_slider .row").slick("setPosition");
    $(".books_slides .row").slick("setPosition");
});


$(document).ready(function () {
    setTimeout(function () {
        $('#popup_form').modal('show');
    }, 5000);


});


//  $(".dropdown-menu").mouseover(function(){
//     $(".dropdown-menu").addClass('is-active');
//  });

//  $(".dropdown-menu").mouseleave(function(){
//     $(".dropdown-menu").removeClass('is-active');
//  });

($(".packag-slider").addClass("owl-carousel owl-theme"),
    $(".packag-slider").owlCarousel({
        loop: !1,
        nav: true,
        margin: 0,

        navText: ['<img src="../assets/images/leftarrow.png">', '<img src="../assets/images/rightarrow.png">'],
        dots: false,
        autoplay: !1,
        autoplayTimeout: 4e3,
        autoplayHoverPause: !0,
        mouseDrag: !0,
        responsiveClass: !0, responsive: {0: {items: 1, dots: true, nav: false}, 768: {items: 3,}}
    }))