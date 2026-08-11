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
      curtain.classList.add('out');
      setTimeout(() => curtain.classList.remove('out'), 700);
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
  }

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

  // Input event delegation
  document.addEventListener('input', function (e) {
    const target = e.target;
    if (target && target.matches) {
      if (target.matches(nameSelector)) {
        target.value = target.value.replace(/[^a-zA-Z\s'-]/g, '');
      } else if (target.matches(phoneSelector)) {
        let value = target.value;
        if (value.startsWith('+')) {
          value = '+' + value.substring(1).replace(/[^0-9\s]/g, '');
        } else {
          value = value.replace(/[^0-9\s]/g, '');
        }
        target.value = value;
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
          let value = target.value;
          if (value.startsWith('+')) {
            value = '+' + value.substring(1).replace(/[^0-9\s]/g, '');
          } else {
            value = value.replace(/[^0-9\s]/g, '');
          }
          target.value = value;
        }, 0);
      }
    }
  });
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
