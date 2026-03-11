<?php
$data = [
  'page_title'       => 'Mentions legales | Savon de Marseille',
  'meta_description' => 'Mentions legales du site savon-de-marseille.fr',
  'canonical'        => SITE_URL . '/mentions-legales',
];
include ROOT . '/views/includes/header.php';
?>

<section style="padding: 4rem 0; background: var(--beige);">
  <div class="container" style="max-width: 900px;">
    <h1 style="font-family:var(--font-serif); font-size:2rem; color:var(--brun); margin-bottom:2rem;">Mentions legales</h1>
    <p style="color:var(--gris); margin-bottom:2rem; font-size:0.95rem;">
      Conformement a l'article 6 de la loi n°2004-575 du 21 juin 2004 pour la confiance dans l'economie numerique, les informations concernant l'editeur et l'hebergeur de ce site sont reproduites ci-dessous sous forme d'image pour proteger les donnees personnelles.
    </p>
    
    <div style="text-align:center; background:var(--blanc); padding:2rem; border-radius:var(--radius); border:1px solid var(--bordure);">
      <a href="/img/legal/mentions-legales.png" target="_blank" title="Cliquer pour agrandir" style="display:block;cursor:zoom-in;"><img src="/img/legal/mentions-legales.png" 
           alt="Mentions legales de savon-de-marseille.fr - Editeur, hebergeur, propriete intellectuelle, limitations de responsabilite"
           style="max-width:100%; height:auto;"
           loading="lazy"></a>
      <p style="margin-top:1rem; font-size:0.8rem; color:var(--gris);">
        Si l'image ne s'affiche pas correctement, contactez-nous à : contact@savon-de-marseille.fr
      </p>
    </div>
  </div>
</section>

<?php include ROOT . '/views/includes/footer.php'; ?>
