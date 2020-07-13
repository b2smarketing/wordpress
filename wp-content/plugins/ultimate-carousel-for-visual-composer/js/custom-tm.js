// Slick Carousal Slider
jQuery(document).on('ready', function() {
  jQuery(".tdt-slider").each(function(index, el) {
    var slide    = jQuery(this).data('slide');
    var tabs    = jQuery(this).data('tabs');
    jQuery(this).slick({
    dots: true,
    infinite: true,
    slidesToShow: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: tabs,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: slide,
          slidesToScroll: 1
        }
      }
      ]
  }); 
  });
});
jQuery(document).on('ready', function() {
  jQuery(".post-slider").slick({
    dots: true,
    infinite: true,
    slidesToShow: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
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
    ]
  });
});