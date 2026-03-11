<?php
/**
 * views/politique-confidentialite.php
 * Politique de confidentialité — image PNG uniquement
 */
$page_title       = 'Politique de confidentialité';
$page_description = 'Politique de confidentialité du site savon-de-marseille.fr';
$page_canonical   = 'https://savon-de-marseille.fr/politique-confidentialite/';

$breadcrumb = [['label' => 'Politique de confidentialité']];

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>

<main class="legal-page">
  <img src="/img/legal/politique-confidentialite.png"
       alt="Politique de confidentialité"
       style="max-width:100%;height:auto;"
       loading="lazy">
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
