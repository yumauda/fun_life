"use strict";

document.addEventListener("DOMContentLoaded", function () {
  // 画面の幅を取得
  var windowWidth = window.innerWidth;

  // 画面幅が768px未満の場合にのみスライダーを初期化
  if (windowWidth < 768) {
    new Splide(".p-step-splide", {
      perPage: 2,
      pagination: true,
      arrows: true,
      gap: "10px",
    }).mount();
  }
});

