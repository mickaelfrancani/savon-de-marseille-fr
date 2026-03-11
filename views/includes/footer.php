  </main>
  
  <footer class="site-footer" role="contentinfo">
    <div class="footer-grid">
      <div class="footer-brand">
        <span class="logo-footer">Savon de Marseille</span>
        <p>Le guide de référence sur le savon de Marseille authentique. Informations objectives, fabricants vérifiés, conseils pratiques.</p>
        <p style="margin-top:.75rem;font-size:.78rem;color:rgba(253,250,245,.45);">
          ★ Informations vérifiées • Aucune publicité cachée<br>
          Certains liens sont affiliés. Cela ne modifie pas notre indépendance.
        </p>
      </div>
      <div class="footer-col">
        <h4>Explorer</h4>
        <ul>
          <li><a href="/guide">Guide complet</a></li>
          <li><a href="/usages">Usages</a></li>
          <li><a href="/blog/vrai-faux-savon-de-marseille">Vrai vs Faux</a></li>
          <li><a href="/blog">Blog</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Fabricants</h4>
        <ul>
          <li><a href="/fabricants">Tous les fabricants</a></li>
          <li><a href="/fabricants/marius-fabre">Marius Fabre</a></li>
          <li><a href="/fabricants/fer-a-cheval">Fer à Cheval</a></li>
          <li><a href="/fabricants/le-serail">Le Sérail</a></li>
          <li><a href="/fabricants/rampal-latour">Rampal Latour</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Informations</h4>
        <ul>
          <li><a href="/comparatif">Comparatif</a></li>
          <li><a href="/mentions-legales">Mentions légales</a></li>
          <li><a href="/politique-confidentialite">Confidentialité</a></li>
          <li><a href="/sitemap.xml">Sitemap</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>&copy; <?= date('Y') ?> savon-de-marseille.fr — Tous droits réservés</span>
      <div class="footer-legal-links">
        <a href="/mentions-legales">Mentions légales</a>
        <a href="/politique-confidentialite">Politique de confidentialité</a>
      </div>
      <span style="font-style:italic;color:rgba(200,169,110,.6);">Le portail de référence du savon de Marseille</span>
    </div>
  </footer>
  
  <!-- JS principal -->
  <script src="/js/main.js" defer></script>
  <script>
  // FAQ accordion
  document.querySelectorAll('.faq-question').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var item = this.closest('.faq-item');
      var isOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item').forEach(function(i) { i.classList.remove('open'); });
      if (!isOpen) item.classList.add('open');
    });
  });
  </script>
</body>
</html>
