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


  $("#drawer a[href]").on("click", function (event) {
    $(".p-drawer-icon").trigger("click");
  });
});

document.addEventListener("DOMContentLoaded", () => {
  setUpAccordion();
  setUpWorksModal();
  setUpStyleSelector();
});

const setUpStyleSelector = () => {
  const sections = document.querySelectorAll(".js-style");
  if (!sections.length) return;

  sections.forEach((section) => {

  const items = Array.from(section.querySelectorAll(".js-style-item"));
  const detail = section.querySelector(".p-style__detail");
  const title = section.querySelector(".js-style-title");
  const text = section.querySelector(".js-style-text");
  const cursor = section.querySelector(".js-style-cursor");
  const gallery = section.querySelector(".js-style-gallery");
  let changeTimer = null;
  let resizeTimer = null;
  let activeItem = items.find((item) => item.classList.contains("is-active"));

  const setDetailMinHeight = () => {
    const detailWidth = detail.getBoundingClientRect().width;
    if (!detailWidth) return;

    const clone = detail.cloneNode(true);
    const cloneTitle = clone.querySelector(".js-style-title");
    const cloneText = clone.querySelector(".js-style-text");
    clone.classList.remove("is-changing");
    clone.removeAttribute("aria-live");
    clone.setAttribute("aria-hidden", "true");
    clone.style.position = "fixed";
    clone.style.visibility = "hidden";
    clone.style.pointerEvents = "none";
    clone.style.width = `${detailWidth}px`;
    clone.style.minHeight = "0";
    document.body.appendChild(clone);

    const maxHeight = items.reduce((height, item) => {
      cloneTitle.innerHTML = item.dataset.styleTitle;
      cloneText.textContent = item.dataset.styleText;
      return Math.max(height, clone.scrollHeight);
    }, 0);

    clone.remove();
    detail.style.minHeight = `${Math.ceil(maxHeight)}px`;
  };

  const updateStyle = (item) => {
    if (item === activeItem) return;
    activeItem = item;
    items.forEach((button) => {
      const isActive = button === item;
      button.classList.toggle("is-active", isActive);
      button.setAttribute("aria-pressed", String(isActive));
    });

    window.clearTimeout(changeTimer);
    detail.classList.add("is-changing");
    changeTimer = window.setTimeout(() => {
      title.innerHTML = item.dataset.styleTitle;
      text.textContent = item.dataset.styleText;
      detail.classList.remove("is-changing");
    }, 220);
  };

  items.forEach((item) => {
    item.addEventListener("mouseenter", () => updateStyle(item));
    item.addEventListener("focus", () => updateStyle(item));
    item.addEventListener("click", () => updateStyle(item));
  });

  setDetailMinHeight();
  document.fonts?.ready.then(setDetailMinHeight);
  window.addEventListener("resize", () => {
    window.clearTimeout(resizeTimer);
    resizeTimer = window.setTimeout(setDetailMinHeight, 150);
  });

  if (!window.matchMedia("(hover: hover) and (pointer: fine)").matches) return;

  let mouseX = 0;
  let mouseY = 0;
  let frameId = null;
  const renderCursor = () => {
    cursor.style.transform = `translate3d(${mouseX}px, ${mouseY}px, 0) translate(-50%, -50%)`;
    frameId = null;
  };

  gallery.addEventListener("pointermove", (event) => {
    mouseX = event.clientX;
    mouseY = event.clientY;
    if (!frameId) frameId = window.requestAnimationFrame(renderCursor);
  });
  gallery.addEventListener("pointerenter", () => cursor.classList.add("is-visible"));
  gallery.addEventListener("pointerleave", () => cursor.classList.remove("is-visible"));
  });
};

const setUpWorksModal = () => {
  const modals = document.querySelectorAll(".js-works-modal");
  if (!modals.length) return;

  let activeModal = null;
  let lastFocusedElement = null;

  const getFocusableElements = (modal) => Array.from(
    modal.querySelectorAll('button:not([disabled]), [href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])')
  );

  const closeModal = () => {
    if (!activeModal) return;
    activeModal.classList.remove("is-open");
    activeModal.setAttribute("aria-hidden", "true");
    document.body.classList.remove("is-works-modal-open");
    const focusTarget = lastFocusedElement;
    activeModal = null;
    window.setTimeout(() => {
      if (!activeModal) focusTarget?.focus();
    }, 350);
  };

  const openModal = (modal, trigger) => {
    if (!modal) return;
    activeModal = modal;
    lastFocusedElement = trigger;
    modal.classList.add("is-open");
    modal.setAttribute("aria-hidden", "false");
    document.body.classList.add("is-works-modal-open");
    window.setTimeout(() => modal.querySelector(".p-works-modal__close")?.focus(), 50);
  };

  document.addEventListener("click", (event) => {
    const openButton = event.target.closest(".js-works-modal-open");
    if (openButton) {
      openModal(document.getElementById(openButton.dataset.modalTarget), openButton);
      return;
    }

    if (activeModal && event.target.closest(".js-works-modal-close")) {
      closeModal();
    }
  });

  document.addEventListener("keydown", (event) => {
    if (!activeModal) return;
    if (event.key === "Escape") {
      closeModal();
      return;
    }
    if (event.key !== "Tab") return;

    const focusableElements = getFocusableElements(activeModal);
    if (!focusableElements.length) return;
    const firstElement = focusableElements[0];
    const lastElement = focusableElements[focusableElements.length - 1];

    if (event.shiftKey && document.activeElement === firstElement) {
      event.preventDefault();
      lastElement.focus();
    } else if (!event.shiftKey && document.activeElement === lastElement) {
      event.preventDefault();
      firstElement.focus();
    }
  });
};

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

window.onload = function () {
  document.body.classList.add("fade-in");
};

let scrollPosition = 0; // スクロール位置を記録する変数

jQuery(document).ready(function ($) {
  $(".p-drawer-icon, .p-drawer-icon--barge").on("click", function () {
    $("body").toggleClass("drawer-open");
  });
});
