"use strict";

document.addEventListener("DOMContentLoaded", function () {
  // メインスライダー
  const main = new Splide("#main-carousel", {
    type: "fade", // フェード
    rewind: true, // スライダーの終わりまで行ったら先頭に巻き戻す
    pagination: false, // ページネーション非表示
    arrows: false, // 矢印非表示
  });
  // サムネイル
  const thumbnails = new Splide("#thumbnail-carousel", {
    perPage: 4, // サムネイル3枚表示
    pagination: false, // ページネーション非表示
    isNavigation: true, // 他のスライダーのナビゲーションとしてそれぞれのスライドをクリック可能にする
  });
  main.sync(thumbnails);
  main.mount();
  thumbnails.mount();
});
