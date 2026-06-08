(function () {
  if (typeof gsap === 'undefined') return;

  const missionQuote = document.querySelector('.mission-quote');
  const missionBody = document.querySelector('.mission-body');
  if (missionQuote) {
    gsap.fromTo(missionQuote,
      { y: '100%' },
      { y: '0%', duration: 1.2, ease: 'power3.out',
        scrollTrigger: { trigger: '.mission-section', start: 'top 75%', once: true }
      }
    );
  }
  if (missionBody) {
    gsap.fromTo(missionBody,
      { y: '100%', opacity: 0 },
      { y: '0%', opacity: 1, duration: 1.1, ease: 'power3.out', delay: 0.2,
        scrollTrigger: { trigger: '.mission-section', start: 'top 70%', once: true }
      }
    );
  }

  document.querySelectorAll('[data-count]').forEach(el => {
    const target = parseInt(el.dataset.count, 10);
    const suffix = el.dataset.suffix || '';
    const obj = { val: 0 };
    gsap.to(obj, {
      val: target,
      duration: 2,
      ease: 'power3.out',
      scrollTrigger: { trigger: el, start: 'top 85%', once: true },
      onUpdate: () => {
        const display = Math.round(obj.val).toLocaleString();
        el.textContent = display + suffix;
      }
    });
  });
})();
