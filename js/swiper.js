"use strict";

const slider2 = new Swiper(".slider1", {
  slidesPerView: 1.6,
  centeredSlides: true,
  loop: true,
  spaceBetween: 52,
  initialSlide: 0,
  breakpoints: {
    768: {
      effect: "slide",
      slidesPerView: 1.7,
      spaceBetween: 150,
      centeredSlides: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    },
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  scrollbar: {
    el: ".swiper-scrollbar",
  },
});
