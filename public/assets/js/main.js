(() => {
  const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");

  const navToggle = document.querySelector("[data-nav-toggle]");
  const navLinks = document.querySelector("[data-nav-links]");

  if (navToggle && navLinks) {
    navToggle.addEventListener("click", () => {
      const expanded = navToggle.getAttribute("aria-expanded") === "true";
      navToggle.setAttribute("aria-expanded", String(!expanded));
      navLinks.classList.toggle("open");
    });
  }

  document.querySelectorAll("[data-slider]").forEach((slider) => {
    const slides = slider.querySelector("[data-slides]");
    const dots = Array.from(slider.querySelectorAll("[data-slide-dot]"));

    if (!slides || dots.length === 0) return;

    let index = 0;
    let intervalId = null;

    const render = () => {
      slides.style.transform = `translateX(-${index * 100}%)`;
      dots.forEach((dot, dotIndex) => {
        const active = dotIndex === index;
        dot.classList.toggle("active", active);
        dot.setAttribute("aria-pressed", String(active));
      });
    };

    const startAutoplay = () => {
      if (prefersReducedMotion.matches || dots.length < 2 || intervalId) return;

      intervalId = window.setInterval(() => {
        index = (index + 1) % dots.length;
        render();
      }, 4500);
    };

    const stopAutoplay = () => {
      if (!intervalId) return;
      window.clearInterval(intervalId);
      intervalId = null;
    };

    dots.forEach((dot, dotIndex) => {
      dot.addEventListener("click", () => {
        index = dotIndex;
        render();
        stopAutoplay();
        startAutoplay();
      });
    });

    slider.addEventListener("mouseenter", stopAutoplay);
    slider.addEventListener("mouseleave", startAutoplay);
    slider.addEventListener("focusin", stopAutoplay);
    slider.addEventListener("focusout", startAutoplay);

    render();
    startAutoplay();
  });

  const initRevealAnimations = () => {
    const revealItems = Array.from(document.querySelectorAll("[data-reveal], [data-reveal-item]"));

    if (revealItems.length === 0) return;

    const reveal = (element) => {
      element.classList.add("is-visible");
    };

    document.querySelectorAll("[data-reveal-group]").forEach((group) => {
      const items = group.querySelectorAll("[data-reveal-item]");
      items.forEach((item, index) => {
        item.style.setProperty("--reveal-delay", `${index * 90}ms`);
      });
    });

    if (prefersReducedMotion.matches || !("IntersectionObserver" in window)) {
      revealItems.forEach(reveal);
      return;
    }

    const observer = new IntersectionObserver(
      (entries, currentObserver) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          reveal(entry.target);
          currentObserver.unobserve(entry.target);
        });
      },
      {
        threshold: 0.16,
        rootMargin: "0px 0px -8% 0px",
      }
    );

    revealItems.forEach((item) => {
      observer.observe(item);
    });
  };

  initRevealAnimations();

  const submitToFormBackend = async (form, successMessage) => {
    const formData = new FormData(form);
    const interest = formData.get("interest");
    const interestRoutes = {
      "Sorty app pilot": "[PILOT] Sorty app inquiry",
      "Request a pilot": "[PILOT] Sorty app inquiry",
      "Corporate experience booking": "[EXPERIENCE] Corporate experience inquiry",
      "Circular fashion event": "[EVENT] Circular fashion activation inquiry",
      "Industry partnership": "[PARTNERSHIP] Industry partnership inquiry",
      "Investment or grant inquiry": "[INVESTOR] Investor / grant inquiry",
      "Media or speaking": "[MEDIA] Media / speaking inquiry",
      "General inquiry": "[GENERAL] Website inquiry",
    };

    formData.set("_subject", interestRoutes[interest] || "[GENERAL] Website inquiry");
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
