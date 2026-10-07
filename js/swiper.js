"use strict";

const topProjectItems = document.querySelectorAll(".js-top-project-item");

topProjectItems.forEach((item) => {
  const slider = item.querySelector(".js-top-project-slider");
  const slides = slider.querySelectorAll(".swiper-slide");
  const current = item.querySelector(".js-top-project-current");
  const total = item.querySelector(".js-top-project-total");

  const updateProjectCounter = (swiper) => {
    current.textContent = String(swiper.realIndex + 1);
    total.textContent = String(slides.length);
  };

  new Swiper(slider, {
    slidesPerView: "auto",
    spaceBetween: 12,
    loop: slides.length > 1,
    loopedSlides: slides.length,
    loopAdditionalSlides: slides.length,
    speed: 700,
    grabCursor: slides.length > 1,
    keyboard: {
      enabled: true,
      onlyInViewport: true,
    },
    navigation: {
      nextEl: item.querySelector(".js-top-project-next"),
      prevEl: item.querySelector(".js-top-project-prev"),
    },
    breakpoints: {
      768: {
        spaceBetween: 45,
      },
    },
    on: {
      init: updateProjectCounter,
      slideChange: updateProjectCounter,
    },
  });
});

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

const homeEventSlider = document.querySelector(".js-home-event-slider");

if (homeEventSlider) {
  const eventSection = homeEventSlider.closest(".p-home-event");
  const eventSlides = homeEventSlider.querySelectorAll(".swiper-slide");
  const current = eventSection.querySelector(".js-home-event-current");
  const total = eventSection.querySelector(".js-home-event-total");

  const updateEventCounter = (swiper) => {
    current.textContent = String(swiper.realIndex + 1);
    total.textContent = String(eventSlides.length);
  };

  new Swiper(homeEventSlider, {
    slidesPerView: "auto",
    spaceBetween: 18,
    loop: eventSlides.length > 1,
    speed: 700,
    grabCursor: eventSlides.length > 1,
    watchOverflow: true,
    keyboard: {
      enabled: true,
      onlyInViewport: true,
    },
    navigation: {
      nextEl: eventSection.querySelector(".js-home-event-next"),
      prevEl: eventSection.querySelector(".js-home-event-prev"),
    },
    breakpoints: {
      768: {
        spaceBetween: 42,
      },
    },
    on: {
      init: updateEventCounter,
      slideChange: updateEventCounter,
    },
  });
}

const homeModelHouseSlider = document.querySelector(".js-home-model-house-slider");

if (homeModelHouseSlider) {
  const section = homeModelHouseSlider.closest(".p-home-model-house");
  const progressItems = Array.from(section.querySelectorAll(".p-home-model-house__progress-item"));
  const current = section.querySelector(".p-home-model-house__count-current");
  const total = section.querySelector(".p-home-model-house__count-total");
  const slides = Array.from(homeModelHouseSlider.querySelectorAll(".p-home-model-house__slide"));
  const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  let activeIndex = 0;
  let autoplayTimer = null;
  let pointerStartX = 0;

  const stopModelHouseAutoplay = () => {
    window.clearTimeout(autoplayTimer);
  };

  const startModelHouseAutoplay = () => {
    stopModelHouseAutoplay();

    if (!prefersReducedMotion) {
      autoplayTimer = window.setTimeout(() => {
        showModelHouseSlide(activeIndex + 1);
      }, 4500);
    }
  };

  const showModelHouseSlide = (nextIndex) => {
    activeIndex = (nextIndex + slides.length) % slides.length;
    current.textContent = String(activeIndex + 1);
    total.textContent = String(slides.length);

    slides.forEach((slide, index) => {
      const isActive = index === activeIndex;

      slide.classList.toggle("is-active", isActive);
      slide.setAttribute("aria-hidden", isActive ? "false" : "true");
    });

    progressItems.forEach((item, index) => {
      const isActive = index === activeIndex;

      item.classList.toggle("is-active", isActive);
      if (isActive) {
        item.setAttribute("aria-current", "true");
      } else {
        item.removeAttribute("aria-current");
      }
    });

    startModelHouseAutoplay();
  };

  progressItems.forEach((item, index) => {
    item.addEventListener("click", () => {
      showModelHouseSlide(index);
    });
  });

  homeModelHouseSlider.addEventListener("pointerdown", (event) => {
    pointerStartX = event.clientX;
  });

  homeModelHouseSlider.addEventListener("pointerup", (event) => {
    const distance = event.clientX - pointerStartX;

    if (Math.abs(distance) >= 40) {
      showModelHouseSlide(activeIndex + (distance < 0 ? 1 : -1));
    }
  });

  homeModelHouseSlider.addEventListener("keydown", (event) => {
    if (event.key === "ArrowRight" || event.key === "ArrowLeft") {
      event.preventDefault();
      showModelHouseSlide(activeIndex + (event.key === "ArrowRight" ? 1 : -1));
    }
  });

  showModelHouseSlide(0);
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

  const showPanel = (target, sourceButton = null) => {
    const matchedPanel = panels.find((panel) => panel.dataset.modularPanel === target);
    const activePanel = matchedPanel || panels.find((panel) => panel.dataset.modularPanel === "dummy");

    if (!matchedPanel && activePanel && sourceButton) {
      const planName = sourceButton.dataset.modularName || sourceButton.textContent.trim();
      const menuButton = sourceButton.closest(".p-modular__menu-row")?.querySelector(".p-modular__menu-button");
      const categoryName = menuButton ? menuButton.textContent.trim() : "規格住宅";

      activePanel.querySelectorAll("[data-modular-dummy-note]").forEach((note) => {
        note.textContent = `${planName}の暮らしを楽しむ、心地よい規格住宅。`;
      });
      activePanel.querySelectorAll("[data-modular-dummy-description]").forEach((description) => {
        description.textContent = `${categoryName}「${planName}」の特徴を活かしたダミープランです。暮らしやすい動線と、家族が自然に集まる空間をご提案します。`;
      });
      activePanel.querySelectorAll("[data-modular-dummy-image]").forEach((image) => {
        image.alt = `${categoryName} ${planName}の外観イメージ`;
      });
    }

    panels.forEach((panel) => {
      const isActive = panel === activePanel;

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
        const activeElement = document.activeElement;

        if (activeElement instanceof HTMLElement && modularRoot.contains(activeElement) && !row.contains(activeElement)) {
          activeElement.blur();
        }

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

      showPanel(button.dataset.modularTarget, button);

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
