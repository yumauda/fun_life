"use strict";

function getSectionRevealTargets(section) {
  const targets = [];

  Array.from(section.children).forEach((child) => {
    if (child.classList.contains("l-inner")) {
      targets.push(...Array.from(child.children));
      return;
    }

    targets.push(child);
  });

  return targets.filter((target) => {
    return !target.matches("script, style, dialog, [hidden]")
      && !target.closest(".p-works-modal");
  });
}

function initScrollAnimations() {
  if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") return;

  gsap.registerPlugin(ScrollTrigger);

  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  const sections = Array.from(document.querySelectorAll("main section")).filter((section) => {
    return !section.parentElement.closest("section") && !section.closest(".p-works-modal");
  });

  sections.forEach((section) => {
    const targets = getSectionRevealTargets(section);

    if (targets.length === 0) return;

    const timeline = gsap.timeline({
      scrollTrigger: {
        trigger: section,
        start: "top 86%",
        once: true,
      },
    });

    timeline.fromTo(
      targets,
      {
        autoAlpha: 0,
        y: 20,
      },
      {
        autoAlpha: 1,
        y: 0,
        duration: 0.65,
        stagger: 0.1,
        ease: "power2.out",
        clearProps: "opacity,visibility,transform",
      }
    );
  });

  const textTargets = Array.from(document.querySelectorAll(
    "main section h1, main section h2, main section h3, main section p, main section li, main section a.c-hover-invert"
  )).filter((target) => {
    return target.textContent.trim() !== ""
      && !target.closest(".swiper, .p-modular__menu, .p-works-modal")
      && !target.matches(".p-top-project__counter");
  });

  textTargets.forEach((target) => {
    const timeline = gsap.timeline({
      scrollTrigger: {
        trigger: target,
        start: "top 90%",
        once: true,
      },
    });

    timeline.fromTo(
      target,
      {
        autoAlpha: 0,
        y: 32,
      },
      {
        autoAlpha: 1,
        y: 0,
        duration: 0.75,
        ease: "power3.out",
        clearProps: "opacity,visibility,transform",
      }
    );
  });

  const imageFigures = Array.from(document.querySelectorAll("main section figure")).filter((figure) => {
    const bounds = figure.getBoundingClientRect();

    return bounds.width >= 240
      && bounds.height >= 140
      && !figure.closest(".swiper, .p-works-modal, .p-top-contact");
  });

  imageFigures.forEach((figure) => {
    const image = figure.querySelector("img");

    if (!image) return;

    const timeline = gsap.timeline({
      scrollTrigger: {
        trigger: figure,
        start: "top 90%",
        once: true,
      },
    });

    timeline.fromTo(
      figure,
      {
        clipPath: "inset(0 100% 0 0)",
      },
      {
        clipPath: "inset(0 0% 0 0)",
        duration: 0.9,
        ease: "power3.inOut",
        clearProps: "clipPath",
      }
    );

    if (!figure.classList.contains("js-parallax")) {
      timeline.fromTo(
        image,
        {
          scale: 1.04,
        },
        {
          scale: 1,
          duration: 1.1,
          ease: "power2.out",
          clearProps: "transform",
        },
        "<"
      );
    }
  });

  const collageFigures = document.querySelectorAll(".c-parallax--strong");

  collageFigures.forEach((figure) => {
    const timeline = gsap.timeline({
      scrollTrigger: {
        trigger: figure,
        start: "top 90%",
        once: true,
      },
    });

    timeline.fromTo(
      figure,
      {
        autoAlpha: 0,
        y: 36,
      },
      {
        autoAlpha: 1,
        y: 0,
        duration: 0.85,
        ease: "power3.out",
        clearProps: "opacity,visibility,transform",
      }
    );
  });

  const parallaxFigures = document.querySelectorAll(".js-parallax");

  parallaxFigures.forEach((figure) => {
    const image = figure.querySelector("img");
    const isStrongParallax = figure.classList.contains("c-parallax--strong");

    if (!image) return;

    const getParallaxDistance = () => {
      const configuredDistance = isStrongParallax
        ? (window.matchMedia("(min-width: 768px)").matches ? 100 : 72)
        : 60;
      const availableDistance = Math.max(0, image.offsetHeight - figure.clientHeight);

      return availableDistance > 0
        ? Math.min(configuredDistance, availableDistance)
        : configuredDistance;
    };

    gsap.fromTo(
      image,
      {
        y: () => -getParallaxDistance(),
      },
      {
        y: 0,
        duration: 1,
        ease: "power2.inOut",
        scrollTrigger: {
          trigger: figure,
          start: "top bottom",
          end: "bottom top",
          scrub: true,
          invalidateOnRefresh: true,
        },
      }
    );
  });

  window.addEventListener("load", () => ScrollTrigger.refresh(), { once: true });
}

window.addEventListener("DOMContentLoaded", initScrollAnimations);
