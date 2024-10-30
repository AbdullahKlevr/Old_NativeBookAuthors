var newsletter_p = setInterval(function(){
$("#bouncepopup-overlay").css("display","block")
$( "#bouncepopupform" ).toggle( "bounce", { times: 1 }, "slow" );
clearInterval(newsletter_p);
}, 5000);

  


$(document).ready(function() {


$(".bounce-close").click(function(){
$(".bouncepopup-overlay").hide();
$("#bouncepopupform").toggle( "fadeOut" );

})

 

 
    $(function() {
    var selectedClass = "";
    $(".fil-cat").click(function(){
        $(this).addClass('active-pf');
    selectedClass = $(this).attr("data-rel"); 
     $("#portfolio").fadeTo(100, 0.1);
    $("#portfolio>div").not("."+selectedClass).fadeOut().removeClass('scale-anm');
    setTimeout(function() {
      $("."+selectedClass).fadeIn().addClass('scale-anm');
      $("#portfolio").fadeTo(300, 1);
      $('.fil-cat').removeClass('active-pf')
    }, 300); 
    
  });
});




$(".validate-popupform").validate();

 
function setButtonURL() {
 return false;
}



 

    $('.various').click(function() {
        var leadprice = $(this).attr('name');
        $(".popupform .lead_area").val(leadprice);
        
         $('#bouncepopupform').attr('id' , 'bouncepopupform2');
        $('.bouncepopup-overlay').attr('id' , 'bouncepopupform2');

    });

 
    
    $("li:first-child").addClass("first");
    $("li:last-child").addClass("last");
    $("tr:nth-child(odd)").addClass("alter");
    $('[href="#"]').attr("href", "javascript:;");
   
    
 $(".bounce-popupform").validate();


$('#testimonails-slider').owlCarousel({
    loop:true,
    margin:0,
    nav:false,
    dots:true,
    margin:10,
     items:2,
    auto:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:1,
            nav:false
        },
        1000:{
            items:2,
            nav:false,
            loop:false
        }
    }
});


 $(".various").click(function() {
        var pkgname2 = $(this).attr('title');
        if ($(this).attr('title') !== undefined) {
            $('#popupform h2').html(pkgname2);
            return;
        } else {
            var pkgname2 = $(this).attr('title');
            $('#popupform h2').text("Activate Coupon Now");
        }
    });




    $('[data-fancybox]').fancybox();
     $(".validate-footer").validate();
    $('.portfolio-content [data-fancybox="video"], .testimonail-thumb [data-fancybox="video"]').fancybox({
        afterLoad: function(instance, current) {
            current.$content.css({
                overflow: 'visible',
                background: '#000',
            });
        },
        onUpdate: function(instance, current) {
            var width, height, ratio = 16 / 9,
                video = current.$content;
            if (video) {
                video.hide();
                width = current.$slide.width();
                height = current.$slide.height() - 100;
                if (height * ratio > width) {
                    height = width / ratio;
                } else {
                    width = height * ratio;
                }
                video.css({
                    width: width,
                    height: height
                }).show();
            }
        }
    })
});