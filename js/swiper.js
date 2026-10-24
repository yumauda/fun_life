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
    const slideCount = slider.querySelectorAll(".swiper-slide").length;
    const swiper = new Swiper(slider, {
      slidesPerView: 1,
      loop: slideCount > 1,
      loopedSlides: slideCount,
      loopAdditionalSlides: slideCount,
      speed: 700,
      spaceBetween: 24,
      allowTouchMove: true,
      grabCursor: true,
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

  const menuButtons = Array.from(modularRoot.querySelectorAll(".p-modular__menu-title"));
  const panels = Array.from(modularRoot.querySelectorAll(".p-modular__panel"));
  const showPanel = (target) => {
    const activePanel = panels.find((panel) => panel.dataset.modularPanel === target);

    if (!activePanel) return;

    panels.forEach((panel) => {
      const isActive = panel === activePanel;

      panel.classList.toggle("is-active", isActive);
      panel.setAttribute("aria-hidden", String(!isActive));
    });

    menuButtons.forEach((button) => {
      const isActive = button.dataset.modularTarget === target;

      button.classList.toggle("is-active", isActive);
      button.setAttribute("aria-selected", String(isActive));
      button.tabIndex = isActive ? 0 : -1;
    });

    modularSwipers.forEach((item) => {
      item.instance.update();
    });

    requestAnimationFrame(() => {
      const activeSwiper = modularSwipers.find((item) => activePanel && activePanel.contains(item.element));

      if (activeSwiper) {
        activeSwiper.instance.update();
        activeSwiper.instance.slideToLoop(0, 0, false);
      }
    });
  };

  menuButtons.forEach((button) => {
    const activate = () => showPanel(button.dataset.modularTarget);

    button.addEventListener("mouseenter", activate);
    button.addEventListener("focus", activate);
    button.addEventListener("click", activate);
    button.addEventListener("keydown", (event) => {
      const currentIndex = menuButtons.indexOf(button);
      let nextIndex = currentIndex;

      if (event.key === "ArrowDown" || event.key === "ArrowRight") {
        nextIndex = (currentIndex + 1) % menuButtons.length;
      } else if (event.key === "ArrowUp" || event.key === "ArrowLeft") {
        nextIndex = (currentIndex - 1 + menuButtons.length) % menuButtons.length;
      } else if (event.key === "Home") {
        nextIndex = 0;
      } else if (event.key === "End") {
        nextIndex = menuButtons.length - 1;
      } else {
        return;
      }

      event.preventDefault();
      menuButtons[nextIndex].focus();
    });
  });
}
