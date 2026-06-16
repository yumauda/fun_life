"use strict";

document.addEventListener("DOMContentLoaded", function () {
  var splideSettings = {
    type: "loop",
    perPage: 2,
    pagination: true,
    arrows: true,
    focus: "center",
    gap: "36px",
  };

  if (window.matchMedia("(max-width: 768px)").matches) {
    splideSettings.gap = "20px";
  }
  new Splide(".p-splide", splideSettings).mount();
  new Splide(".p-mv__splide", {
    type: "fade",
    perPage: 1,
    pagination: false,
    arrows: false,
    loop: true,
    speed: 2000,
    autoplay: true,
    interval: 3000,
    rewind: true,
    pauseOnHover: false,
  }).mount();
});
