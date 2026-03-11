<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($data['page_title'] ?? 'Savon de Marseille') ?></title>
  <meta name="description" content="<?= htmlspecialchars($data['meta_description'] ?? '') ?>">
  <?php if (!empty($data['canonical'])): ?>
  <link rel="canonical" href="<?= htmlspecialchars($data['canonical']) ?>">
  <?php endif; ?>
  
  <!-- Open Graph -->
  <meta property="og:title" content="<?= htmlspecialchars($data['page_title'] ?? '') ?>">
  <meta property="og:description" content="<?= htmlspecialchars($data['meta_description'] ?? '') ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= htmlspecialchars($data['canonical'] ?? SITE_URL) ?>">
  <meta property="og:site_name" content="Savon de Marseille">
  <meta property="og:locale" content="fr_FR">
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;600;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="/css/style.css">
  
  <!-- Schema.org WebSite -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Savon de Marseille",
    "url": "<?= SITE_URL ?>",
    "description": "Guide complet sur le savon de Marseille authentique : histoire, fabricants, usages et conseils.",
    "inLanguage": "fr-FR",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "<?= SITE_URL ?>/blog?q={search_term_string}",
      "query-input": "required name=search_term_string"
    }
  }
  </script>
  
  <?php if (!empty($data['schema_json'])): ?>
  <script type="application/ld+json"><?= $data['schema_json'] ?></script>
  <?php endif; ?>
</head>
<body>
  <header class="site-header">
    <div class="header-inner">
      <a href="/" class="site-logo">
        Savon de Marseille
        <span>Le guide de référence</span>
      </a>
      <button class="nav-toggle" aria-label="Menu" onclick="this.parentElement.querySelector('.site-nav').classList.toggle('open')">
        <span></span><span></span><span></span>
      </button>
      <nav class="site-nav" aria-label="Navigation principale">
        <a href="/guide">Le Guide</a>
        <a href="/fabricants">Fabricants</a>
        <a href="/comparatif">Comparatif</a>
        <a href="/usages">Usages</a>
        <a href="/blog">Blog</a>
        <a href="/comparatif" class="nav-cta">Quel savon choisir ?</a>
      </nav>
    </div>
  </header>
  <main>
