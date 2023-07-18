var swiper = new Swiper(".mySwiper", {
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  initialSlide: 1,
  spaceBetween: 50,
  pagination: {
    el: ".swiper-pagination",
    type: "progressbar",
  },
  navigation: {
    nextEl: "#rightClick",
    prevEl: "#leftClick",
  },


});

const swiper_comments = new Swiper(".swiper-comments", {
  grabCursor: true,
  slidesPerView: "auto",


  navigation: {
    nextEl: "#rightClick",
    prevEl: "#leftClick",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable:true,
  },
});


