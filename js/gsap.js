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
  });

  window.addEventListener("load", () => ScrollTrigger.refresh(), { once: true });
}

window.addEventListener("DOMContentLoaded", initScrollAnimations);
