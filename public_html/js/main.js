/* ============================================================
   savon-de-marseille.fr — main.js
   Vanilla JS : nav burger | TOC | comparatif filters | carte
   ============================================================ */

'use strict';

/* ── Burger menu ─────────────────────────────────────────── */
function initBurger() {
  const burger = document.querySelector('.nav-burger');
  const menu   = document.querySelector('.nav-menu');
  if (!burger || !menu) return;

  burger.addEventListener('click', () => {
    const open = burger.classList.toggle('open');
    menu.classList.toggle('open', open);
    burger.setAttribute('aria-expanded', open);
    document.body.style.overflow = open ? 'hidden' : '';
  });

  // Fermeture au clic en dehors
  document.addEventListener('click', (e) => {
    if (!burger.contains(e.target) && !menu.contains(e.target)) {
      burger.classList.remove('open');
      menu.classList.remove('open');
      burger.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    }
  });

  // Fermeture sur Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      burger.classList.remove('open');
      menu.classList.remove('open');
      burger.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    }
  });
}

/* ── Active nav link ─────────────────────────────────────── */
function initActiveNav() {
  const links = document.querySelectorAll('.nav-menu a');
  const path  = window.location.pathname;
  links.forEach(link => {
    const href = link.getAttribute('href') || '';
    if (href !== '/' && path.startsWith(href)) {
      link.classList.add('active');
    } else if (href === '/' && path === '/') {
      link.classList.add('active');
    }
  });
}

/* ── Table des matières automatique ─────────────────────── */
function initTOC() {
  const tocEl   = document.getElementById('article-toc');
  const content = document.querySelector('.article-body');
  if (!tocEl || !content) return;

  const headings = content.querySelectorAll('h2, h3');
  if (headings.length < 2) { tocEl.closest('.article-toc')?.remove(); return; }

  const ol = tocEl;
  let counter = 0;
  headings.forEach((h) => {
    counter++;
    const id = h.id || `section-${counter}`;
    h.id = id;
    const li = document.createElement('li');
    li.style.paddingLeft = h.tagName === 'H3' ? '1rem' : '0';
    li.innerHTML = `<a href="#${id}">${h.textContent}</a>`;
    ol.appendChild(li);
  });

  // Smooth scroll pour les liens TOC
  ol.querySelectorAll('a').forEach(a => {
    a.addEventListener('click', (e) => {
      e.preventDefault();
      const target = document.getElementById(a.getAttribute('href').slice(1));
      if (target) {
        const offset = document.querySelector('.site-header')?.offsetHeight || 80;
        window.scrollTo({ top: target.getBoundingClientRect().top + window.scrollY - offset - 16, behavior: 'smooth' });
      }
    });
  });
}

/* ── Comparatif : filtres & tri ──────────────────────────── */
function initComparatif() {
  const table   = document.getElementById('comparatif-table');
  if (!table) return;

  const tbody   = table.querySelector('tbody');
  const rows    = () => Array.from(tbody.querySelectorAll('tr[data-row]'));

  // Filtres
  document.querySelectorAll('.comparatif-filters select, .comparatif-filters input').forEach(input => {
    input.addEventListener('change', applyFilters);
  });

  function applyFilters() {
    const filterPoids   = document.getElementById('filter-poids')?.value   || '';
    const filterHuile   = document.getElementById('filter-huile')?.value   || '';
    const filterCert    = document.getElementById('filter-cert')?.value    || '';
    const filterPrixMax = parseFloat(document.getElementById('filter-prix')?.value) || Infinity;

    rows().forEach(row => {
      const poids  = row.dataset.poids  || '';
      const huile  = row.dataset.huile  || '';
      const cert   = row.dataset.cert   || '';
      const prix   = parseFloat(row.dataset.prix) || 0;

      const visible =
        (!filterPoids || poids === filterPoids) &&
        (!filterHuile || huile.toLowerCase().includes(filterHuile.toLowerCase())) &&
        (!filterCert  || cert === filterCert) &&
        (prix <= filterPrixMax);

      row.style.display = visible ? '' : 'none';
    });

    updateCount();
  }

  function updateCount() {
    const visible = rows().filter(r => r.style.display !== 'none').length;
    const counter = document.getElementById('comparatif-count');
    if (counter) counter.textContent = `${visible} produit${visible > 1 ? 's' : ''}`;
  }

  // Tri par colonne
  let sortDir = {};
  table.querySelectorAll('th[data-sort]').forEach(th => {
    th.addEventListener('click', () => {
      const col = th.dataset.sort;
      const dir = sortDir[col] === 'asc' ? 'desc' : 'asc';
      sortDir = { [col]: dir };

      // Icônes de tri
      table.querySelectorAll('th .sort-icon').forEach(ic => ic.textContent = '↕');
      th.querySelector('.sort-icon').textContent = dir === 'asc' ? '↑' : '↓';

      const sorted = rows().sort((a, b) => {
        let va = a.dataset[col] || '';
        let vb = b.dataset[col] || '';
        const numA = parseFloat(va), numB = parseFloat(vb);
        if (!isNaN(numA) && !isNaN(numB)) return dir === 'asc' ? numA - numB : numB - numA;
        return dir === 'asc' ? va.localeCompare(vb) : vb.localeCompare(va);
      });
      sorted.forEach(r => tbody.appendChild(r));
    });
  });

  updateCount();
}

/* ── Leaflet map (fabricant) ─────────────────────────────── */
function initMap() {
  const mapEl = document.getElementById('leaflet-map');
  if (!mapEl || typeof L === 'undefined') return;

  const lat = parseFloat(mapEl.dataset.lat) || 43.2965;
  const lng = parseFloat(mapEl.dataset.lng) || 5.3818;
  const name = mapEl.dataset.name || 'Savonnerie';

  const map = L.map('leaflet-map', { scrollWheelZoom: false }).setView([lat, lng], 14);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    maxZoom: 19
  }).addTo(map);

  const icon = L.divIcon({
    html: `<div style="background:#C8A96E;width:20px;height:20px;border-radius:50%;border:3px solid #3D2B1F;box-shadow:0 2px 6px rgba(0,0,0,.3)"></div>`,
    className: '',
    iconSize: [20, 20],
    iconAnchor: [10, 10]
  });

  L.marker([lat, lng], { icon }).addTo(map)
    .bindPopup(`<strong style="font-family:Georgia,serif">${name}</strong>`)
    .openPopup();
}

/* ── Smooth scroll pour ancres internes ──────────────────── */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', (e) => {
      const id = a.getAttribute('href').slice(1);
      if (!id) return;
      const target = document.getElementById(id);
      if (!target) return;
      e.preventDefault();
      const offset = document.querySelector('.site-header')?.offsetHeight || 80;
      window.scrollTo({ top: target.getBoundingClientRect().top + window.scrollY - offset - 16, behavior: 'smooth' });
    });
  });
}

/* ── Lazy load images (polyfill) ─────────────────────────── */
function initLazyImages() {
  if ('loading' in HTMLImageElement.prototype) return; // natif
  const imgs = document.querySelectorAll('img[loading="lazy"]');
  if (!imgs.length) return;
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        if (img.dataset.src) img.src = img.dataset.src;
        observer.unobserve(img);
      }
    });
  });
  imgs.forEach(img => observer.observe(img));
}

/* ── Init ────────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
  initBurger();
  initActiveNav();
  initTOC();
  initComparatif();
  initMap();
  initSmoothScroll();
  initLazyImages();
});
