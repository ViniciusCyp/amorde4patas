const MENU_CLOSE_DURATION = 220;
const MODAL_CLOSE_DURATION = 240;
const BUTTON_FEEDBACK_DURATION = 2000;

const header = document.querySelector('.site-header');
const navToggle = document.querySelector('.site-header__toggle');
const mobilePanel = document.querySelector('.site-header__mobile-panel');

if (header && navToggle && mobilePanel) {
  let menuCloseTimer = null;

  const setMenuState = (isOpen) => {
    window.clearTimeout(menuCloseTimer);
    header.classList.toggle('is-menu-open', isOpen);
    navToggle.setAttribute('aria-expanded', String(isOpen));
    navToggle.setAttribute('aria-label', isOpen ? 'Fechar menu' : 'Abrir menu');

    if (isOpen) {
      mobilePanel.hidden = false;
      mobilePanel.dataset.state = 'open';
      window.requestAnimationFrame(() => {
        mobilePanel.classList.add('is-visible');
      });
      return;
    }

    mobilePanel.dataset.state = 'closing';
    mobilePanel.classList.remove('is-visible');
    menuCloseTimer = window.setTimeout(() => {
      mobilePanel.hidden = true;
      mobilePanel.dataset.state = 'closed';
    }, MENU_CLOSE_DURATION);
  };

  mobilePanel.dataset.state = 'closed';
  setMenuState(false);

  navToggle.addEventListener('click', () => {
    const isOpen = navToggle.getAttribute('aria-expanded') === 'true';
    setMenuState(!isOpen);
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth > 920) {
      setMenuState(false);
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  const copyButtons = document.querySelectorAll('[data-copy-target]');

  copyButtons.forEach((button) => {
    button.addEventListener('click', async () => {
      const selector = button.getAttribute('data-copy-target');
      const target = selector ? document.querySelector(selector) : null;

      if (!target) return;

      const text = target.textContent.trim();
      const defaultLabel = button.getAttribute('data-copy-label') || 'Copiar';
      const successLabel = button.getAttribute('data-copy-success') || 'Copiado!';

      try {
        await navigator.clipboard.writeText(text);
        button.textContent = successLabel;

        button.classList.add('is-copied');

        window.setTimeout(() => {
          button.textContent = defaultLabel;
          button.classList.remove('is-copied');
        }, BUTTON_FEEDBACK_DURATION);
      } catch (error) {
        console.error('Erro ao copiar chave PIX:', error);
      }
    }); 
  });
});


document.addEventListener('DOMContentLoaded', () => {
  const donationCard = document.querySelector('[data-donation-card]');
  const pixModal = document.querySelector('[data-pix-modal]');

  if (!donationCard || !pixModal) return;

  const amountButtons = donationCard.querySelectorAll('[data-donation-amount]');
  const amountInput = donationCard.querySelector('[data-donation-input]');
  const openModalButton = donationCard.querySelector('[data-open-pix-modal]');

  const modalImage = pixModal.querySelector('[data-pix-modal-image]');
  const modalAmount = pixModal.querySelector('[data-pix-modal-amount]');
  const modalCode = pixModal.querySelector('[data-pix-modal-code]');
  const closeButtons = pixModal.querySelectorAll('[data-close-pix-modal]');

if (!amountInput || !openModalButton || !modalImage || !modalAmount || !modalCode) return;

  let pixModalCloseTimer = null;

  const formatAmount = (value) => {
    return new Intl.NumberFormat('pt-BR', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    }).format(value);
  };

  const parseAmount = (value) => {
    const normalized = String(value)
      .replace(/[^\d,.-]/g, '')
      .replace(/\./g, '')
      .replace(',', '.');

    const parsed = Number(normalized);
    return Number.isFinite(parsed) ? parsed : 0;
  };

  const emv = (id, value) => {
    const size = String(value.length).padStart(2, '0');
    return `${id}${size}${value}`;
  };

  const removeAccents = (value) => {
    return String(value)
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '');
  };

  const sanitizePixText = (value, max = 99) => {
    return removeAccents(value)
      .replace(/[^A-Za-z0-9\s\-./]/g, '')
      .trim()
      .slice(0, max)
      .toUpperCase();
  };

  const crc16 = (value) => {
    let crc = 0xffff;

    for (let i = 0; i < value.length; i += 1) {
      crc ^= value.charCodeAt(i) << 8;

      for (let j = 0; j < 8; j += 1) {
        if ((crc & 0x8000) !== 0) {
          crc = (crc << 1) ^ 0x1021;
        } else {
          crc <<= 1;
        }

        crc &= 0xffff;
      }
    }

    return crc.toString(16).toUpperCase().padStart(4, '0');
  };

  const buildPixPayload = ({ key, name, city, amount, description, txid }) => {
    const gui = emv('00', 'br.gov.bcb.pix');

    let merchantAccount = gui + emv('01', key);

    if (description) {
      merchantAccount += emv('02', sanitizePixText(description, 72));
    }

    const payload =
      emv('00', '01') +
      emv('26', merchantAccount) +
      emv('52', '0000') +
      emv('53', '986') +
      emv('54', amount.toFixed(2)) +
      emv('58', 'BR') +
      emv('59', sanitizePixText(name, 25)) +
      emv('60', sanitizePixText(city, 15)) +
      emv('62', emv('05', sanitizePixText(txid || '***', 25))) +
      '6304';

    return `${payload}${crc16(payload)}`;
  };

  const openModal = () => {
    window.clearTimeout(pixModalCloseTimer);
    pixModal.hidden = false;
    pixModal.dataset.state = 'open';
    document.body.classList.add('is-pix-modal-open');
    window.requestAnimationFrame(() => {
      pixModal.classList.add('is-visible');
    });
  };

  const closeModal = () => {
    window.clearTimeout(pixModalCloseTimer);
    pixModal.dataset.state = 'closing';
    pixModal.classList.remove('is-visible');
    document.body.classList.remove('is-pix-modal-open');
    pixModalCloseTimer = window.setTimeout(() => {
      pixModal.hidden = true;
      pixModal.dataset.state = 'closed';
    }, MODAL_CLOSE_DURATION);
  };

  pixModal.dataset.state = 'closed';

  amountButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const amount = Number(button.dataset.donationAmount || 0);

      amountButtons.forEach((item) => item.classList.remove('is-active'));
      button.classList.add('is-active');
      button.classList.remove('is-pressing');
      window.requestAnimationFrame(() => {
        button.classList.add('is-pressing');
      });
      window.setTimeout(() => {
        button.classList.remove('is-pressing');
      }, 180);

      amountInput.value = formatAmount(amount);
    });
  });

  amountInput.addEventListener('focus', () => {
    amountButtons.forEach((button) => button.classList.remove('is-active'));
  });

  amountInput.addEventListener('blur', () => {
    const amount = Math.max(parseAmount(amountInput.value), 1);
    amountInput.value = formatAmount(amount);
  });

  openModalButton.addEventListener('click', () => {
    const amount = Math.max(parseAmount(amountInput.value), 1);

    const payload = buildPixPayload({
      key: donationCard.dataset.pixKey || '',
      name: donationCard.dataset.pixName || 'AMOR DE 4 PATAS',
      city: donationCard.dataset.pixCity || 'SAO PAULO',
      description: donationCard.dataset.pixDescription || 'DOACAO',
      txid: donationCard.dataset.pixTxid || 'AMOR4PATAS',
      amount,
    });

    modalAmount.textContent = `R$ ${formatAmount(amount)}`;
    modalCode.textContent = payload;
    modalImage.src = `https://api.qrserver.com/v1/create-qr-code/?size=280x280&data=${encodeURIComponent(payload)}`;
    modalImage.alt = `QR Code PIX no valor de R$ ${formatAmount(amount)}`;

    openModal();
  });

  closeButtons.forEach((button) => {
    button.addEventListener('click', closeModal);
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && !pixModal.hidden) {
      closeModal();
    } 
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const phoneInputs = document.querySelectorAll('.js-phone-mask input, input.js-phone-mask');
  const emailInputs = document.querySelectorAll('.js-email-normalize input, input.js-email-normalize, input[type="email"]');

  const applyPhoneMask = (value) => {
    const digits = String(value).replace(/\D/g, '').slice(0, 11);

    if (digits.length <= 10) {
      return digits
        .replace(/^(\d{0,2})/, '($1')
        .replace(/^(\(\d{2})(\d{0,4})/, '$1) $2')
        .replace(/(\d{4})(\d{0,4})$/, '$1-$2')
        .trim();
    }

    return digits
      .replace(/^(\d{0,2})/, '($1')
      .replace(/^(\(\d{2})(\d{0,5})/, '$1) $2')
      .replace(/(\d{5})(\d{0,4})$/, '$1-$2')
      .trim();
  };

  phoneInputs.forEach((input) => {
    input.setAttribute('inputmode', 'numeric');

    input.addEventListener('input', (event) => {
      event.currentTarget.value = applyPhoneMask(event.currentTarget.value);
    });

    input.addEventListener('blur', (event) => {
      event.currentTarget.value = applyPhoneMask(event.currentTarget.value);
    });
  });

  emailInputs.forEach((input) => {
    input.setAttribute('autocapitalize', 'none');
    input.setAttribute('autocomplete', 'email');
    input.setAttribute('inputmode', 'email');
    input.setAttribute('spellcheck', 'false');

    input.addEventListener('input', (event) => {
      event.currentTarget.value = event.currentTarget.value.replace(/\s+/g, '').toLowerCase();
    });

    input.addEventListener('blur', (event) => {
      event.currentTarget.value = event.currentTarget.value.trim().toLowerCase();
    });
  });
}); 

document.addEventListener('DOMContentLoaded', () => {
  const actionModals = document.querySelectorAll('[data-action-modal]');
  const openButtons = document.querySelectorAll('[data-open-action-modal]');

  if (!actionModals.length || !openButtons.length) return;

  const closeTimers = new WeakMap();

  const hideActionModal = (modal) => {
    const existingTimer = closeTimers.get(modal);
    window.clearTimeout(existingTimer);
    modal.classList.remove('is-visible');
    modal.dataset.state = 'closing';

    const timer = window.setTimeout(() => {
      modal.hidden = true;
      modal.dataset.state = 'closed';
      closeTimers.delete(modal);
    }, MODAL_CLOSE_DURATION);

    closeTimers.set(modal, timer);
  };

  const showActionModal = (modal) => {
    const existingTimer = closeTimers.get(modal);
    window.clearTimeout(existingTimer);
    closeTimers.delete(modal);
    modal.hidden = false;
    modal.dataset.state = 'open';
    window.requestAnimationFrame(() => {
      modal.classList.add('is-visible');
    });
  };

  const closeAllActionModals = () => {
    actionModals.forEach((modal) => {
      hideActionModal(modal);
    });

    document.body.classList.remove('is-action-modal-open');
  };

  actionModals.forEach((modal) => {
    modal.dataset.state = 'closed';
  });

  openButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const modalId = button.getAttribute('data-open-action-modal');
      const modal = modalId ? document.querySelector(`[data-action-modal="${modalId}"]`) : null;

      if (!modal) return;

      closeAllActionModals();
      showActionModal(modal);
      document.body.classList.add('is-action-modal-open');
    });
  });

  actionModals.forEach((modal) => {
    const closeButtons = modal.querySelectorAll('[data-close-action-modal]');
    const thumbs = modal.querySelectorAll('[data-action-modal-thumb]');
    const mainImage = modal.querySelector('[data-action-modal-main]');

    closeButtons.forEach((button) => {
      button.addEventListener('click', closeAllActionModals);
    });

    thumbs.forEach((thumb) => {
      thumb.addEventListener('click', () => {
        if (!mainImage) return;

        thumbs.forEach((item) => item.classList.remove('is-active'));
        thumb.classList.add('is-active');

        const image = thumb.getAttribute('data-image');
        const alt = thumb.getAttribute('data-alt') || '';

        if (image) {
          mainImage.src = image;
          mainImage.alt = alt;
        }
      });
    });
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      closeAllActionModals();
    }
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const animatedElements = document.querySelectorAll('[data-animate]');

  if (!animatedElements.length) return;

  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if (prefersReducedMotion) {
    animatedElements.forEach((element) => {
      element.classList.add('is-visible');
    });
    return;
  }

  animatedElements.forEach((element) => {
    const delay = element.getAttribute('data-delay');

    if (delay) {
      element.style.setProperty('--a4p-animate-delay', `${parseInt(delay, 10)}ms`);
    }
  });

  const observer = new IntersectionObserver(
    (entries, obs) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;

        entry.target.classList.add('is-visible');
        obs.unobserve(entry.target);
      });
    },
    {
      threshold: 0.16,
      rootMargin: '0px 0px -8% 0px',
    }
  );

  animatedElements.forEach((element) => {
    observer.observe(element);
  });
});
