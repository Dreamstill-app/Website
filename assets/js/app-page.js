(function () {
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

  const section = document.querySelector('.phone-scroll-section');
  const phone = document.querySelector('.phone-mockup-wrapper');
  const slides = document.querySelector('.app-screen-slides');

  if (!section || !phone || !slides) return;

  gsap.set(phone, { y: 200 });

  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: section,
      start: 'top top',
      end: 'bottom bottom',
      scrub: true,
      pin: '.phone-pin-wrapper',
      anticipatePin: 1
    }
  });

  tl.to(phone, { y: 0, ease: 'power3.out', duration: 0.3 }, 0);
  tl.to(slides, { x: '-66.66%', ease: 'none', duration: 1 }, 0.1);

  const banner = document.querySelector('.status-banner');
  if (banner) {
    gsap.fromTo(banner,
      { opacity: 0, y: 30 },
      { opacity: 1, y: 0, duration: 1, ease: 'power3.out', delay: 0.2 }
    );
  }
})();
