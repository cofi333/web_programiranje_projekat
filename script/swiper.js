const swiperComment = new Swiper(".swiper", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  initialSlide: 1,
  slidesPerView: "auto",
  rewind: true,

  coverflowEffect: {
    rotate: 0,
    stretch: 450,
    depth: 90,
    modifier: 2,
    slideShadows: false
  },

  navigation: {
    nextEl: "#leftClick",
    prevEl: "#rightClick",
  },
});