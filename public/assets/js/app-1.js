$(".food_box_slid").slick({
  slidesToShow: 6,
  slidesToScroll: 1,
  arrows: false,
  dots: false,
  speed: 300,
  centerPadding: "30px",
  infinite: true,
  autoplaySpeed: 5000,
  autoplay: false,
  prevArrow:
    '<div class="slick-nav prev-arrow"><i class="fa-solid fa-angle-left"></i></div>',
  nextArrow:
    '<div class="slick-nav next-arrow"><i class="fa-solid fa-angle-right"></i></div>',
  responsive: [
    {
      breakpoint: 1441,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
      },
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
});
$(".interview-slide").slick({
  slidesToShow: 6,
  slidesToScroll: 1,
  arrows: false,
  dots: false,
  speed: 300,
  centerPadding: "20px",
  infinite: true,
  autoplaySpeed: 5000,
  autoplay: false,
  prevArrow:
    '<div class="slick-nav prev-arrow"><i class="fa-solid fa-angle-left"></i></div>',
  nextArrow:
    '<div class="slick-nav next-arrow"><i class="fa-solid fa-angle-right"></i></div>',
  responsive: [
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
});

