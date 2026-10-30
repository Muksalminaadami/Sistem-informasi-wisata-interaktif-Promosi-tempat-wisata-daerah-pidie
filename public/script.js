(() => {
  "use strict";

  const section = document.querySelector(".cinema-scroll");
  const root = document.documentElement;
  const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
  const sightsTrack = document.querySelector(".sights-track");
  const sightsControls = document.querySelector(".sights-controls");
  const prevButton = document.querySelector(".sight-prev");
  const nextButton = document.querySelector(".sight-next");
  const stage = document.querySelector(".stage");
  const heroTitle = document.querySelector(".hero-title");
  const introCopy = document.querySelector(".intro-copy");
  const navLinks = Array.from(document.querySelectorAll(".site-nav a"));
  const mobileQuery = window.matchMedia("(max-width: 640px)");
  const heroTagButtons = Array.from(document.querySelectorAll(".hero-tags button"));
  const bazaarPanel = document.querySelector(".story-panel-bazaar");
  const noteButton = document.querySelector(".note-button");
  const languageButton = document.querySelector(".language-switcher");
  const languageList = document.querySelector(".language-list");

  // Elemen Login Admin Tersembunyi
  const adminOverlay = document.getElementById("adminModalOverlay");
  const adminCloseBtn = document.getElementById("adminModalClose");

  const NAV_BREAKS = [
    { href: "#cinema", from: 0 },
    { href: "#bridge", from: 700 },
    { href: "#bazaar", from: 1720 },
    { href: "#routes", from: 3020 },
  ];
  let currentNav = "";

  const NAV_TARGETS = { "#cinema": 0, "#bridge": 1100, "#bazaar": 2340, "#routes": 3700 };

  let targetMouseX = 0;
  let targetMouseY = 0;
  let mouseX = 0;
  let mouseY = 0;
  let targetScroll = 0;
  let smoothScroll = 0;
  let initialized = false;
  let rafPending = false;
  
  let sightCards = Array.from(document.querySelectorAll(".sight-card"));
  let activeSight = 0;

  const clamp = (v, min = 0, max = 1) => Math.min(max, Math.max(min, v));

  const smoothstep = (e0, e1, v) => {
    const x = clamp((v - e0) / (e1 - e0));
    return x * x * (3 - 2 * x);
  };

  const lerp = (a, b, t) => a + (b - a) * t;

  const segmentInOut = (s, a, b, c, d) => {
    const enter = smoothstep(a, b, s);
    const exit = smoothstep(c, d, s);
    return { enter, exit, active: enter * (1 - exit) };
  };

  const getScrollDistance = () =>
    clamp(-section.getBoundingClientRect().top, 0, section.offsetHeight - window.innerHeight);

  const setVar = (name, value) => root.style.setProperty(name, String(value));

  const setInert = (el, value) => {
    if (el && el.inert !== value) el.inert = value;
  };

  function setCurrentNav(scroll) {
    let href = NAV_BREAKS[0].href;
    NAV_BREAKS.forEach((item) => {
      if (scroll >= item.from) href = item.href;
    });
    if (href === currentNav) return;
    currentNav = href;
    navLinks.forEach((link) => {
      const isCurrent = link.getAttribute("href") === href;
      link.classList.toggle("is-current", isCurrent);
      if (isCurrent) link.setAttribute("aria-current", "true");
      else link.removeAttribute("aria-current");
    });
  }

  function scrollToOffset(offset) {
    const top = section.getBoundingClientRect().top + window.scrollY + offset;
    window.scrollTo({ top, behavior: reduceMotion.matches ? "auto" : "smooth" });
  }

  function update() {
    rafPending = false;

    targetScroll = getScrollDistance();
    if (!initialized || reduceMotion.matches) {
      smoothScroll = targetScroll;
      initialized = true;
    } else {
      smoothScroll = lerp(smoothScroll, targetScroll, 0.14);
    }
    if (Math.abs(smoothScroll - targetScroll) < 0.08) smoothScroll = targetScroll;

    if (reduceMotion.matches) {
      mouseX = 0;
      mouseY = 0;
    } else {
      mouseX = lerp(mouseX, targetMouseX, 0.12);
      mouseY = lerp(mouseY, targetMouseY, 0.12);
    }

    const frame2 = segmentInOut(smoothScroll, 560, 900, 1300, 1620);
    const frame3 = segmentInOut(smoothScroll, 1760, 2140, 2540, 2700);
    const progress = clamp(smoothScroll / 2700);
    const introExit = smoothstep(90, 650, smoothScroll);
    const sightsEnterRaw = smoothstep(2760, 3560, smoothScroll);
    const sightsEnter = Math.pow(sightsEnterRaw, 1.55);
    const sightsControlsEnter = smoothstep(3360, 3660, smoothScroll);
    const blurActive = clamp(frame2.active + frame3.active);
    const frame2Opacity = frame2.active * (1 - frame3.enter);
    const splitDrift = Math.pow(frame2.enter, 1.5);
    const panel2Opacity = frame2.active * (1 - frame2.exit);
    const panel3Opacity = frame3.active * (1 - frame3.exit);
    const backScale = 0.76 + progress * 0.2 + frame2.enter * 0.18 + frame3.enter * 0.16;
    const sharedHeroY = progress * -74;
    const sharedHeroScale = progress * 0.23;
    const stageH = stage.clientHeight || window.innerHeight;

    const headerSafe = mobileQuery.matches ? 124 : 100;
    const sightsScreenTop = Math.max(
      headerSafe,
      Math.min(220, Math.max(112, stageH * 0.19)) - 16
    );

    const sightsParentTop = stageH - (stageH - sightsScreenTop) / backScale;

    setVar("--mx", reduceMotion.matches ? 0 : mouseX.toFixed(4));
    setVar("--my", reduceMotion.matches ? 0 : mouseY.toFixed(4));

    setVar("--back-opacity", (1 - frame2.active * 0.06).toFixed(4));
    setVar("--back-x", `${(mouseX * -12).toFixed(3)}px`);
    setVar("--back-y", `${(mouseY * -4).toFixed(3)}px`);
    setVar("--back-scale", backScale.toFixed(4));
    setVar("--four-y", `${(10 + progress * 10).toFixed(3)}vh`);
    setVar("--four-scale", (0.78 + progress * 0.16).toFixed(4));
    setVar("--bazaar-y", `${(20 - progress * 8).toFixed(3)}vh`);
    setVar("--blur-px", `${(blurActive * 14).toFixed(3)}px`);
    setVar("--back-brightness", (1 - blurActive * 0.255).toFixed(4));
    setVar("--bazaar-blur-px", `${(frame2.active * 14).toFixed(3)}px`);
    setVar("--bazaar-brightness", (1 - frame2.active * 0.255 - frame3.active * 0.06).toFixed(4));
    setVar("--bazaar-saturation", (1 + frame3.active * 0.18).toFixed(4));

    setVar("--shade-opacity", "1");
    setVar("--shade-z", frame2.active > 0.02 ? "2" : "0");
    setVar("--shade-top-alpha", (blurActive * 0.465).toFixed(4));
    setVar("--shade-mid-alpha", (blurActive * 0.42).toFixed(4));
    setVar("--shade-bottom-alpha", (blurActive * 0.51).toFixed(4));

    setVar("--title-y", `${(introExit * -210).toFixed(3)}px`);
    setVar("--title-scale", (1 - introExit * 0.08).toFixed(4));
    setVar("--title-opacity", (1 - introExit).toFixed(4));

    setVar("--bridge-x", `calc(-50% + ${(mouseX * 18).toFixed(3)}px)`);
    setVar("--bridge-y", `${(mouseY * 8 + sharedHeroY - frame2.exit * 760).toFixed(3)}px`);
    setVar("--bridge-bottom", `${(5 - frame2.enter * 13).toFixed(3)}vh`);
    setVar("--bridge-width", `${(67.2 + frame2.enter * 37.8).toFixed(3)}vw`);
    setVar("--bridge-scale", (1.02 + sharedHeroScale + frame2.exit * 0.46).toFixed(4));

    setVar("--split-left-x", `calc(-50% + ${(-splitDrift * 46).toFixed(3)}vw + ${(mouseX * 22).toFixed(3)}px)`);
    setVar("--split-left-y", `${(mouseY * 10 + sharedHeroY - splitDrift * 180).toFixed(3)}px`);
    setVar("--split-left-scale", (1 + sharedHeroScale + frame2.enter * 0.74).toFixed(4));
    setVar("--split-right-x", `calc(-50% + ${(splitDrift * 46).toFixed(3)}vw + ${(mouseX * 22).toFixed(3)}px)`);
    setVar("--split-right-y", `${(mouseY * 10 + sharedHeroY - splitDrift * 180).toFixed(3)}px`);
    setVar("--split-right-scale", (1 + sharedHeroScale + frame2.enter * 0.74).toFixed(4));

    setVar("--frame2-opacity", frame2Opacity.toFixed(4));
    setVar("--frame2-x", `calc(-50% + ${(mouseX * 10).toFixed(3)}px)`);
    setVar("--frame2-y", `calc(-50% + ${(mouseY * 8 - frame2.exit * 150).toFixed(3)}px)`);
    setVar("--frame2-scale", (1.06 + frame2.enter * 0.08 + frame2.exit * 0.08).toFixed(4));

    setVar("--intro-copy-y", `${(introExit * 90).toFixed(3)}px`);
    setVar("--intro-copy-opacity", (1 - introExit).toFixed(4));
    setVar("--panel2-opacity", panel2Opacity.toFixed(4));
    setVar("--panel2-y", `calc(-50% + ${(-frame2.exit * 86 + (1 - frame2.enter) * 58).toFixed(3)}px)`);
    setVar("--panel3-opacity", panel3Opacity.toFixed(4));
    setVar("--panel3-y", `calc(-50% + ${(-frame3.exit * 86 + (1 - frame3.enter) * 58).toFixed(3)}px)`);

    setVar("--sights-opacity", sightsEnter.toFixed(4));
    setVar("--sights-controls-opacity", sightsControlsEnter.toFixed(4));
    sightsControls.classList.toggle("is-ready", sightsControlsEnter > 0.98);
    setInert(sightsControls, sightsControlsEnter <= 0.98);
    setInert(introCopy, introExit > 0.5);
    setInert(bazaarPanel, panel3Opacity < 0.5);
    setCurrentNav(smoothScroll);
    setVar("--sights-visibility", sightsEnter > 0.01 ? "visible" : "hidden");
    setVar("--sights-y", "0px");
    setVar("--sights-enter-x", `${((1 - sightsEnter) * 420).toFixed(3)}vw`);
    setVar("--sights-scale", (1 / backScale).toFixed(5));
    setVar("--sights-top", `${sightsParentTop.toFixed(3)}px`);
    setVar("--sights-screen-top", `${sightsScreenTop.toFixed(3)}px`);

    if (
      Math.abs(smoothScroll - targetScroll) > 0.08 ||
      (!reduceMotion.matches &&
        (Math.abs(mouseX - targetMouseX) > 0.001 ||
          Math.abs(mouseY - targetMouseY) > 0.001))
    ) {
      requestTick();
    }
  }

  function requestTick() {
    if (rafPending) return;
    rafPending = true;
    requestAnimationFrame(update);
  }

  function setupSightSlider() {
    sightCards.forEach((card, index) => {
      const descElement = card.querySelector(".sight-desc");
      const originalText = descElement ? descElement.textContent : "";
      const detailedDesc = card.dataset.description || originalText;
      const descToggleBtn = card.querySelector(".desc-toggle-action");
      const mapBtn = card.querySelector(".map-action");

      if (descToggleBtn) {
        descToggleBtn.addEventListener("click", (event) => {
          event.stopPropagation();
          const isExpanded = card.classList.toggle("is-expanded");
          if (isExpanded) {
            if (descElement) descElement.textContent = detailedDesc;
            descToggleBtn.innerHTML = `<svg class="icon" aria-hidden="true"><use href="#i-compass" /></svg>Tutup`;
          } else {
            if (descElement) descElement.textContent = originalText;
            descToggleBtn.innerHTML = `<svg class="icon" aria-hidden="true"><use href="#i-compass" /></svg>Lihat Deskripsi`;
          }
        });
      }

      if (mapBtn) {
        mapBtn.addEventListener("click", (event) => {
          event.stopPropagation();
          const destination = card.dataset.destination || card.querySelector("h3")?.textContent || "Indonesia";
          const mapUrl = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(destination)}`;
          window.open(mapUrl, "_blank");
        });
      }

      card.addEventListener("click", (event) => {
        event.stopPropagation();
        focusSight(index);
      });

      if (descElement) card.dataset.originalText = originalText;
    });

    updateSightSlider();
  }

  function updateSightSlider() {
    if (!sightCards.length) return;
    const cardWidth = sightCards[0].offsetWidth;
    const gap = parseFloat(getComputedStyle(sightsTrack).columnGap || "0") || 0;

    const containerWidth = sightsTrack.parentElement.clientWidth;
    const paddingLeft = parseFloat(getComputedStyle(sightsTrack.parentElement).paddingLeft) || 0;
    const centerOffset = paddingLeft + ((containerWidth - (paddingLeft * 2) - cardWidth) / 2);

    const shift = centerOffset - paddingLeft - (cardWidth + gap) * activeSight;
    setVar("--sights-shift", `${shift}px`);

    sightCards.forEach((card, idx) => {
      card.classList.toggle("is-active", idx === activeSight);
    });
  }

  function moveSightSlider(direction) {
    activeSight += direction;
    if (activeSight < 0) {
      activeSight = sightCards.length - 1;
    } else if (activeSight >= sightCards.length) {
      activeSight = 0;
    }
    updateSightSlider();
  }

  function focusSight(index) {
    activeSight = clamp(index, 0, sightCards.length - 1);
    updateSightSlider();
  }

  let titleFitPending = false;

  function fitHeroTitle() {
    titleFitPending = false;
    heroTitle.style.fontSize = "";
    heroTitle.classList.toggle("is-multiword", /\s/.test(heroTitle.textContent.trim()));

    let size = parseFloat(getComputedStyle(heroTitle).fontSize);
    if (!size) return;

    for (let i = 0; i < 30 && size > 28; i += 1) {
      const tooWide = heroTitle.scrollWidth > heroTitle.clientWidth + 1;
      const tooTall = heroTitle.offsetTop + heroTitle.offsetHeight > introCopy.offsetTop - 16;
      if (!tooWide && !tooTall) break;
      size *= 0.94;
      heroTitle.style.fontSize = `${size.toFixed(2)}px`;
    }
  }

  function scheduleTitleFit() {
    if (titleFitPending) return;
    titleFitPending = true;
    requestAnimationFrame(fitHeroTitle);
  }

  /* --- LOGIKA PINTU RAHASIA / DETEKSI URL MODAL ADMIN --- */

  function checkAdminRoute() {
    const hash = window.location.hash.toLowerCase();
    const path = window.location.pathname.toLowerCase();
    
    if (hash === "#admin" || path.endsWith("/admin")) {
      if (adminOverlay) {
        adminOverlay.classList.add("is-open");
        adminOverlay.setAttribute("aria-hidden", "false");
      }
    } else {
      if (adminOverlay) {
        adminOverlay.classList.remove("is-open");
        adminOverlay.setAttribute("aria-hidden", "true");
      }
    }
  }

  if (adminCloseBtn) {
    adminCloseBtn.addEventListener("click", () => {
      adminOverlay.classList.remove("is-open");
      adminOverlay.setAttribute("aria-hidden", "true");
      if (window.location.hash === "#admin") {
        history.pushState("", document.title, window.location.pathname + window.location.search);
      }
    });
  }

  window.addEventListener("hashchange", checkAdminRoute);
  window.addEventListener("load", checkAdminRoute);

  window.addEventListener("scroll", requestTick, { passive: true });

  window.addEventListener("resize", () => {
    updateSightSlider();
    scheduleTitleFit();
    requestTick();
  });

  window.addEventListener(
    "pointermove",
    (event) => {
      if (event.pointerType === "touch") {
        targetMouseX = 0;
        targetMouseY = 0;
      } else {
        targetMouseX = event.clientX / window.innerWidth - 0.5;
        targetMouseY = event.clientY / window.innerHeight - 0.5;
      }
      requestTick();
    },
    { passive: true }
  );

  const resetPointer = () => {
    targetMouseX = 0;
    targetMouseY = 0;
    requestTick();
  };
  document.documentElement.addEventListener("mouseleave", resetPointer);
  window.addEventListener("blur", resetPointer);

  prevButton.addEventListener("click", () => moveSightSlider(-1));
  nextButton.addEventListener("click", () => moveSightSlider(1));

  navLinks.forEach((link) => {
    link.addEventListener("click", (event) => {
      const offset = NAV_TARGETS[link.getAttribute("href")];
      if (offset === undefined) return;
      event.preventDefault();
      scrollToOffset(offset);
    });
  });

  heroTagButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const index = Number(button.dataset.sight);
      if (Number.isFinite(index)) focusSight(index);
      scrollToOffset(NAV_TARGETS["#routes"]);
    });
  });

  noteButton.addEventListener("click", () => scrollToOffset(NAV_TARGETS["#routes"]));

  function setLanguageMenu(open) {
    languageList.hidden = !open;
    languageButton.setAttribute("aria-expanded", String(open));
  }

  languageButton.addEventListener("click", (event) => {
    event.stopPropagation();
    setLanguageMenu(languageList.hidden);
  });

  languageList.addEventListener("click", (event) => {
    if (event.target.closest(".language-option:not(:disabled)")) {
      setLanguageMenu(false);
      languageButton.focus();
    }
  });

  document.addEventListener("click", (event) => {
    if (!event.target.closest(".language-menu")) setLanguageMenu(false);
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && !languageList.hidden) {
      setLanguageMenu(false);
      languageButton.focus();
    }
  });

  mobileQuery.addEventListener?.("change", updateSightSlider);

  setupSightSlider();
  requestTick();

  window.addEventListener("load", () => {
    updateSightSlider();
    fitHeroTitle();
    requestTick();
  });

  fitHeroTitle();
  if (document.fonts) {
    document.fonts.ready.then(fitHeroTitle);
    document.fonts.addEventListener?.("loadingdone", scheduleTitleFit);
  }
})();