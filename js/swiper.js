"use strict";

if (document.querySelector(".slider1")) {
  const slider2 = new Swiper(".slider1", {
    slidesPerView: 1.2,
    centeredSlides: true,
    loop: true,
    spaceBetween: 12,
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
}

if (document.querySelector(".p-free__slider")) {
  new Swiper(".p-free__slider", {
    slidesPerView: "auto",
    spaceBetween: 24,
    loop: true,
    speed: 5000,
    allowTouchMove: true,
    freeMode: true,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
      pauseOnMouseEnter: true,
    },
    breakpoints: {
      768: {
        spaceBetween: 44,
      },
    },
  });
}

const modularRoot = document.querySelector(".p-modular");

if (modularRoot) {
  const modularSwipers = Array.from(modularRoot.querySelectorAll(".p-modular__slider")).map((slider) => {
    const swiper = new Swiper(slider, {
      slidesPerView: 1.7,
      loop: true,
      speed: 700,
      spaceBetween: 40,
      observer: true,
      observeParents: true,

    });

    return {
      element: slider,
      instance: swiper,
    };
  });

  const rows = Array.from(modularRoot.querySelectorAll(".p-modular__menu-row"));
  const subButtons = Array.from(modularRoot.querySelectorAll(".p-modular__sub-button"));
  const panels = Array.from(modularRoot.querySelectorAll(".p-modular__panel"));

  const updateActiveRow = (row) => {
    rows.forEach((item) => {
      item.classList.toggle("is-active", item === row);
    });
  };

  const showPanel = (target) => {
    panels.forEach((panel) => {
      panel.classList.toggle("is-active", panel.dataset.modularPanel === target);
    });

    subButtons.forEach((button) => {
      button.classList.toggle("is-active", button.dataset.modularTarget === target);
    });

    modularSwipers.forEach((item) => {
      item.instance.update();
    });

    requestAnimationFrame(() => {
      const activePanel = panels.find((panel) => panel.dataset.modularPanel === target);
      const activeSwiper = modularSwipers.find((item) => activePanel && activePanel.contains(item.element));

      if (activeSwiper) {
        activeSwiper.instance.update();
        activeSwiper.instance.slideToLoop(0, 0);
      }
    });
  };

  rows.forEach((row) => {
    row.addEventListener("mouseenter", () => updateActiveRow(row));
    row.addEventListener("focusin", () => updateActiveRow(row));
  });

  subButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const parentRow = button.closest(".p-modular__menu-row");

      if (parentRow) {
        updateActiveRow(parentRow);
      }

      showPanel(button.dataset.modularTarget);
    });
  });
}
