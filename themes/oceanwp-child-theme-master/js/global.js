document.addEventListener('DOMContentLoaded', () => {
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ============================================================
     1. LOADER & % TICKER
     ============================================================ */
  const loader = document.getElementById('loader');
  const loadBar = document.getElementById('loadBar');
  const loadPct = document.getElementById('loadPct');

  if (loader && loadBar && loadPct) {
    let pc = 0;
    const lIv = setInterval(() => {
      pc = Math.min(100, pc + Math.random() * 22);
      loadBar.style.width = pc + '%';
      loadPct.textContent = Math.round(pc) + '%';
      if (pc >= 100) {
        clearInterval(lIv);
        setTimeout(() => {
          loader.classList.add('done');
          // Start curtain transition out
          const curtain = document.getElementById('curtain');
          if (curtain) {
            curtain.classList.remove('load-state');
            curtain.classList.remove('in');
            curtain.classList.add('out');
            setTimeout(() => curtain.classList.remove('out'), 700);
          }
        }, reduced ? 0 : 350);
      }
    }, reduced ? 10 : 120);
  } else {
    // If loader doesn't exist, trigger curtain directly
    const curtain = document.getElementById('curtain');
    if (curtain) {
      // Small timeout to ensure DOM renders the initial paint covered by the curtain
      setTimeout(() => {
        curtain.classList.remove('load-state');
        curtain.classList.remove('in');
        curtain.classList.add('out');
        setTimeout(() => curtain.classList.remove('out'), 700);
      }, 50);
    }
  }

  /* ============================================================
     2. NAVIGATION & PROGRESS BAR
     ============================================================ */
  const nav = document.getElementById('nav');
  const prog = document.getElementById('progress');

  window.addEventListener('scroll', () => {
    const h = document.documentElement;
    if (prog) {
      prog.style.width = (h.scrollTop / (h.scrollHeight - h.clientHeight) * 100 || 0) + '%';
    }
    if (nav) {
      nav.classList.toggle('solid', h.scrollTop > 40);
    }
  }, { passive: true });

  const burger = document.getElementById('burger');
  const navLinks = document.getElementById('navLinks');
  if (burger && navLinks) {
    burger.onclick = () => {
      burger.classList.toggle('open');
      navLinks.classList.toggle('open');
      document.body.classList.toggle('menu-open');
    };

    // Close mobile menu on hash links (capturing phase to prevent theme scroll-effect scripts from stopping propagation)
    navLinks.addEventListener('click', (e) => {
      const link = e.target.closest('a');
      if (!link) return;
      const href = link.getAttribute('href');
      if (!href) return;
      try {
        const url = new URL(href, window.location.href);
        const path1 = url.pathname.replace(/\/$/, '');
        const path2 = window.location.pathname.replace(/\/$/, '');
        if (path1 === path2 && url.hash) {
          burger.classList.remove('open');
          navLinks.classList.remove('open');
          document.body.classList.remove('menu-open');
        }
      } catch (err) {}
    }, { capture: true });
  }

  /* ============================================================
     2.5. PAGE EXIT TRANSITION INTERCEPTOR
     ============================================================ */
  document.addEventListener('click', function (e) {
    const link = e.target.closest('a');
    if (!link) return;

    const href = link.getAttribute('href');
    if (!href) return;

    // Skip if it is a booking modal trigger (f-cal calendar button or Book a discovery call card)
    if (
      link.classList.contains('f-cal') ||
      link.textContent.includes('Book a discovery call')
    ) {
      return;
    }

    // Skip external links, hash links, mailto, tel, target="_blank", or modifier keys
    if (
      href.startsWith('#') ||
      href.startsWith('mailto:') ||
      href.startsWith('tel:') ||
      link.getAttribute('target') === '_blank' ||
      e.metaKey || e.ctrlKey || e.shiftKey || e.altKey
    ) {
      if (href.startsWith('#')) {
        // Close mobile menu if open
        if (burger && navLinks) {
          burger.classList.remove('open');
          navLinks.classList.remove('open');
          document.body.classList.remove('menu-open');
        }
      }
      return;
    }

    // Verify if the link is internal to our domain
    try {
      const url = new URL(href, window.location.href);
      if (url.origin !== window.location.origin) {
        return;
      }
      
      // Normalize pathnames by removing trailing slashes for comparison
      const path1 = url.pathname.replace(/\/$/, '');
      const path2 = window.location.pathname.replace(/\/$/, '');
      if (path1 === path2) {
        if (url.hash) {
          // Close mobile menu if open
          if (burger && navLinks) {
            burger.classList.remove('open');
            navLinks.classList.remove('open');
            document.body.classList.remove('menu-open');
          }
          return; // Let browser scroll to hash naturally
        }
      }
    } catch (err) {
      // If parsing fails, it is likely a relative internal path, so let it proceed.
    }

    // Prevent default browser navigation
    e.preventDefault();

    const curtain = document.getElementById('curtain');
    if (curtain) {
      // Close mobile menu if open
      if (burger && navLinks) {
        burger.classList.remove('open');
        navLinks.classList.remove('open');
        document.body.classList.remove('menu-open');
      }

      // Start exit transition
      curtain.classList.remove('out');
      curtain.classList.add('in');

      // Redirect after transition completes (~500ms)
      setTimeout(function () {
        window.location.href = href;
      }, 500);
    } else {
      window.location.href = href;
    }
  });

  /* ============================================================
     3. CUSTOM CURSOR & PARALLAX GLOW
     ============================================================ */
  const cursor = document.getElementById('cursor');
  const ring = document.getElementById('cursor-ring');
  const glow = document.getElementById('glow');

  if (!reduced && window.matchMedia('(hover:hover)').matches) {
    let mx = 0, my = 0, rx = 0, ry = 0;

    window.addEventListener('mousemove', e => {
      mx = e.clientX;
      my = e.clientY;

      if (cursor) {
        cursor.style.left = mx + 'px';
        cursor.style.top = my + 'px';
      }

      document.body.classList.toggle('cursor-hover', !!e.target.closest('a, button, .card, .tilt, [data-to]'));

      document.querySelectorAll('.parallax').forEach(el => {
        const p = +el.dataset.p || 10;
        el.style.transform = `translate(${(mx / window.innerWidth - .5) * p}px, ${(my / window.innerHeight - .5) * p}px)`;
      });
    });

    if (ring) {
      (function loop() {
        rx += (mx - rx) * .14;
        ry += (my - ry) * .14;
        ring.style.left = rx + 'px';
        ring.style.top = ry + 'px';
        requestAnimationFrame(loop);
      })();
    }

    if (glow) {
      let gx = window.innerWidth / 2, gy = window.innerHeight / 3;
      (function g() {
        gx += (mx - gx) * .05;
        gy += (my - gy) * .05;
        glow.style.left = gx + 'px';
        glow.style.top = gy + 'px';
        requestAnimationFrame(g);
      })();
    }
  } else {
    if (cursor) cursor.style.display = 'none';
    if (ring) ring.style.display = 'none';
  }

  /* ============================================================
     4. REVEALS (Scroll Animations)
     ============================================================ */
  const io = new IntersectionObserver(es => {
    es.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('on');
        io.unobserve(e.target);
      }
    });
  }, { threshold: .12 });

  document.querySelectorAll('.rv, .rv-blur, .rv-l, .rv-r, .wr').forEach(el => io.observe(el));

  /* ============================================================
     5. SPOTLIGHT EFFECT CARDS
     ============================================================ */
  document.querySelectorAll('.spot').forEach(c => {
    c.addEventListener('mousemove', e => {
      const r = c.getBoundingClientRect();
      c.style.setProperty('--sx', (e.clientX - r.left) + 'px');
      c.style.setProperty('--sy', (e.clientY - r.top) + 'px');
    });
  });

  /* ============================================================
     6. CARD TILT EFFECT
     ============================================================ */
  if (!reduced && window.matchMedia('(hover:hover)').matches) {
    document.querySelectorAll('.tilt').forEach(c => {
      c.addEventListener('mousemove', e => {
        const r = c.getBoundingClientRect();
        const x = (e.clientX - r.left) / r.width - .5;
        const y = (e.clientY - r.top) / r.height - .5;
        c.style.transform = `translateY(-7px) rotateX(${-y * 5}deg) rotateY(${x * 5}deg)`;
        c.style.transition = 'transform .08s';
      });
      c.addEventListener('mouseleave', () => {
        c.style.transform = '';
        c.style.transition = 'transform .5s';
      });
    });
  }

  /* ============================================================
     7. MAGNETIC BUTTON EFFECT
     ============================================================ */
  if (!reduced && window.matchMedia('(hover:hover)').matches) {
    document.querySelectorAll('.magnet').forEach(b => {
      b.addEventListener('mousemove', e => {
        const r = b.getBoundingClientRect();
        b.style.transform = `translate(${(e.clientX - r.left - r.width / 2) * .22}px, ${(e.clientY - r.top - r.height / 2) * .3}px)`;
      });
      b.addEventListener('mouseleave', () => b.style.transform = '');
    });
  }

  /* ============================================================
     8. FAQ ACCORDION
     ============================================================ */
  document.querySelectorAll('.faq').forEach(f => {
    const btn = f.querySelector('button');
    if (btn) {
      btn.onclick = () => {
        const open = f.classList.contains('open');
        document.querySelectorAll('.faq.open').forEach(o => {
          o.classList.remove('open');
          const ans = o.querySelector('.a');
          if (ans) ans.style.maxHeight = 0;
        });
        if (!open) {
          f.classList.add('open');
          const ans = f.querySelector('.a');
          if (ans) ans.style.maxHeight = ans.scrollHeight + 'px';
        }
      };
    }
  });

  /* ============================================================
     9. TESTIMONIALS SLIDER
     ============================================================ */
  const track = document.getElementById('tstTrack');
  const navEl = document.getElementById('tstNav');
  if (track && navEl) {
    const testimonialsCount = track.children.length;
    const per = window.innerWidth > 1024 ? 3 : window.innerWidth > 760 ? 2 : 1;
    const pages = Math.max(1, testimonialsCount - per + 1);
    let curPage = 0;

    navEl.innerHTML = '';
    for (let p = 0; p < pages; p++) {
      const d = document.createElement('button');
      d.className = 'tst-dot' + (p ? '' : ' on');
      d.setAttribute('aria-label', 'Slide ' + (p + 1));
      d.onclick = () => go(p);
      navEl.appendChild(d);
    }

    function go(p) {
      curPage = p;
      const firstChild = track.children[0];
      if (firstChild) {
        const w = firstChild.offsetWidth + 20;
        track.style.transform = `translateX(${-curPage * w}px)`;
      }
      navEl.querySelectorAll('.tst-dot').forEach((d, k) => d.classList.toggle('on', k === curPage));
    }

    if (!reduced) {
      clearInterval(window._tstIv);
      window._tstIv = setInterval(() => go((curPage + 1) % pages), 4500);
    }
  } else {
    clearInterval(window._tstIv);
  }

  /* ============================================================
     9.5. FORM VALIDATION
     ============================================================ */

  // Delegated event listeners to support elements that are cloned or modified dynamically by plugins
  const nameSelector = 'input[name="full-name"]';
  const phoneSelector = 'input[name="intl_tel-845"], input[name="intl_tel-402"], input[name^="intl_tel-"], input.wpcf7-intl-tel, input[type="tel"]';

  // Helper to restrict and format phone input to maximum 15 digits
  function cleanPhoneNumber(value) {
    let isPlus = value.startsWith('+');
    let temp = isPlus ? value.substring(1) : value;

    let chars = [];
    let digitCount = 0;
    for (let i = 0; i < temp.length; i++) {
      let char = temp[i];
      if (/[0-9]/.test(char)) {
        if (digitCount < 15) {
          chars.push(char);
          digitCount++;
        }
      } else if (char === ' ') {
        chars.push(char);
      }
    }
    return (isPlus ? '+' : '') + chars.join('');
  }

  // Input event delegation
  document.addEventListener('input', function (e) {
    const target = e.target;
    if (target && target.matches) {
      if (target.matches(nameSelector)) {
        target.value = target.value.replace(/[^a-zA-Z\s'-]/g, '');
      } else if (target.matches(phoneSelector)) {
        target.value = cleanPhoneNumber(target.value);
      }
    }
  });

  // Paste event delegation
  document.addEventListener('paste', function (e) {
    const target = e.target;
    if (target && target.matches) {
      if (target.matches(nameSelector)) {
        setTimeout(() => {
          target.value = target.value.replace(/[^a-zA-Z\s'-]/g, '');
        }, 0);
      } else if (target.matches(phoneSelector)) {
        setTimeout(() => {
          target.value = cleanPhoneNumber(target.value);
        }, 0);
      }
    }
  });

  // Focusout (blur) event delegation for instant field error validation under 7 digits
  document.addEventListener('focusout', function (e) {
    const target = e.target;
    if (target && target.matches && target.matches(phoneSelector)) {
      const value = target.value;
      const digits = value.replace(/[^0-9]/g, '');

      // Look for parent wrapper to append the tip correctly in CF7 markup
      const parent = target.closest('.wpcf7-form-control-wrap') || target.parentNode;
      let tip = parent.querySelector('.wpcf7-not-valid-tip');

      if (digits.length > 0 && digits.length < 7) {
        target.classList.add('wpcf7-not-valid');
        target.setAttribute('aria-invalid', 'true');

        if (!tip) {
          tip = document.createElement('span');
          tip.className = 'wpcf7-not-valid-tip';
          tip.setAttribute('aria-hidden', 'true');
          parent.appendChild(tip);
        }
        tip.textContent = 'Phone number must be at least 7 digits.';

        requestAnimationFrame(function () {
          void tip.offsetWidth; // Force reflow
          tip.classList.add('cf7-animate-in');
        });
      } else if (digits.length >= 7 || digits.length === 0) {
        target.classList.remove('wpcf7-not-valid');
        target.removeAttribute('aria-invalid');
        if (tip) {
          tip.classList.remove('cf7-animate-in');
          setTimeout(() => {
            if (!tip.classList.contains('cf7-animate-in')) {
              tip.remove();
            }
          }, 300);
        }
      }
    }
  });

  /* ============================================================
     9.8. NUMERICAL COUNTER ANIMATIONS
     ============================================================ */
  const countElements = document.querySelectorAll('[data-count]');
  if (countElements.length > 0) {
    const runCounter = (el) => {
      const target = +el.getAttribute('data-count');
      const duration = 2000; // 2 seconds
      const startTime = performance.now();

      const update = (now) => {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        // Ease out quad
        const ease = progress * (2 - progress);
        const current = Math.floor(ease * target);

        el.textContent = current;

        if (progress < 1) {
          requestAnimationFrame(update);
        } else {
          el.textContent = target;
        }
      };

      requestAnimationFrame(update);
    };

    const counterObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          runCounter(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    countElements.forEach(el => {
      // Set to 0 initially so the animation starts from 0 when it enters viewport
      el.textContent = '0';
      counterObserver.observe(el);
    });
  }

  /* ============================================================
     9.9. BOOKING MODAL POPUP SYSTEM
     ============================================================ */
  const overlay = document.getElementById('booking-modal-overlay');
  const closeBtn = document.getElementById('booking-modal-close');
  const nameInput = overlay ? overlay.querySelector('#booking-name, input[name="booking-name"], input[name="your-name"]') : null;
  const dateInput = overlay ? overlay.querySelector('input[type="date"], #booking-date') : null;
  const timeInput = overlay ? overlay.querySelector('input[type="time"], input.booking-time-input, #booking-time') : null;

  // Restrict Name input to letters only (no numbers)
  if (nameInput) {
    nameInput.addEventListener('input', function () {
      this.value = this.value.replace(/[0-9]/g, '');
    });
  }

  function validateBookingDate(input) {
    if (!input) return true;
    const val = input.value;
    const parent = input.closest('.booking-field') || input.parentNode;
    let tip = parent.querySelector('.wpcf7-not-valid-tip');

    if (val) {
      const selectedDate = new Date(val);
      selectedDate.setHours(0, 0, 0, 0);
      const todayDate = new Date();
      todayDate.setHours(0, 0, 0, 0);

      // If the year is not fully typed yet (less than 4 digits), skip validation to avoid locking typing
      const yearStr = val.split('-')[0];
      if (yearStr && yearStr.length < 4) {
        input.setCustomValidity('');
        input.classList.remove('wpcf7-not-valid');
        if (tip) tip.remove();
        return true;
      }

      if (selectedDate <= todayDate) {
        input.setCustomValidity('Please select an upcoming date (tomorrow or later).');
        input.classList.add('wpcf7-not-valid');
        if (!tip) {
          tip = document.createElement('span');
          tip.className = 'wpcf7-not-valid-tip';
          tip.setAttribute('aria-hidden', 'true');
          tip.textContent = 'Please select an upcoming date (tomorrow or later).';
          parent.appendChild(tip);
          requestAnimationFrame(() => tip.classList.add('cf7-animate-in'));
        }
        return false;
      }
    }

    input.setCustomValidity('');
    input.classList.remove('wpcf7-not-valid');
    if (tip) {
      tip.classList.remove('cf7-animate-in');
      setTimeout(() => {
        if (!tip.classList.contains('cf7-animate-in')) tip.remove();
      }, 300);
    }
    return true;
  }

  function validateBookingTime(input) {
    if (!input) return true;
    const val = input.value;
    const parent = input.closest('.booking-field') || input.parentNode;
    let tip = parent.querySelector('.wpcf7-not-valid-tip');

    if (val) {
      const [hours, minutes] = val.split(':').map(Number);
      if (hours < 9 || (hours >= 20 && minutes > 0) || hours > 20) {
        input.setCustomValidity('Please select a time between 9:00 AM and 8:00 PM.');
        input.classList.add('wpcf7-not-valid');
        if (!tip) {
          tip = document.createElement('span');
          tip.className = 'wpcf7-not-valid-tip';
          tip.setAttribute('aria-hidden', 'true');
          tip.textContent = 'Time must be between 9:00 AM and 8:00 PM.';
          parent.appendChild(tip);
          requestAnimationFrame(() => tip.classList.add('cf7-animate-in'));
        }
        return false;
      }
    }

    input.setCustomValidity('');
    input.classList.remove('wpcf7-not-valid');
    if (tip) {
      tip.classList.remove('cf7-animate-in');
      setTimeout(() => {
        if (!tip.classList.contains('cf7-animate-in')) tip.remove();
      }, 300);
    }
    return true;
  }

  // Set tomorrow's date as min date constraint (no past dates or today)
  if (dateInput) {
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    const yyyy = tomorrow.getFullYear();
    const mm = String(tomorrow.getMonth() + 1).padStart(2, '0');
    const dd = String(tomorrow.getDate()).padStart(2, '0');
    dateInput.setAttribute('min', `${yyyy}-${mm}-${dd}`);

    // JavaScript validation constraints for date input
    dateInput.addEventListener('input', function () { validateBookingDate(this); });
    dateInput.addEventListener('change', function () { validateBookingDate(this); });
  }

  // Validate time range (9:00 AM to 8:00 PM)
  if (timeInput) {
    timeInput.type = 'time';
    timeInput.setAttribute('min', '09:00');
    timeInput.setAttribute('max', '20:00');
    timeInput.addEventListener('input', function () { validateBookingTime(this); });
    timeInput.addEventListener('change', function () { validateBookingTime(this); });
  }

  // Hook submit event on capture phase to block Contact Form 7 from submitting if validations fail
  const bookingFormEl = overlay ? overlay.querySelector('form') : null;
  if (bookingFormEl) {
    bookingFormEl.addEventListener('submit', function (e) {
      const isDateValid = validateBookingDate(dateInput);
      const isTimeValid = validateBookingTime(timeInput);

      if (!isDateValid || !isTimeValid) {
        e.preventDefault();
        e.stopImmediatePropagation();

        if (!isDateValid && dateInput) {
          dateInput.reportValidity();
        } else if (!isTimeValid && timeInput) {
          timeInput.reportValidity();
        }
        return false;
      }
    }, { capture: true });
  }

  function openModal(e) {
    if (e) e.preventDefault();
    if (overlay) {
      overlay.classList.add('open');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeModal() {
    if (overlay) {
      overlay.classList.remove('open');
      document.body.style.overflow = '';

      // Reset the modal card content back to initial CF7 form when closed, if success screen was shown
      const initialFormContent = overlay.getAttribute('data-initial-html');
      if (initialFormContent) {
        overlay.querySelector('.booking-modal-card').innerHTML = initialFormContent;
        // Re-bind close button and inputs
        const newCloseBtn = document.getElementById('booking-modal-close');
        if (newCloseBtn) newCloseBtn.onclick = closeModal;
        rebindBookingInputs();
      }
    }
  }

  // Store initial HTML content of the modal card to restore it when closed
  if (overlay) {
    const card = overlay.querySelector('.booking-modal-card');
    if (card) {
      overlay.setAttribute('data-initial-html', card.innerHTML);
    }
  }

  function rebindBookingInputs() {
    const newNameInput = overlay.querySelector('#booking-name, input[name="booking-name"], input[name="your-name"]');
    const newDateInput = overlay.querySelector('input[type="date"], #booking-date');
    const newTimeInput = overlay.querySelector('input[type="time"], input.booking-time-input, #booking-time');

    if (newNameInput) {
      newNameInput.addEventListener('input', function () {
        this.value = this.value.replace(/[0-9]/g, '');
      });
    }

    if (newDateInput) {
      const today = new Date();
      const tomorrow = new Date(today);
      tomorrow.setDate(tomorrow.getDate() + 1);
      const yyyy = tomorrow.getFullYear();
      const mm = String(tomorrow.getMonth() + 1).padStart(2, '0');
      const dd = String(tomorrow.getDate()).padStart(2, '0');
      newDateInput.setAttribute('min', `${yyyy}-${mm}-${dd}`);

      newDateInput.addEventListener('input', function () { validateBookingDate(this); });
      newDateInput.addEventListener('change', function () { validateBookingDate(this); });
    }

    if (newTimeInput) {
      newTimeInput.type = 'time';
      newTimeInput.setAttribute('min', '09:00');
      newTimeInput.setAttribute('max', '20:00');
      newTimeInput.addEventListener('input', function () { validateBookingTime(this); });
      newTimeInput.addEventListener('change', function () { validateBookingTime(this); });
    }

    // Re-bind the capture phase form submission validation
    const newFormEl = overlay.querySelector('form');
    if (newFormEl) {
      newFormEl.addEventListener('submit', function (e) {
        const isDateValid = validateBookingDate(newDateInput);
        const isTimeValid = validateBookingTime(newTimeInput);

        if (!isDateValid || !isTimeValid) {
          e.preventDefault();
          e.stopImmediatePropagation();

          if (!isDateValid && newDateInput) {
            newDateInput.reportValidity();
          } else if (!isTimeValid && newTimeInput) {
            newTimeInput.reportValidity();
          }
          return false;
        }
      }, { capture: true });
    }
  }

  if (closeBtn) closeBtn.onclick = closeModal;
  if (overlay) {
    overlay.onclick = (e) => {
      if (e.target === overlay) closeModal();
    };
  }

  // Bind booking trigger clicks
  document.addEventListener('click', function (e) {
    const trigger = e.target.closest('.f-cal, a.ct-card');
    if (trigger) {
      if (trigger.classList.contains('f-cal') || trigger.textContent.includes('Book a discovery call')) {
        e.preventDefault();
        openModal();
      }
    }
  });

  // Handle successful Contact Form 7 submission for booking modal
  document.addEventListener('wpcf7mailsent', function (event) {
    const form = event.target;
    if (overlay && (form.closest('#booking-modal-overlay') || form.querySelector('#booking-modal-overlay'))) {
      const nameVal = form.querySelector('input[name="booking-name"], input[name="your-name"], #booking-name')?.value || 'there';
      const emailVal = form.querySelector('input[name="booking-email"], input[name="your-email"], #booking-email')?.value || '';
      const dateVal = form.querySelector('input[type="date"], input[name="booking-date"]')?.value || '';
      const timeInputVal = form.querySelector('input[type="time"], input[name="booking-time"]')?.value;

      let timeVal = '';
      if (timeInputVal) {
        const [hStr, mStr] = timeInputVal.split(':');
        let hours = Number(hStr);
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // 0 hour should be 12
        timeVal = `${hours}:${mStr} ${ampm}`;
      }

      const card = overlay.querySelector('.booking-modal-card');
      if (card) {
        card.innerHTML = `
          <button class="booking-modal-close" id="booking-modal-close" aria-label="Close modal">&times;</button>
          <div class="booking-success-screen" style="text-align:center; padding:30px 10px;">
            <div class="booking-success-icon">
              <svg class="cf7-check-icon" width="56" height="56" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="11" fill="none" stroke="currentColor" stroke-width="2"/>
                <path d="M7 12.5l3 3 7-7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <h3 style="margin-top:20px; font-size:1.4rem;">Booking Requested!</h3>
            <p style="color:var(--muted); margin-top:10px; font-size:0.95rem; line-height:1.6;">
              Thank you, <strong>${nameVal}</strong>. We have received your request for a discovery call on <strong>${dateVal}</strong> at <strong>${timeVal}</strong>.
            </p>
            ${emailVal ? `<p style="color:var(--muted); font-size:0.85rem; margin-top:8px;">A confirmation link has been sent to <strong>${emailVal}</strong>.</p>` : ''}
            <button class="btn btn-ghost" id="booking-success-close" style="margin-top:24px; padding:10px 24px; font-size:0.85rem;">Close</button>
          </div>
        `;

        setTimeout(() => {
          const svg = card.querySelector('.cf7-check-icon');
          if (svg) svg.classList.add('cf7-animate-in');
        }, 50);

        card.querySelector('#booking-modal-close').onclick = closeModal;
        card.querySelector('#booking-success-close').onclick = closeModal;
      }
    }
  }, false);
});
/* ============================================================
   10. CONTACT FORM SUBMISSION
   ============================================================ */
function submitForm(e) {
  e.preventDefault();
  const f = e.target;
  const box = f.closest('.ct-form');
  if (f && box) {
    f.style.display = 'none';
    const ok = box.querySelector('.form-ok');
    if (ok) ok.style.display = 'block';
  }
  return false;
}
window.submitForm = submitForm;

/* ---------- Contact Form 7 custom message handlers ---------- */
// Success
document.addEventListener('wpcf7mailsent', function (event) {
  var form = event.target;
  var msg = form.querySelector('.wpcf7-response-output');
  if (!msg) return;

  if (!msg.querySelector('.cf7-check-icon')) {
    msg.insertAdjacentHTML('afterbegin',
      '<svg class="cf7-check-icon" width="20" height="20" viewBox="0 0 24 24" style="flex-shrink:0; margin-right:8px;">' +
      '<circle cx="12" cy="12" r="11" fill="none" stroke="currentColor" stroke-width="2"/>' +
      '<path d="M7 12.5l3 3 7-7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
      '</svg>'
    );
  }

  // Remove any error icons if they exist from previous attempts
  var errIcon = msg.querySelector('.cf7-error-icon');
  if (errIcon) errIcon.remove();

  requestAnimationFrame(function () {
    void msg.offsetWidth; // Force reflow so display: flex is registered
    msg.classList.add('cf7-animate-in');
  });
}, false);

// Validation error (fields missing/invalid)
document.addEventListener('wpcf7invalid', function (event) {
  var form = event.target;
  var msg = form.querySelector('.wpcf7-response-output');
  if (!msg) return;

  if (!msg.querySelector('.cf7-error-icon')) {
    msg.insertAdjacentHTML('afterbegin',
      '<svg class="cf7-error-icon" width="20" height="20" viewBox="0 0 24 24" style="flex-shrink:0; margin-right:8px;">' +
      '<circle cx="12" cy="12" r="11" fill="none" stroke="currentColor" stroke-width="2"/>' +
      '<line x1="12" y1="7" x2="12" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>' +
      '<circle cx="12" cy="16.5" r="1.2" fill="currentColor"/>' +
      '</svg>'
    );
  }

  // Remove any success icons if they exist from previous attempts
  var successIcon = msg.querySelector('.cf7-check-icon');
  if (successIcon) successIcon.remove();

  requestAnimationFrame(function () {
    void msg.offsetWidth; // Force reflow so display: flex is registered
    msg.classList.add('cf7-animate-in', 'cf7-shake');
  });

  // Also fade in each individual field tooltip
  form.querySelectorAll('.wpcf7-not-valid-tip').forEach(function (tip, i) {
    setTimeout(function () {
      tip.classList.add('cf7-animate-in');
    }, i * 60);
  });
}, false);

// Mail failed (server-side error, not validation) — reuses the same styling
document.addEventListener('wpcf7mailfailed', function (event) {
  var form = event.target;
  var msg = form.querySelector('.wpcf7-response-output');
  if (!msg) return;

  // Remove any success icons if they exist from previous attempts
  var successIcon = msg.querySelector('.cf7-check-icon');
  if (successIcon) successIcon.remove();

  requestAnimationFrame(function () {
    void msg.offsetWidth; // Force reflow so display: flex is registered
    msg.classList.add('cf7-animate-in', 'cf7-shake');
  });
}, false);
