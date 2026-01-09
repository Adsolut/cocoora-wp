/**
 * Cocoora Theme - Main JavaScript Entry Point
 *
 * This file initializes all JavaScript components for the theme.
 */

// Import Alpine.js for reactive components
import Alpine from 'alpinejs';

// Import component modules
import { initMobileMenu } from './components/mobile-menu.js';
import { initSmoothScroll } from './components/smooth-scroll.js';
import { initAnimations } from './components/animations.js';

// Initialize Alpine.js
window.Alpine = Alpine;

// Register Alpine components
Alpine.data('mobileMenu', () => ({
  open: false,
  toggle() {
    this.open = !this.open;
  },
  close() {
    this.open = false;
  }
}));

Alpine.data('accordion', () => ({
  active: null,
  toggle(index) {
    this.active = this.active === index ? null : index;
  },
  isOpen(index) {
    return this.active === index;
  }
}));

// Start Alpine
Alpine.start();

// Initialize components when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  initMobileMenu();
  initSmoothScroll();
  initAnimations();

  console.log('Cocoora theme initialized');
});
