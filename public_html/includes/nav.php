<?php
/**
 * includes/nav.php
 * Navigation principale + fil d'Ariane
 *
 * Variable optionnelle :
 *   $breadcrumb  array  [['label'=>'...','url'=>'...'], ...]
 *                       Le dernier élément est la page courante (sans url)
 */

$current_path = strtok($_SERVER['REQUEST_URI'], '?');

$nav_links = [
  ['href' => '/',           'label' => 'Accueil'],
  ['href' => '/guide/',     'label' => 'Le Guide'],
  ['href' => '/fabricants/','label' => 'Fabricants'],
  ['href' => '/comparatif/','label' => 'Comparatif'],
  ['href' => '/usages/',    'label' => 'Usages'],
  ['href' => '/blog/',      'label' => 'Blog'],
];
?>
<header class="site-header" role="banner">
  <nav class="nav-inner" aria-label="Navigation principale">

    <!-- Logo -->
    <a href="/" class="nav-logo" aria-label="Savon de Marseille — Accueil">
      <img src="/img/logo.svg" alt="Logo Savon de Marseille" width="200" height="50" loading="eager">
    </a>

    <!-- Menu principal -->
    <ul class="nav-menu" id="nav-menu" role="list">
      <?php foreach ($nav_links as $link): ?>
        <?php
          $is_active = ($link['href'] === '/')
            ? $current_path === '/'
            : str_starts_with($current_path, $link['href']);
        ?>
        <li role="listitem">
          <a href="<?= htmlspecialchars($link['href']) ?>"
             <?= $is_active ? 'class="active" aria-current="page"' : '' ?>>
            <?= htmlspecialchars($link['label']) ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>

    <!-- Burger (mobile) -->
    <button class="nav-burger"
            id="nav-burger"
            aria-label="Ouvrir le menu"
            aria-expanded="false"
            aria-controls="nav-menu">
      <span></span>
      <span></span>
      <span></span>
    </button>

  </nav>

  <?php if (!empty($breadcrumb)): ?>
  <!-- Fil d'Ariane -->
  <nav class="breadcrumb" aria-label="Fil d'Ariane">
    <ol itemscope itemtype="https://schema.org/BreadcrumbList">

      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="/" itemprop="item"><span itemprop="name">Accueil</span></a>
        <meta itemprop="position" content="1">
      </li>

      <?php
        $pos = 2;
        foreach ($breadcrumb as $i => $crumb):
          $is_last = ($i === count($breadcrumb) - 1);
      ?>
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <?php if (!$is_last && !empty($crumb['url'])): ?>
          <a href="<?= htmlspecialchars($crumb['url']) ?>" itemprop="item">
            <span itemprop="name"><?= htmlspecialchars($crumb['label']) ?></span>
          </a>
        <?php else: ?>
          <span itemprop="name"><?= htmlspecialchars($crumb['label']) ?></span>
        <?php endif; ?>
        <meta itemprop="position" content="<?= $pos++ ?>">
      </li>
      <?php endforeach; ?>

    </ol>
  </nav>
  <?php endif; ?>

</header>
