(function () {
  const slider = document.querySelector('[data-about-slider]');
  if (!slider) return;

  const slides = slider.querySelector('[data-about-slides]');
  const dots = Array.from(slider.querySelectorAll('[data-about-dot]'));
  let current = 0;
  let interval;

  const goTo = (index) => {
    current = index;
    slides.style.transform = `translateX(-${current * 100}%)`;
    dots.forEach((dot, i) => dot.classList.toggle('active', i === current));
  };

  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
      goTo(i);
      clearInterval(interval);
      interval = setInterval(() => goTo((current + 1) % dots.length), 6000);
    });
  });

  interval = setInterval(() => goTo((current + 1) % dots.length), 6000);
})();
