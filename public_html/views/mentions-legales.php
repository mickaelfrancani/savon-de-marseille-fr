<?php
/**
 * views/mentions-legales.php
 * Mentions légales — image PNG uniquement
 */
$page_title       = 'Mentions légales';
$page_description = 'Mentions légales du site savon-de-marseille.fr';
$page_canonical   = 'https://savon-de-marseille.fr/mentions-legales/';

$breadcrumb = [['label' => 'Mentions légales']];

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>

<main class="legal-page">
  <img src="/img/legal/mentions-legales.png"
       alt="Mentions légales"
       style="max-width:100%;height:auto;"
       loading="lazy">
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
