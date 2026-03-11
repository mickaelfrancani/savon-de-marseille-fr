<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= htmlspecialchars($data['page_title'] ?? 'Savon de Marseille') ?></title>
  <meta name="description" content="<?= htmlspecialchars($data['meta_description'] ?? 'Guide indépendant du savon de Marseille authentique. Fabricants, comparatif, usages.') ?>">
  <?php if (!empty($data['canonical'])): ?>
  <link rel="canonical" href="<?= htmlspecialchars($data['canonical']) ?>">
  <?php endif; ?>
  <meta name="robots" content="index, follow">

  <!-- Google Search Console -->
  <meta name="google-site-verification" content="PLACEHOLDER_GSC" />

  <!-- Open Graph -->
  <meta property="og:title"       content="<?= htmlspecialchars($data['page_title'] ?? '') ?>">
  <meta property="og:description" content="<?= htmlspecialchars($data['meta_description'] ?? '') ?>">
  <meta property="og:type"        content="website">
  <meta property="og:url"         content="<?= htmlspecialchars($data['canonical'] ?? SITE_URL) ?>">
  <meta property="og:site_name"   content="Savon de Marseille">
  <meta property="og:locale"      content="fr_FR">
  <?php if (!empty($data['og_image'])): ?>
  <meta property="og:image"       content="<?= htmlspecialchars($data['og_image']) ?>">
  <?php endif; ?>

  <!-- Twitter Card -->
  <meta name="twitter:card"        content="summary_large_image">
  <meta name="twitter:title"       content="<?= htmlspecialchars($data['page_title'] ?? '') ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($data['meta_description'] ?? '') ?>">

  <!-- Google Fonts : Playfair Display + Lato -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Lato:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/responsive.css">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="/img/logo.svg">

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
  <header class="site-header" role="banner">
    <div class="header-inner">
      <a href="/" class="site-logo" aria-label="Savon de Marseille — Accueil">
        <img src="/img/logo.svg" alt="Logo Savon de Marseille" width="160" height="42" loading="eager">
      </a>
      <button class="nav-toggle"
              id="nav-toggle-compat"
              aria-label="Ouvrir le menu"
              aria-expanded="false"
              onclick="
                const nav = document.querySelector('.site-nav');
                const open = nav.classList.toggle('open');
                this.setAttribute('aria-expanded', open);
              ">
        <span></span><span></span><span></span>
      </button>
      <nav class="site-nav" aria-label="Navigation principale">
        <?php
        $cpath = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
        $links = [
          '/'           => 'Accueil',
          '/guide'      => 'Le Guide',
          '/fabricants' => 'Fabricants',
          '/comparatif' => 'Comparatif',
          '/usages'     => 'Usages',
          '/blog'       => 'Blog',
        ];
        foreach ($links as $href => $label):
          $active = ($href === '/' ? $cpath === '/' : str_starts_with($cpath, $href));
        ?>
        <a href="<?= $href ?>" <?= $active ? 'class="active" aria-current="page"' : '' ?>>
          <?= htmlspecialchars($label) ?>
        </a>
        <?php endforeach; ?>
      </nav>
    </div>

    <?php if (!empty($data['breadcrumb'])): ?>
    <nav class="breadcrumb" aria-label="Fil d'Ariane">
      <ol itemscope itemtype="https://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <a href="/" itemprop="item"><span itemprop="name">Accueil</span></a>
          <meta itemprop="position" content="1">
        </li>
        <?php foreach ($data['breadcrumb'] as $i => $crumb):
          $isLast = ($i === count($data['breadcrumb']) - 1); ?>
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <?php if (!$isLast && !empty($crumb['url'])): ?>
            <a href="<?= htmlspecialchars($crumb['url']) ?>" itemprop="item">
              <span itemprop="name"><?= htmlspecialchars($crumb['label']) ?></span>
            </a>
          <?php else: ?>
            <span itemprop="name"><?= htmlspecialchars($crumb['label']) ?></span>
          <?php endif; ?>
          <meta itemprop="position" content="<?= $i + 2 ?>">
        </li>
        <?php endforeach; ?>
      </ol>
    </nav>
    <?php endif; ?>

  </header>
  <main>
