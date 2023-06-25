const swiperComment = new Swiper(".swiper", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  initialSlide: 1,
  slidesPerView: "auto",

  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    depth: 100,
    modifier: 2,
  },

  navigation: {
    nextEl: "#rightClick",
    prevEl: "#leftClick",
  },
});