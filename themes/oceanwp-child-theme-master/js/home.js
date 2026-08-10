document.addEventListener('DOMContentLoaded', () => {
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ============================================================
     1. HERO PARTICLES CANVAS
     ============================================================ */
  const cv = document.getElementById('hero-canvas');
  if (cv) {
    const ctx = cv.getContext('2d');
    let W, H, pts = [];
    
    function size() {
      W = cv.width = cv.offsetWidth;
      H = cv.height = cv.offsetHeight;
      pts = Array.from({ length: Math.min(70, W / 16) }, () => ({
        x: Math.random() * W,
        y: Math.random() * H,
        vx: (Math.random() - .5) * .35,
        vy: (Math.random() - .5) * .35,
        r: Math.random() * 1.5 + .5,
        c: Math.random() < .2 ? '232,67,78' : '255,255,255'
      }));
    }
    
    size();
    window.addEventListener('resize', size, { once: true });
    cancelAnimationFrame(window._pRaf);
    
    (function draw() {
      if (!document.contains(cv)) return;
      ctx.clearRect(0, 0, W, H);
      pts.forEach(p => {
        if (!reduced) {
          p.x = (p.x + p.vx + W) % W;
          p.y = (p.y + p.vy + H) % H;
        }
        ctx.fillStyle = `rgba(${p.c},.4)`;
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, 7);
        ctx.fill();
      });
      
      for (let i = 0; i < pts.length; i++) {
        for (let j = i + 1; j < pts.length; j++) {
          const a = pts[i], b = pts[j];
          const d = (a.x - b.x) ** 2 + (a.y - b.y) ** 2;
          if (d < 11000) {
            ctx.strokeStyle = `rgba(255,255,255,${.09 * (1 - d / 11000)})`;
            ctx.beginPath();
            ctx.moveTo(a.x, a.y);
            ctx.lineTo(b.x, b.y);
            ctx.stroke();
          }
        }
      }
      if (!reduced) window._pRaf = requestAnimationFrame(draw);
    })();
  }

  /* ============================================================
     2. INCREMENTAL NUMBERS (COUNTERS)
     ============================================================ */
  const cio = new IntersectionObserver(es => {
    es.forEach(e => {
      if (!e.isIntersecting) return;
      cio.unobserve(e.target);
      
      const el = e.target;
      const end = +el.dataset.count;
      const t0 = performance.now();
      const dur = reduced ? 1 : 1600;
      
      (function tick(t) {
        const p = Math.min((t - t0) / dur, 1);
        const ease = 1 - Math.pow(1 - p, 3);
        el.textContent = Math.round(end * ease);
        if (p < 1) requestAnimationFrame(tick);
      })(t0);
    });
  }, { threshold: .5 });

  document.querySelectorAll('[data-count]').forEach(el => cio.observe(el));
});
