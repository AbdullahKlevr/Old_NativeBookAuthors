var $ = jQuery.noConflict();
$(document).ready(function () {
    $("#carouselExampleControls").carousel({
        interval: 3e3,
        cycle: !0
    })
});
$(document).ready(function (e) {
    $(".view_more").click(function (e) {
        $(".pdf_opens").fadeIn();
        var a = $(this).attr("data-id");
        $("#" + a).addClass("active_pop")
    }), $(".pdf_opens").click(function (e) {
        $(".pdf_opens").fadeOut(), $(".iframe_pdf").removeClass("active_pop")
    })
}), $(".fancybox").fancybox({
    openEffect: "none",
    closeEffect: "none"
}), $(".package-slider").slick({
    dots: !0,
    infinite: !1,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [{
        breakpoint: 1024,
        settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: !0,
            dots: !0
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
}), $(".logo_type_slider").slick({
    dots: !0,
    infinite: !0,
    autoplay: !0,
    autoplaySpeed: 3e3,
    speed: 3e3,
    fade: !0,
    slidesToShow: 1
}), $(".video_type_slider").slick({
    dots: !0,
    infinite: !1,
    autoplay: !0,
    autoplaySpeed: 2e3,
    dots: !1,
    speed: 3e3,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [{
        breakpoint: 768,
        settings: {
            slidesToShow: 1
        }
    }, {
        breakpoint: 480,
        settings: {
            slidesToShow: 1
        }
    }]
}), $(".order_button2").click(function () {
    $(".popup-form").show(300).addClass("visibleit"), $(".popup-form2").show(300).addClass("visibleit"), $(".cus-overlay").fadeIn(300);
    $(".tophead h2").css("margin", "15px 0 15px 0"), $(".tophead h2").html("Start Your Project"), $(".tophead h3").css("display", "none")
}), $("section.packages a, section.branding_solution .order_button, section.cta ul li a, .branding-mob-btn .order_button").click(function () {
    $(".popup-form").show(300).addClass("visibleit"), $(".popup-form2").show(300).addClass("visibleit"), $(".cus-overlay").fadeIn(300);
    $(".tophead h2").html("Activate Your Coupon"), $(".tophead h3").css("display", "block")
}), $(document).ready(function () {
    $(".popup_open").click(function () {
        $(".popup-form").show(300).addClass("visibleit"), $(".cus-overlay").fadeIn(300)
    }), $("a.close").click(function () {
        $(".cus-overlay").trigger("click")
    }), $("a.close").click(function () {
        $(".cus-overlay").trigger("click")
    }), $(".cus-overlay").click(function () {
        $(this).fadeOut(300), $(".popup-form").removeClass("visibleit"), $(".popup-form").fadeOut(), $("#popupformLead2").fadeOut(), $("#ouibounce-modal").fadeOut(200), $(".floating-form-wrap").animate({
            "margin-right": "-584px"
        })
    })
}), $(function () {
    var e = window.location.pathname,
        a = e.substring(e.lastIndexOf("/") + 1);
    $(".navbar-nav li a").each(function () {
        var e = this.href.substring(this.href.lastIndexOf("/") + 1);
        a == e && $(this).parent().addClass("active")
    })
});
var path = window.location.pathname;

function openCity(e, a) {
    var t, s, o;
    for (s = document.getElementsByClassName("tabcontent"), t = 0; t < s.length; t++) s[t].style.display = "none";
    for (o = document.getElementsByClassName("tablinks"), t = 0; t < o.length; t++) o[t].className = o[t].className.replace(" active", "");
    document.getElementById(a).style.display = "block", e.currentTarget.className += " active"
}

function openCity2(e, a) {
    var t, s, o;
    for (s = document.getElementsByClassName("tabcontent2"), t = 0; t < s.length; t++) s[t].style.display = "none";
    for (o = document.getElementsByClassName("tablinks2"), t = 0; t < o.length; t++) o[t].className = o[t].className.replace(" active", "");
    document.getElementById(a).style.display = "block", e.currentTarget.className += " active"
}

function openCity3(e, a) {
    var t, s, o;
    for (s = document.getElementsByClassName("tabcontent3"), t = 0; t < s.length; t++) s[t].style.display = "none";
    for (o = document.getElementsByClassName("tablinks3"), t = 0; t < o.length; t++) o[t].className = o[t].className.replace(" active", "");
    document.getElementById(a).style.display = "block", e.currentTarget.className += " active"
}
$('.navbar-nav a[href="' + path + '"]').parent().find(".dropdown-menu").addClass("active"), "landing-page-copy-writing.php" == path && $(".landing-page").addClass("active"), "/process.php" == path && $(".process_nav").addClass("active"), "/contact-us.php" == path && $(".contact_nav").addClass("active"), "/index.php" == path && $(".home_nav").addClass("active"), "/" == path && $(".home_nav").addClass("active"), "/whiteboard-animation.php" == path && $(".servies_nav").addClass("active"), "/motion-graphics.php" == path && $(".servies_nav").addClass("active"), "/screen-cast.php" == path && $(".servies_nav").addClass("active"), "/typography.php" == path && $(".servies_nav").addClass("active"), "/cartoon-animation.php" == path && $(".servies_nav").addClass("active"), "/stock-animation.php" == path && $(".servies_nav").addClass("active"), $(function (e) {
    "use strict";
    e(".back-to-top").addClass("hidden-top"), e(window).scroll(function () {
        0 === e(this).scrollTop() ? e(".back-to-top").addClass("hidden-top") : e(".back-to-top").removeClass("hidden-top")
    }), e(".back-to-top").click(function () {
        return e("body,html").animate({
            scrollTop: 0
        }, 1200), !1
    })
});

document.getElementById("defaultOpen").click(), setTimeout(function () {
    $("#Mymodal").addClass("fade show"), $("#Mymodal").fadeIn(), $("body").addClass("modal-open")
}, 1e4)

;$(".close").click(function (e) {
    $("#Mymodal").removeClass("fade show"), $("body").removeClass("modal-open"), $("#Mymodal").fadeOut()
}), document.getElementById("defaultOpen3").click();

 $('.buss-slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.buss-slider-nav'
});
$('.buss-slider-nav').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  asNavFor: '.buss-slider-for',
  dots: false
});



// faq js 

const items = document.querySelectorAll(".accordion a");

function toggleAccordion(){
  this.classList.toggle('active');
  this.nextElementSibling.classList.toggle('active');
}

items.forEach(item => item.addEventListener('click', toggleAccordion));




// faqs-page-tab-script

function openTab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen").click();

// faqs-page-tab-script
