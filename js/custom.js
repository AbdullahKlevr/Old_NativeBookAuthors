
$(document).ready(function() {

  $("li:first-child").addClass("first");
  $("li:last-child").addClass("last");

  $('.active_popup').click(function(){
        $(".popupform").fadeIn();
        $(".overlay_popup").fadeIn();
  });

  $('.closePop,.overlay_popup').click(function(){
        $(".popupform").fadeOut();
        $(".overlay_popup").fadeOut();
  });
});



// RESPONSIVE NAVIGATION
// OPEN BTN
  $(document).ready(function () {
    $("#navbar").on("click", function() {
      $(".nveMenu").addClass("is-opened");
      $(".overlay").addClass("is-on");
    });

    $(".overlay").on("click", function() {
      $(this).removeClass("is-on");
      $(".nveMenu").removeClass("is-opened");
    });
  });
// CLOSE BTN
  $(".overlay").on("click", function() {
    $(this).removeClass("is-on");
    $(".nveMenu").removeClass("is-opened");
  });

  $(".close-btn-nav").click(function(){
  $(".nveMenu").removeClass("is-opened");
  $(".overlay").removeClass("is-on");
  });
// RESPONSIVE NAVIGATION





// ACTIVE JS START
$(document).ready(function(){
  $('ul li span').click(function(){
    $('li span').removeClass("active-class");
    $(this).addClass("active-class");
});
});
// ACTIVE JS END





// AOS initializing 
AOS.init( 
  {
  duration: 1200, 
  once: true  
  }
);



// Wow initializing 
new WOW().init();









$('.branding-slider').owlCarousel({
  loop: true,
  margin: 10,
  dots: false,
  autoplayHoverPause:true,
  smartSpeed: 2000,
  autoplay: true,
  slideTransition: 'linear',
  autoplayTimeout: 3000,
  autoplaySpeed: 3000,
  nav: true,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 2
    },

    1100: {
      items: 3
    },


    1200: {
      items: 4
    }
  }
})






$('.client-testimonial-slider').owlCarousel({
  loop: true,
  dots: true,
  margin: 0,
  smartSpeed: 2000,
  slideTransition: 'linear',
  autoplayTimeout: 3000,
  autoplayHoverPause:true,
  autoplaySpeed: 3000,
  autoplay: false,
  nav: false,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    1000: {
      items: 3
    }
  }
})



$('.logos-slider-main-wrap').owlCarousel({
  loop: true,
  dots: false,
  margin: 0,
  autoplay: false,
  nav: false,
  responsive: {
    0: {
      items: 2
    },
    600: {
      items: 3
    },
    1000: {
      items: 5
    }
  }
})



$('.logos-slider-main-wrap-2').owlCarousel({
  loop: true,
  dots: false,
  margin: 30,
  smartSpeed: 2000,
  slideTransition: 'linear',
  // autoplayTimeout: 3000,
  autoplayHoverPause:true,
  // autoplaySpeed: 3000,
  autoplay: true,
  nav: false,
  responsive: {
    0: {
      items: 2
    },
    600: {
      items: 3
    },
    1000: {
      items: 5
    }
  }
})









$('.book-slider-main-wrap-2').owlCarousel({
  loop: true,
  margin: 0,
  dots: false,
  // autoplayHoverPause:true,
  smartSpeed: 2000,
  autoplay: true,
  slideTransition: 'linear',
  autoplayTimeout: 3000,
  autoplaySpeed: 3000,
  nav: false,
  responsive: {
    0: {
      items: 7
    },
    600: {
      items: 10
    },
    1000: {
      items: 14
    }
  }
})



































// Show the button when the user scrolls down 20px from the top of the document
window.onscroll = function() {
  showScrollToTopButton();
};

function showScrollToTopButton() {
  var scrollToTopBtn = document.getElementById("scrollToTopBtn");
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    scrollToTopBtn.style.display = "block";
  } else {
    scrollToTopBtn.style.display = "none";
  }
}

// Scroll to the top of the document when the button is clicked
function scrollToTop() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
}



$(".clickbutton").click(function () {
  $('.floatbutton').toggleClass("active");
});











wow = new WOW({
  animateClass: 'animated',
  offset: 100,
});
wow.init();
