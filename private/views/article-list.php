<?php
/**
 * views/article-list.php
 * Liste des articles blog — savon-de-marseille.fr
 *
 * Variables attendues :
 *   $articles   array  [{id,slug,title,excerpt,category_label,category_slug,date_published,icon}]
 *   $total      int
 *   $page       int    page courante (1-based)
 *   $per_page   int
 *   $category   string|null  filtre catégorie actif
 */

if (!isset($articles)) {
  $articles = [];
  $total    = 0;
  $page     = 1;
  $per_page = 9;
  $category = null;
}

$total_pages = $per_page > 0 ? (int) ceil($total / $per_page) : 1;

$page_title       = isset($category) ? 'Blog — ' . $category : 'Blog — Actualités & Guides';
$page_description = 'Tous nos articles sur le savon de Marseille : authenticité, fabricants, usages, recettes et conseils.';
$page_canonical   = 'https://savon-de-marseille.fr/blog/' . ($page > 1 ? '?page=' . $page : '');

$breadcrumb = [['label' => 'Blog']];
if ($category) {
  $breadcrumb = [['label' => 'Blog', 'url' => '/blog/'], ['label' => $category]];
}

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>

<div class="page-header">
  <div class="container">
    <h1><?= isset($category) ? 'Blog — ' . htmlspecialchars($category) : 'Blog & Actualités' ?></h1>
    <p>Guides, conseils, décryptages et actualités autour du savon de Marseille authentique.</p>
  </div>
</div>

<main class="section">
  <div class="container">

    <!-- Filtres catégories -->
    <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:2.5rem;">
      <?php
      $categories = ['Authenticité','Fabricants','Guide','Usages','Actualités'];
      ?>
      <a href="/blog/" class="badge <?= !$category ? 'badge--brun' : 'badge--olive' ?>"
         style="padding:.35rem .9rem;font-size:.8rem;text-decoration:none;">
        Tous
      </a>
      <?php foreach ($categories as $cat): ?>
      <a href="/blog/categorie/<?= urlencode(strtolower($cat)) ?>/"
         class="badge <?= ($category === $cat) ? 'badge--brun' : 'badge--olive' ?>"
         style="padding:.35rem .9rem;font-size:.8rem;text-decoration:none;">
        <?= htmlspecialchars($cat) ?>
      </a>
      <?php endforeach; ?>
    </div>

    <?php if (!empty($articles)): ?>
    <div class="cards-grid">
      <?php foreach ($articles as $art): ?>
      <article class="card">
        <?php if (!empty($art['image_url'])): ?>
        <img src="<?= htmlspecialchars($art['image_url']) ?>"
             alt="<?= htmlspecialchars($art['title']) ?>"
             class="card-img" loading="lazy">
        <?php else: ?>
        <div class="card-img-placeholder" aria-hidden="true"><?= $art['icon'] ?? '📰' ?></div>
        <?php endif; ?>
        <div class="card-body">
          <span class="card-category"><?= htmlspecialchars($art['category_label']) ?></span>
          <h3><a href="/blog/<?= htmlspecialchars($art['slug']) ?>/"><?= htmlspecialchars($art['title']) ?></a></h3>
          <p class="card-excerpt"><?= htmlspecialchars($art['excerpt']) ?></p>
          <div class="card-meta">
            <span>La Rédaction</span>
            <span class="card-meta-dot">•</span>
            <time datetime="<?= htmlspecialchars($art['date_published']) ?>">
              <?= (new DateTime($art['date_published']))->format('j M Y') ?>
            </time>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
    <nav class="pagination" aria-label="Pagination">
      <?php if ($page > 1): ?>
      <a href="/blog/?page=<?= $page - 1 ?>" aria-label="Page précédente">‹</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <?php if ($i === $page): ?>
        <span class="current" aria-current="page"><?= $i ?></span>
        <?php elseif ($i === 1 || $i === $total_pages || abs($i - $page) <= 1): ?>
        <a href="/blog/?page=<?= $i ?>"><?= $i ?></a>
        <?php elseif (abs($i - $page) === 2): ?>
        <span style="border:none;color:#a09080;">…</span>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if ($page < $total_pages): ?>
      <a href="/blog/?page=<?= $page + 1 ?>" aria-label="Page suivante">›</a>
      <?php endif; ?>
    </nav>
    <?php endif; ?>

    <?php else: ?>
    <div style="text-align:center;padding:4rem 0;color:#8a7060;">
      <div style="font-size:3rem;margin-bottom:1rem;">📝</div>
      <h3>Aucun article pour le moment</h3>
      <p>Revenez bientôt, notre rédaction prépare du contenu.</p>
      <a href="/" class="btn mt-2">Retour à l'accueil</a>
    </div>
    <?php endif; ?>

  </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
