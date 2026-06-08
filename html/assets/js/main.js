(function () {
  const toggle = document.querySelector("[data-nav-toggle]");
  const nav = document.querySelector("[data-nav-links]");

  if (toggle && nav) {
    toggle.addEventListener("click", () => {
      const isOpen = nav.classList.toggle("open");
      toggle.setAttribute("aria-expanded", String(isOpen));
    });
  }

  const initSlider = (slider) => {
    const slides = slider.querySelector("[data-slides]");
    const dots = Array.from(slider.querySelectorAll("[data-slide-dot]"));
    if (!slides || !dots.length) return;

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
  };

  document.querySelectorAll("[data-slider]").forEach(initSlider);

  const interestRoutes = {
    "Sorty app pilot": { prefix: "[PILOT]", email: "info@dreamstill.ca" },
    "Request a pilot": { prefix: "[PILOT]", email: "info@dreamstill.ca" },
    "Corporate experience booking": { prefix: "[CORPORATE]", email: "info@dreamstill.ca" },
    "Circular fashion event": { prefix: "[EVENT]", email: "info@dreamstill.ca" },
    "Industry partnership": { prefix: "[PARTNERSHIP]", email: "info@dreamstill.ca" },
    "Investment or grant inquiry": { prefix: "[INVESTOR]", email: "info@dreamstill.ca" },
    "Media or speaking": { prefix: "[MEDIA]", email: "info@dreamstill.ca" },
    "General inquiry": { prefix: "[GENERAL]", email: "info@dreamstill.ca" },
  };

  const submitToFormBackend = async (form, successMessage) => {
    const formData = new FormData(form);
    const interest = formData.get("interest") || "General inquiry";
    const route = interestRoutes[interest] || interestRoutes["General inquiry"];
    const name = formData.get("name") || formData.get("email") || "Visitor";

    formData.set("_subject", `${route.prefix} DreamStill website inquiry from ${name}`);
    formData.set("_captcha", "false");
    formData.set("_template", "table");

    const response = await fetch("https://formsubmit.co/ajax/info@dreamstill.ca", {
      method: "POST",
      headers: { Accept: "application/json" },
      body: formData,
    });

    if (!response.ok) {
      throw new Error("Form submission failed");
    }

    form.reset();
    const existing = form.querySelector(".form-success");
    if (existing) existing.remove();

    const success = document.createElement("p");
    success.className = "form-success";
    success.textContent = successMessage;
    form.appendChild(success);
  };

  const contactForm = document.querySelector("[data-contact-form]");
  if (contactForm) {
    contactForm.addEventListener("submit", async (event) => {
      event.preventDefault();
      const button = contactForm.querySelector('[type="submit"]');
      if (button) button.disabled = true;

      try {
        await submitToFormBackend(
          contactForm,
          "Thank you! We received your message and will respond within 2 business days with an email to discuss next steps."
        );
      } catch {
        const formData = new FormData(contactForm);
        const name = formData.get("name") || "there";
        const subject = encodeURIComponent(`DreamStill website inquiry from ${name}`);
        const body = encodeURIComponent(
          `Name: ${formData.get("name") || ""}\nEmail: ${formData.get("email") || ""}\nInterest: ${formData.get("interest") || ""}\n\n${formData.get("message") || ""}`
        );
        window.location.href = `mailto:info@dreamstill.ca?subject=${subject}&body=${body}`;
      } finally {
        if (button) button.disabled = false;
      }
    });
  }

  document.querySelectorAll("[data-newsletter-form]").forEach((form) => {
    form.addEventListener("submit", async (event) => {
      event.preventDefault();
      const button = form.querySelector('[type="submit"]');
      if (button) button.disabled = true;

      const formData = new FormData(form);
      formData.set("_subject", "[NEWSLETTER] DreamStill mailing list signup");
      formData.set("_captcha", "false");
      formData.set("_template", "table");

      try {
        const response = await fetch("https://formsubmit.co/ajax/info@dreamstill.ca", {
          method: "POST",
          headers: { Accept: "application/json" },
          body: formData,
        });

        if (!response.ok) throw new Error("Newsletter signup failed");

        form.reset();
        const existing = form.querySelector(".form-success");
        if (existing) existing.remove();

        const success = document.createElement("p");
        success.className = "form-success";
        success.textContent = "You're on the list! We'll send updates on Sorty, events, and circular fashion news.";
        form.appendChild(success);
      } catch {
        window.location.href = `mailto:info@dreamstill.ca?subject=${encodeURIComponent("Newsletter signup")}&body=${encodeURIComponent(`Please add me to the DreamStill newsletter: ${formData.get("email")}`)}`;
      } finally {
        if (button) button.disabled = false;
      }
    });
  });

  document.querySelectorAll("[data-waitlist-form]").forEach((form) => {
    form.addEventListener("submit", async (event) => {
      event.preventDefault();
      const button = form.querySelector('[type="submit"]');
      if (button) button.disabled = true;

      const formData = new FormData(form);
      formData.set("_subject", "[WAITLIST] Sorty launch notification request");
      formData.set("_captcha", "false");
      formData.set("_template", "table");

      try {
        const response = await fetch("https://formsubmit.co/ajax/info@dreamstill.ca", {
          method: "POST",
          headers: { Accept: "application/json" },
          body: formData,
        });

        if (!response.ok) throw new Error("Waitlist signup failed");

        form.reset();
        const existing = form.querySelector(".form-success");
        if (existing) existing.remove();

        const success = document.createElement("p");
        success.className = "form-success";
        success.textContent = "You're on the waitlist! We'll notify you when Sorty launches.";
        form.appendChild(success);
      } catch {
        window.location.href = `mailto:info@dreamstill.ca?subject=${encodeURIComponent("Sorty waitlist")}&body=${encodeURIComponent(`Notify me at launch: ${formData.get("email")}`)}`;
      } finally {
        if (button) button.disabled = false;
      }
    });
  });

  document.querySelectorAll("[data-corporate-form]").forEach((form) => {
    form.addEventListener("submit", async (event) => {
      event.preventDefault();
      const button = form.querySelector('[type="submit"]');
      if (button) button.disabled = true;

      try {
        await submitToFormBackend(
          form,
          "Thank you! Our experiences team will respond within 2 business days to schedule a discovery call or send a proposal."
        );
      } catch {
        const formData = new FormData(form);
        window.location.href = `mailto:info@dreamstill.ca?subject=${encodeURIComponent("Corporate experience inquiry")}&body=${encodeURIComponent(
          `Name: ${formData.get("name")}\nEmail: ${formData.get("email")}\nCompany: ${formData.get("company")}\nTeam size: ${formData.get("team-size")}\n\n${formData.get("message")}`
        )}`;
      } finally {
        if (button) button.disabled = false;
      }
    });
  });
})();
