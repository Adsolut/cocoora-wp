/**
 * Animations Component
 *
 * Handles scroll-triggered animations using Intersection Observer.
 */

export function initAnimations() {
  // Elements to animate on scroll
  const animatedElements = document.querySelectorAll('[data-animate]');

  if (!animatedElements.length) return;

  // Intersection Observer for scroll animations
  const observerOptions = {
    root: null,
    rootMargin: '0px 0px -10% 0px',
    threshold: 0.1
  };

  const animationObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const animationType = entry.target.dataset.animate || 'fade-in';
        entry.target.classList.add('animated', animationType);

        // Optional: unobserve after animation
        if (!entry.target.dataset.animateRepeat) {
          animationObserver.unobserve(entry.target);
        }
      } else if (entry.target.dataset.animateRepeat) {
        // Remove animation class if element should re-animate
        entry.target.classList.remove('animated', entry.target.dataset.animate);
      }
    });
  }, observerOptions);

  // Observe all animated elements
  animatedElements.forEach((element) => {
    animationObserver.observe(element);
  });
}

// CSS for animations should be defined in main.css
// Example classes: fade-in, slide-up, slide-left, slide-right, scale-in
