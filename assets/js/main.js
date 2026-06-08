(function () {
  const toggle = document.querySelector('[data-nav-toggle]');
  const overlay = document.querySelector('[data-nav-overlay]');

  if (toggle && overlay) {
    toggle.addEventListener('click', () => {
      const isOpen = overlay.classList.toggle('open');
      toggle.classList.toggle('open', isOpen);
      toggle.setAttribute('aria-expanded', String(isOpen));
      document.body.style.overflow = isOpen ? 'hidden' : '';
    });

    overlay.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        overlay.classList.remove('open');
        toggle.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      });
    });
  }

  const params = new URLSearchParams(window.location.search);
  const inquiryType = params.get('type');
  const hiddenField = document.querySelector('input[name="inquiry_type"]');
  const selectField = document.querySelector('select[name="inquiry_type_select"]');

  if (inquiryType && hiddenField) {
    hiddenField.value = inquiryType;
  }
  if (inquiryType && selectField) {
    const valid = ['general', 'pilot', 'booking', 'partner', 'investor'];
    if (valid.includes(inquiryType)) {
      selectField.value = inquiryType;
    }
  }
  if (selectField && hiddenField) {
    selectField.addEventListener('change', () => {
      hiddenField.value = selectField.value;
    });
    if (!hiddenField.value) {
      hiddenField.value = selectField.value;
    }
  }
})();
