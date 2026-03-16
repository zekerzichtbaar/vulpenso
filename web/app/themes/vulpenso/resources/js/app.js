import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import collapse from '@alpinejs/collapse';

// Initialize Alpine.js plugins before DOM loads
Alpine.plugin(collapse);

// Make Alpine available globally for Livewire
window.Alpine = Alpine;

/**
 * Application entrypoint
 */
document.addEventListener('DOMContentLoaded', async () => {

  // WHATSAPP MODAL
  const { initWhatsAppModal } = await import('./whatsappModal');
  initWhatsAppModal();

  // LORDICON (lazy load lottie)
  if (document.querySelector('lord-icon')) {
    const [lottie, { defineElement }] = await Promise.all([
      import('lottie-web/build/player/lottie_light'),
      import('@lordicon/element'),
    ]);
    defineElement(lottie.default.loadAnimation);

    // Loop op touch devices i.p.v. hover
    const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    if (isTouchDevice) {
      document.querySelectorAll('lord-icon[data-icon-mobile-loop]').forEach(icon => {
        icon.setAttribute('trigger', 'loop');
        icon.setAttribute('delay', '3000');
        icon.removeAttribute('target');
      });
    }
  }

  // POST SLIDER
  if (document.querySelector('.post-slider')) {
    const { initPostSlider } = await import('./postSlider');
    initPostSlider();
  }

  // CTA SLIDER
  if (document.querySelector('.cta-slider')) {
    const { initCTASlider } = await import('./ctaSlider');
    initCTASlider();
  }

  // RESP SLIDER
  if (document.querySelector('.resp-slider')) {
    const $ = (await import('jquery')).default;
    const { initRespSlider } = await import('./respSlider');
    initRespSlider($);
  }

  // MOBILE MENU
  if (document.querySelector('.hamburger')) {
    const $ = (await import('jquery')).default;
    const { initMobileMenu } = await import('./mobileMenu');
    initMobileMenu($);
  }

  // SCROLL ANIMATIONS
  const { initScrollAnimations } = await import('./scrollAnimations');
  initScrollAnimations();

  // MARQUEE
  if (document.querySelector('[data-marquee]')) {
    const { initMarquee } = await import('./marquee');
    initMarquee();
  }

  // MOMENTUM HOVER (Employee cards)
  if (document.querySelector('[data-momentum-hover-init]')) {
    const { initMomentumHover } = await import('./momentumHover');
    initMomentumHover();
  }

  // PRICES NAV
  if (document.querySelector('[data-prices-nav-link]')) {
    const { initPricesNav } = await import('./pricesNav');
    initPricesNav();
  }

  // SCROLLABLE TEXT
  if (document.querySelector('[data-scrollable-text]')) {
    const { initScrollableText } = await import('./scrollableText');
    initScrollableText();
  }

  // ROTATING TEXT
  if (document.querySelector('[data-rotating-title]')) {
    const { initRotatingText } = await import('./rotatingText');
    initRotatingText();
  }

  // SERVICE MENU
  if (document.querySelector('[data-service-menu]')) {
    const { initServiceMenu } = await import('./serviceMenu');
    initServiceMenu();
  }

  // DIRECTIONAL HOVER
  if (document.querySelector('[data-directional-hover]')) {
    const { initDirectionalHover } = await import('./directionalHover');
    initDirectionalHover();
  }

  // Start Livewire (which also starts Alpine.js)
  Livewire.start();

});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
