$(document).ready(function () {

  /*$('.carousel').owlCarousel({
    loop:true,
    margin:6,
    autoWidth:true,
    responsiveClass:true,
    responsive:{
      0:{
        items:1,
        nav:false
      },
      600:{
        items:3,
        nav:false
      }
    }
  })*/

  if($('.popup-toggle').length){
    $('.popup-toggle').click(function(){
      $('.popup').fadeToggle(300);
    })
  }

  if($('#popup-closer').length > 0) {
    $('#popup-closer').click(function(){

        $('.carousel.owl-carousel').show();
        $('.carousel').owlCarousel({
            loop:true,
            margin:6,
            autoWidth:true,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:3,
                    nav:false
                }
            }
        })
    });
  }

  if($('.products--container').length){
      $('.products--container').mCustomScrollbar({
        autoHideScrollbar: true,
        axis:"y",
        scrollbarPosition: "outside"
        //theme: 'dark'
      });
  }

});