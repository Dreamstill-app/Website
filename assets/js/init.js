// Lenis smooth scroll
const lenis = new Lenis({ duration: 1.4, easing: t => Math.min(1, 1.001 - Math.pow(2, -10 * t)), smooth: true });
function raf(time) { lenis.raf(time); requestAnimationFrame(raf); }
requestAnimationFrame(raf);

// Sync GSAP ScrollTrigger with Lenis
gsap.registerPlugin(ScrollTrigger);
lenis.on('scroll', ScrollTrigger.update);
gsap.ticker.add(time => lenis.raf(time * 1000));
gsap.ticker.lagSmoothing(0);

// Reveal animations — every element with data-reveal fades + slides up on scroll
document.querySelectorAll('[data-reveal]').forEach(el => {
  gsap.fromTo(el,
    { opacity: 0, y: 60 },
    { opacity: 1, y: 0, duration: 1.1, ease: 'power3.out',
      scrollTrigger: { trigger: el, start: 'top 85%', once: true }
    }
  );
});
