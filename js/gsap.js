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

function getRevealOffset(index, distance) {
  const offsets = [
    { x: 0, y: distance },
    { x: -distance, y: 0 },
    { x: distance, y: 0 },
  ];

  return offsets[index % offsets.length];
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
      },
    });

    timeline.fromTo(
      targets,
      {
        autoAlpha: 0,
        x: (index) => getRevealOffset(index, 20).x,
        y: (index) => getRevealOffset(index, 20).y,
      },
      {
        autoAlpha: 1,
        x: 0,
        y: 0,
        duration: 0.65,
        stagger: 0.1,
        ease: "power2.out",
        clearProps: "opacity,visibility,transform",
      }
    );
  });

  sections.forEach((section) => {
    const textTargets = Array.from(section.querySelectorAll(
      "h1, h2, h3, p, li, a.c-hover-invert"
    )).filter((target) => {
      return target.textContent.trim() !== ""
        && !target.closest(".swiper, .p-modular__menu, .p-works-modal, .p-contact-form__privacy")
        && !target.matches(".p-top-project__counter");
    });

    textTargets.forEach((target, index) => {
      const offset = getRevealOffset(index, 32);
      const timeline = gsap.timeline({
        scrollTrigger: {
          trigger: target,
          start: "top 90%",
        },
      });

      timeline.fromTo(
        target,
        {
          autoAlpha: 0,
          x: offset.x,
          y: offset.y,
        },
        {
          autoAlpha: 1,
          x: 0,
          y: 0,
          duration: 0.75,
          ease: "power3.out",
          clearProps: "opacity,visibility,transform",
        }
      );
    });
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

  const collageFigures = Array.from(document.querySelectorAll(".c-parallax--strong")).filter((figure) => {
    return !figure.closest(".p-image");
  });

  collageFigures.forEach((figure) => {
    const timeline = gsap.timeline({
      scrollTrigger: {
        trigger: figure,
        start: "top 90%",
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

  const footerGalleryFigures = document.querySelectorAll(".p-image .c-parallax--strong");

  footerGalleryFigures.forEach((figure, index) => {
    const offset = getRevealOffset(index, 36);
    const timeline = gsap.timeline({
      scrollTrigger: {
        trigger: figure,
        start: "top 90%",
      },
    });

    timeline.fromTo(
      figure,
      {
        autoAlpha: 0,
        x: offset.x,
        y: offset.y,
      },
      {
        autoAlpha: 1,
        x: 0,
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
