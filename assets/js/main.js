(function () {
  const toggle = document.querySelector("[data-nav-toggle]");
  const nav = document.querySelector("[data-nav-links]");

  if (toggle && nav) {
    toggle.addEventListener("click", () => {
      const isOpen = nav.classList.toggle("open");
      toggle.setAttribute("aria-expanded", String(isOpen));
    });
  }

  const slider = document.querySelector("[data-slider]");
  if (slider) {
    const slides = slider.querySelector("[data-slides]");
    const dots = Array.from(slider.querySelectorAll("[data-slide-dot]"));
    let current = 0;

    const goToSlide = (index) => {
      current = index;
      slides.style.transform = `translateX(-${current * 100}%)`;
      dots.forEach((dot, dotIndex) => {
        dot.classList.toggle("active", dotIndex === current);
        dot.setAttribute("aria-pressed", String(dotIndex === current));
      });
    };

    dots.forEach((dot, index) => {
      dot.addEventListener("click", () => goToSlide(index));
    });

    window.setInterval(() => {
      goToSlide((current + 1) % dots.length);
    }, 5200);
  }

  const contactForm = document.querySelector("[data-contact-form]");
  if (contactForm) {
    contactForm.addEventListener("submit", (event) => {
      event.preventDefault();

      const formData = new FormData(contactForm);
      const name = formData.get("name") || "there";
      const subject = encodeURIComponent(`DreamStill website inquiry from ${name}`);
      const body = encodeURIComponent(
        `Name: ${formData.get("name") || ""}\nEmail: ${formData.get("email") || ""}\nInterest: ${formData.get("interest") || ""}\n\n${formData.get("message") || ""}`
      );

      window.location.href = `mailto:info@dreamstill.ca?subject=${subject}&body=${body}`;
    });
  }
})();
