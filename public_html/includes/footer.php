<?php
/**
 * includes/footer.php
 * Footer du site savon-de-marseille.fr
 */
$year = date('Y');
?>

<footer class="site-footer" role="contentinfo">
  <div class="footer-inner">

    <!-- Colonne marque -->
    <div class="footer-brand">
      <div class="footer-logo-text">Savon de Marseille</div>
      <p>Votre guide indépendant pour tout comprendre<br>sur le savon de Marseille authentique.</p>
      <p style="margin-top:.75rem;font-size:.78rem;color:rgba(253,250,245,.45);">
        ★ Informations vérifiées • Aucune publicité cachée
      </p>
    </div>

    <!-- Colonne navigation -->
    <div class="footer-nav">
      <h4>Le site</h4>
      <ul>
        <li><a href="/">Accueil</a></li>
        <li><a href="/guide/">Le Guide complet</a></li>
        <li><a href="/fabricants/">Annuaire Fabricants</a></li>
        <li><a href="/comparatif/">Comparatif produits</a></li>
        <li><a href="/usages/">Usages du savon</a></li>
        <li><a href="/blog/">Blog &amp; Actualités</a></li>
      </ul>
    </div>

    <!-- Colonne légal -->
    <div class="footer-nav">
      <h4>Informations</h4>
      <ul>
        <li><a href="/mentions-legales/">Mentions légales</a></li>
        <li><a href="/politique-confidentialite/">Politique de confidentialité</a></li>
        <li><a href="/contact/">Contact</a></li>
      </ul>
      <p style="margin-top:1.25rem;font-size:.75rem;color:rgba(253,250,245,.4);line-height:1.5;">
        Ce site contient des liens affiliés.<br>
        Nos recommandations restent indépendantes.
      </p>
    </div>

  </div>

  <div class="footer-bottom">
    <span>&copy; <?= $year ?> savon-de-marseille.fr — Tous droits réservés</span>
    <span class="footer-tagline">Le portail de référence du savon de Marseille</span>
  </div>
</footer>

<!-- JS principal -->
<script src="/js/main.js" defer></script>
</body>
</html>
