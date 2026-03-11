  </main>
  
  <footer class="site-footer">
    <div class="footer-grid">
      <div class="footer-brand">
        <span class="logo-footer">Savon de Marseille</span>
        <p>Le guide de référence sur le savon de Marseille authentique. Informations objectives, fabricants vérifiés, conseils pratiques.</p>
        <p style="margin-top:1rem; font-size:0.8rem; opacity:0.6;">Certains liens de ce site sont des liens affilies. Cela ne modifie pas notre independance editoriale.</p>
      </div>
      <div class="footer-col">
        <h4>Explorer</h4>
        <ul>
          <li><a href="/guide">Guide complet</a></li>
          <li><a href="/histoire">Histoire</a></li>
          <li><a href="/usages">30 usages</a></li>
          <li><a href="/blog/vrai-faux-savon-de-marseille">Vrai vs Faux</a></li>
          <li><a href="/blog/fabrication-traditionnelle-savon-de-marseille">Fabrication</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Fabricants</h4>
        <ul>
          <li><a href="/fabricants">Tous les fabricants</a></li>
          <li><a href="/fabricants/marius-fabre">Marius Fabre</a></li>
          <li><a href="/fabricants/fer-a-cheval">Fer a Cheval</a></li>
          <li><a href="/fabricants/le-serail">Le Serail</a></li>
          <li><a href="/fabricants/rampal-latour">Rampal Latour</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Liens utiles</h4>
        <ul>
          <li><a href="/comparatif">Comparatif</a></li>
          <li><a href="/blog">Blog</a></li>
          <li><a href="mailto:contact@savon-de-marseille.fr">Contact</a></li>
          <li><a href="/mentions-legales">Mentions legales</a></li>
          <li><a href="/politique-confidentialite">Confidentialite</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; <?= date('Y') ?> Savon de Marseille. Tous droits reserves.</p>
      <div class="footer-legal-links">
        <a href="/mentions-legales">Mentions legales</a>
        <a href="/politique-confidentialite">Politique de confidentialite</a>
        <a href="/sitemap.xml">Sitemap</a>
      </div>
    </div>
  </footer>
  
  <script>
  // FAQ accordion
  document.querySelectorAll('.faq-question').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var answer = this.nextElementSibling;
      var isOpen = answer.style.display === 'block';
      document.querySelectorAll('.faq-answer').forEach(function(a) { a.style.display = 'none'; });
      answer.style.display = isOpen ? 'none' : 'block';
    });
  });
  // Init FAQ: hide all answers
  document.querySelectorAll('.faq-answer').forEach(function(a) { a.style.display = 'none'; });
  </script>
</body>
</html>
