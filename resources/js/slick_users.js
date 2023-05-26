$(document).ready(function () {
  $(".contact-slider-wrapper").slick({
    infinite: true,
    draggable: true,
    dots: true,
    arrows: false,
    autoplay: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    speed: 1000,
    autoplaySpeed: 2000,
    pauseOnDotsHover: true,
    pauseOnHover: false,
    cssEase: "ease",
    prevArrow: $("#left-arrow"),
    nextArrow: $("#right-arrow"),
    responsive: [
      {
        breakpoint: 1280,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 1050,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 700,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
});