<?php
/**
 * includes/header.php
 * Balises <head> complètes — savon-de-marseille.fr
 *
 * Variables attendues (définies avant l'include) :
 *   $page_title       string  Titre de la page (sans le suffixe site)
 *   $page_description string  Meta description
 *   $page_og_image    string  URL image OG (optionnel)
 *   $page_canonical   string  URL canonique (optionnel)
 *   $page_schema      string  JSON-LD schema.org (optionnel)
 */

$site_name    = 'Savon de Marseille';
$site_domain  = 'https://savon-de-marseille.fr';
$default_desc = 'Guide indépendant du savon de Marseille authentique. Fabricants, comparatif, usages et conseils pour choisir un vrai savon de Marseille.';
$default_img  = $site_domain . '/img/og-default.jpg';

$title       = isset($page_title)       ? htmlspecialchars($page_title) . ' — ' . $site_name : $site_name . ' — Le portail de référence';
$description = isset($page_description) ? htmlspecialchars($page_description) : $default_desc;
$og_image    = isset($page_og_image)    ? htmlspecialchars($page_og_image)    : $default_img;
$canonical   = isset($page_canonical)   ? htmlspecialchars($page_canonical)   : $site_domain . strtok($_SERVER['REQUEST_URI'], '?');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- SEO -->
  <title><?= $title ?></title>
  <meta name="description" content="<?= $description ?>">
  <link rel="canonical" href="<?= $canonical ?>">
  <meta name="robots" content="index, follow">
  <meta name="author" content="La Rédaction — savon-de-marseille.fr">

  <!-- Google Search Console -->
  <meta name="google-site-verification" content="PLACEHOLDER_GSC" />

  <!-- Open Graph -->
  <meta property="og:type"        content="website">
  <meta property="og:site_name"   content="<?= $site_name ?>">
  <meta property="og:title"       content="<?= $title ?>">
  <meta property="og:description" content="<?= $description ?>">
  <meta property="og:image"       content="<?= $og_image ?>">
  <meta property="og:url"         content="<?= $canonical ?>">
  <meta property="og:locale"      content="fr_FR">

  <!-- Twitter Card -->
  <meta name="twitter:card"        content="summary_large_image">
  <meta name="twitter:title"       content="<?= $title ?>">
  <meta name="twitter:description" content="<?= $description ?>">
  <meta name="twitter:image"       content="<?= $og_image ?>">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/responsive.css">

  <!-- Favicon (placeholder) -->
  <link rel="icon" type="image/svg+xml" href="/img/logo.svg">
  <link rel="alternate icon" href="/favicon.ico">

  <!-- Schema.org JSON-LD global -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "<?= $site_name ?>",
    "url": "<?= $site_domain ?>",
    "description": "<?= $default_desc ?>",
    "inLanguage": "fr-FR",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "<?= $site_domain ?>/blog/?q={search_term_string}",
      "query-input": "required name=search_term_string"
    }
  }
  </script>

<?php if (!empty($page_schema)): ?>
  <!-- Schema.org JSON-LD spécifique à la page -->
  <script type="application/ld+json">
  <?= $page_schema ?>
  </script>
<?php endif; ?>

</head>
<body>
