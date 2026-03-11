<?php
$data = [
  'page_title'       => 'Politique de confidentialite | Savon de Marseille',
  'meta_description' => 'Politique de confidentialite et protection des donnees personnelles du site savon-de-marseille.fr',
  'canonical'        => SITE_URL . '/politique-confidentialite',
];
include ROOT . '/views/includes/header.php';
?>

<section style="padding: 4rem 0; background: var(--beige);">
  <div class="container" style="max-width: 900px;">
    <h1 style="font-family:var(--font-serif); font-size:2rem; color:var(--brun); margin-bottom:2rem;">Politique de confidentialite</h1>
    <p style="color:var(--gris); margin-bottom:2rem; font-size:0.95rem;">
      Conformement au Reglement General sur la Protection des Donnees (RGPD - Reglement UE 2016/679) et a la loi Informatique et Libertes, notre politique de traitement des donnees personnelles est presentee ci-dessous.
    </p>
    
    <div style="text-align:center; background:var(--blanc); padding:2rem; border-radius:var(--radius); border:1px solid var(--bordure);">
      <img src="/img/legal/politique-confidentialite.png" 
           alt="Politique de confidentialite de savon-de-marseille.fr - RGPD, droits des personnes, cookies, sous-traitants"
           style="max-width:100%; height:auto;"
           loading="lazy">
      <p style="margin-top:1rem; font-size:0.8rem; color:var(--gris);">
        Si l'image ne s'affiche pas correctement, contactez-nous à : contact@savon-de-marseille.fr
      </p>
    </div>
  </div>
</section>

<?php include ROOT . '/views/includes/footer.php'; ?>
