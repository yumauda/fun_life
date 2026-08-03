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
      slidesPerView: 1,
      loop: true,
      speed: 700,
      spaceBetween: 24,
      observer: true,
      observeParents: true,
      breakpoints: {
        768: {
          slidesPerView: 1.7,
          spaceBetween: 40,
        },
      },
    });

    return {
      element: slider,
      instance: swiper,
    };
  });

  const rows = Array.from(modularRoot.querySelectorAll(".p-modular__menu-row"));
  const menuButtons = Array.from(modularRoot.querySelectorAll(".p-modular__menu-button"));
  const subButtons = Array.from(modularRoot.querySelectorAll(".p-modular__sub-button"));
  const panels = Array.from(modularRoot.querySelectorAll(".p-modular__panel"));
  const mobileMedia = window.matchMedia("(max-width: 767px)");

  const updateActiveRow = (row) => {
    rows.forEach((item) => {
      item.classList.toggle("is-active", item === row);

      const button = item.querySelector(".p-modular__menu-button[aria-controls]");

      if (button) {
        button.setAttribute("aria-expanded", String(item === row));
      }
    });
  };

  const showPanel = (target) => {
    panels.forEach((panel) => {
      const isActive = panel.dataset.modularPanel === target;

      panel.classList.toggle("is-active", isActive);
      panel.setAttribute("aria-hidden", String(!isActive));
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
    row.addEventListener("mouseenter", () => {
      if (!mobileMedia.matches) {
        updateActiveRow(row);
      }
    });

    row.addEventListener("focusin", () => {
      if (!mobileMedia.matches) {
        updateActiveRow(row);
      }
    });
  });

  menuButtons.forEach((button) => {
    button.addEventListener("click", () => {
      if (!mobileMedia.matches) {
        return;
      }

      const row = button.closest(".p-modular__menu-row");
      const hasSubMenu = row && row.querySelector(".p-modular__sub-menu");
      const willOpen = Boolean(hasSubMenu && !row.classList.contains("is-active"));

      updateActiveRow(willOpen ? row : null);
      modularRoot.classList.add("is-mobile-awaiting-selection");
      modularRoot.classList.remove("is-mobile-panel-visible");
      panels.forEach((panel) => panel.setAttribute("aria-hidden", "true"));
    });
  });

  subButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const parentRow = button.closest(".p-modular__menu-row");

      if (parentRow) {
        updateActiveRow(parentRow);
      }

      showPanel(button.dataset.modularTarget);

      if (mobileMedia.matches) {
        modularRoot.classList.remove("is-mobile-awaiting-selection");
        modularRoot.classList.add("is-mobile-panel-visible");
      }
    });
  });

  if (mobileMedia.matches) {
    panels.forEach((panel) => panel.setAttribute("aria-hidden", "true"));
  } else {
    panels.forEach((panel) => {
      panel.setAttribute("aria-hidden", String(!panel.classList.contains("is-active")));
    });
  }
}
