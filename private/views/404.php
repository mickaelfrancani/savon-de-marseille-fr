<?php
$data = [
  'page_title'       => 'Page introuvable | Savon de Marseille',
  'meta_description' => 'La page demandee n\'existe pas sur savon-de-marseille.fr',
];
include ROOT . '/views/includes/header.php';
?>

<section style="padding: 6rem 1.5rem; text-align:center; background:var(--beige);">
  <div class="container">
    <div style="font-family:var(--font-serif); font-size:6rem; color:var(--ocre); font-weight:700; line-height:1;">404</div>
    <h1 style="font-family:var(--font-serif); font-size:2rem; color:var(--brun); margin:1rem 0;">Page introuvable</h1>
    <p style="color:var(--gris); margin-bottom:2rem;">La page que vous cherchez n'existe pas ou a ete deplacee.</p>
    <a href="/" class="btn btn-primary">Retour a l'accueil</a>
    <span style="margin:0 1rem; color:var(--gris);">ou</span>
    <a href="/fabricants" class="btn btn-outline" style="color:var(--brun); border-color:var(--bordure);">Voir les fabricants</a>
  </div>
</section>

<?php include ROOT . '/views/includes/footer.php'; ?>
