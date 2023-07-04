const swiper = new Swiper(".swiper", {
  effect: "coverflow",
  grabCursor: false,
  draggable: false,
  centeredSlides: true,
  initialSlide: 1,
  slidesPerView: "auto",
  loop: true,

  coverflowEffect: {
    rotate: 0,
    stretch: 450,
    depth: 90,
    modifier: 2,
    slideShadows: false,
  },

  navigation: {
    nextEl: "#leftClick",
    prevEl: "#rightClick",
  },
});

const swiper_comments = new Swiper(".swiper-comments", {
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "3",
  initialSlide: 1,

  navigation: {
    nextEl: "#rightClick",
    prevEl: "#leftClick",
  },
});


