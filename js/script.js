jQuery(function ($) {
  // この中であればWordpressでも「$」が使用可能になる

  var topBtn = $(".p-totop");
  topBtn.hide();

  // ボタンの表示設定
  $(window).scroll(function () {
    if ($(this).scrollTop() > 70) {
      // 指定px以上のスクロールでボタンを表示
      topBtn.fadeIn();
    } else {
      // 画面が指定pxより上ならボタンを非表示
      topBtn.fadeOut();
    }
  });

  // ボタンをクリックしたらスクロールして上に戻る
  topBtn.click(function () {
    $("body,html").animate(
      {
        scrollTop: 0,
      },
      300,
      "swing"
    );
    return false;
  });

  // スムーススクロール (絶対パスのリンク先が現在のページであった場合でも作動)

  /* $(document).on("click", 'a[href*="#"]', function () {
    let time = 400;
    let header = $("header").innerHeight();
    let target = $(this.hash);
    if (!target.length) return;
    let targetY = target.offset().top - header;
    $("html,body").animate({ scrollTop: targetY }, time, "swing");
    return false;
  }); */
  $(function () {
    $(".p-tab__btn").on("click", function () {
      activateTab($(this));
    });
  });

  // 初期ロード時にURLパラメータをチェックし、該当するタブを開く
  const urlParams = new URLSearchParams(window.location.search);
  const tabParam = urlParams.get("tab");
  if (tabParam) {
    const targetTabButton = $(`#tabParam`);
    if (targetTabButton.length) {
      activateTab(targetTabButton);
    }
  }

  function activateTab(tabButton) {
    const tab_btn = $(".p-tab__btn");
    const tab_panel = $(".p-tab__panel");
    const tabID = "#" + tabButton.attr("aria-controls");

    tab_btn.attr("aria-selected", false).attr("aria-expanded", false);
    tabButton.attr("aria-selected", true).attr("aria-expanded", true);
    tab_panel.attr("aria-hidden", true);
    $(tabID).attr("aria-hidden", false);
  }
  $("#drawer a[href]").on("click", function (event) {
    $(".p-drawer-icon").trigger("click");
  });
});

document.addEventListener("DOMContentLoaded", () => {
  setUpAccordion();
});

const setUpAccordion = () => {
  const details = document.querySelectorAll(".js-details");
  const RUNNING_VALUE = "running"; // アニメーション実行中のときに付与する予定のカスタムデータ属性の値
  const IS_OPENED_CLASS = "is-opened"; // アイコン操作用のクラス名

  details.forEach((element) => {
    const summary = element.querySelector(".js-summary");
    const content = element.querySelector(".js-content");

    summary.addEventListener("click", (event) => {
      // デフォルトの挙動を無効化
      event.preventDefault();

      // 連打防止用。アニメーション中だったらクリックイベントを受け付けないでリターンする
      if (element.dataset.animStatus === RUNNING_VALUE) {
        return;
      }

      let icon = element.children[0];
      // detailsのopen属性を判定
      if (element.open) {
        // アコーディオンを閉じるときの処理
        // アイコン操作用クラスを切り替える(クラスを取り除く)
        element.classList.toggle(IS_OPENED_CLASS);
        // アニメーションを実行
        const closingAnim = content.animate(
          closingAnimKeyframes(content),
          animTiming
        );
        // アニメーション実行中用の値を付与
        element.dataset.animStatus = RUNNING_VALUE;

        icon.classList.toggle(IS_OPENED_CLASS);
        // アニメーションの完了後に
        closingAnim.onfinish = () => {
          // open属性を取り除く
          element.removeAttribute("open");
          // アニメーション実行中用の値を取り除く
          element.dataset.animStatus = "";
        };
      } else {
        // アコーディオンを開くときの処理
        // open属性を付与
        element.setAttribute("open", "true");

        // アイコン操作用クラスを切り替える(クラスを付与)
        element.classList.toggle(IS_OPENED_CLASS);
        // アニメーションを実行
        const openingAnim = content.animate(
          openingAnimKeyframes(content),
          animTiming
        );
        // アニメーション実行中用の値を入れる
        element.dataset.animStatus = RUNNING_VALUE;

        icon.classList.toggle(IS_OPENED_CLASS);
        // アニメーション完了後にアニメーション実行中用の値を取り除く
        openingAnim.onfinish = () => {
          element.dataset.animStatus = "";
        };
      }
    });
  });
};

/**
 * アニメーションの時間とイージング
 */
const animTiming = {
  duration: 400,
  easing: "ease-out",
};

/**
 * アコーディオンを閉じるときのキーフレーム
 */
const closingAnimKeyframes = (content) => [
  {
    height: content.offsetHeight + "px", // height: "auto"だとうまく計算されないため要素の高さを指定する
    opacity: 1,
  },
  {
    height: 0,
    opacity: 0,
  },
];

/**
 * アコーディオンを開くときのキーフレーム
 */
const openingAnimKeyframes = (content) => [
  {
    height: 0,
    opacity: 0,
  },
  {
    height: content.offsetHeight + "px",
    opacity: 1,
  },
];
jQuery(".p-drawer-icon").on("click", function (e) {
  e.preventDefault();
  jQuery(".p-drawer-icon").toggleClass("is-active");
  jQuery(".p-drawer-content").toggleClass("is-active");
  jQuery(".p-drawer-background").toggleClass("is-active");
  return false;
});
window.addEventListener("scroll", function () {
  var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
  var element = document.querySelector(".p-footer__floating");

  if (window.innerWidth <= 768) {
    // 768px以下のデバイスでのみ動作
    if (scrollPosition > 700) {
      element.style.opacity = "1";
    } else {
      element.style.opacity = "0";
    }
  }
});
window.onload = function () {
  document.body.classList.add("fade-in");
};

let scrollPosition = 0; // スクロール位置を記録する変数

jQuery(document).ready(function ($) {
  $(".p-drawer-icon, .p-drawer-icon--barge").on("click", function () {
    $("body").toggleClass("drawer-open");
  });
});

jQuery(document).ready(function ($) {
  $(".js-btn").on("click", function () {
    $(".js-news-wrapper1").slideDown();
    $(this).hide();
  });
});
jQuery(document).ready(function ($) {
  $(".js-btn2").on("click", function () {
    $(".js-news-wrapper2").slideDown();
    $(this).hide();
  });
});
jQuery(document).ready(function ($) {
  $(".js-btn3").on("click", function () {
    $(".js-news-wrapper3").slideDown();
    $(this).hide();
  });
});

jQuery(document).ready(function ($) {
  $(".p-tabNews__btn").each(function () {
    var postCount = parseInt($(this).data("post-count"), 1);
    // 表示する投稿の数を設定（例: 4）
    var displayCount = 4;

    // 投稿数が表示数以下の場合、ボタンを非表示にする
    if (postCount <= displayCount) {
      $(this).hide();
    }
  });
});
jQuery(".js-modal-btn").on("click", function (e) {
  e.preventDefault();
  jQuery(".p-modal").toggleClass("is-active");
  return false;
});
jQuery(".p-modal__close").on("click", function (e) {
  e.preventDefault();
  jQuery(".p-modal").removeClass("is-active");
  return false;
});
jQuery(".js-view").on("click", function (e) {
  e.preventDefault();
  jQuery(".p-digital-modal").toggleClass("is-active");
  return false;
});
jQuery(".p-digital-modal__close").on("click", function (e) {
  e.preventDefault();
  jQuery(".p-digital-modal").removeClass("is-active");
  return false;
});
