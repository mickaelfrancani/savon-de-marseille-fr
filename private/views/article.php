<?php
/**
 * views/article.php
 * Template article blog — savon-de-marseille.fr
 *
 * Variables attendues (depuis le router) :
 *   $article  array  {
 *     id, slug, title, excerpt, content (HTML),
 *     author, date_published, date_modified,
 *     category_label, category_slug, image_url, tags[]
 *   }
 *   $articles_recents  array  [{id, slug, title, date_published}]
 *   $fabricants_sidebar array [{slug, name, ville}]
 */

// Valeurs par défaut pour l'aperçu standalone
if (!isset($article)) {
  $article = [
    'id'             => 1,
    'slug'           => 'exemple-article',
    'title'          => 'Comment reconnaître un vrai savon de Marseille ?',
    'excerpt'        => 'Les 5 critères essentiels pour ne plus jamais se faire avoir.',
    'content'        => '<h2 id="s1">1. Le marquage à chaud</h2><p>Contenu de démonstration…</p><h2 id="s2">2. La composition</h2><p>Contenu de démonstration…</p>',
    'author'         => 'La Rédaction',
    'date_published' => '2025-03-08',
    'date_modified'  => '2025-03-08',
    'category_label' => 'Authenticité',
    'category_slug'  => 'authenticite',
    'image_url'      => '',
    'tags'           => ['authenticité','guide','savon'],
  ];
  $articles_recents    = [];
  $fabricants_sidebar  = [];
}

$date_fmt = function($d) { return (new DateTime($d))->format('j F Y'); };

$page_title       = $article['title'];
$page_description = $article['excerpt'];
$page_canonical   = 'https://savon-de-marseille.fr/blog/' . $article['slug'] . '/';
if (!empty($article['image_url'])) {
  $page_og_image = $article['image_url'];
}

$page_schema = json_encode([
  '@context'         => 'https://schema.org',
  '@type'            => 'Article',
  'headline'         => $article['title'],
  'description'      => $article['excerpt'],
  'author'           => ['@type' => 'Organization', 'name' => $article['author']],
  'publisher'        => ['@type' => 'Organization', 'name' => 'savon-de-marseille.fr', 'url' => 'https://savon-de-marseille.fr'],
  'datePublished'    => $article['date_published'],
  'dateModified'     => $article['date_modified'],
  'url'              => $page_canonical,
  'inLanguage'       => 'fr-FR',
  'image'            => !empty($article['image_url']) ? $article['image_url'] : 'https://savon-de-marseille.fr/img/og-default.jpg',
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

$breadcrumb = [
  ['label' => 'Blog', 'url' => '/blog/'],
  ['label' => $article['category_label'], 'url' => '/blog/categorie/' . $article['category_slug'] . '/'],
  ['label' => $article['title']],
];

include ROOT . '/views/includes/header.php';
?>

<main class="section">
  <div class="container">
    <div class="article-layout">

      <!-- ── Contenu principal ──────────────────── -->
      <article>
        <header class="article-header">
          <span class="card-category"><?= htmlspecialchars($article['category_label']) ?></span>
          <h1><?= htmlspecialchars($article['title']) ?></h1>
          <div class="article-meta">
            <span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
              <?= htmlspecialchars($article['author']) ?>
            </span>
            <span>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              <time datetime="<?= htmlspecialchars($article['date_published']) ?>">
                <?= $date_fmt($article['date_published']) ?>
              </time>
            </span>
            <?php if ($article['date_modified'] !== $article['date_published']): ?>
            <span style="font-style:italic;color:#a09080;">
              Mis à jour : <time datetime="<?= htmlspecialchars($article['date_modified']) ?>"><?= $date_fmt($article['date_modified']) ?></time>
            </span>
            <?php endif; ?>
          </div>

          <?php if (!empty($article['image_url'])): ?>
          <img src="<?= htmlspecialchars($article['image_url']) ?>"
               alt="<?= htmlspecialchars($article['title']) ?>"
               style="width:100%;border-radius:6px;margin-bottom:1.5rem;"
               loading="lazy">
          <?php endif; ?>
        </header>

        <!-- Table des matières (auto-générée par JS) -->
        <div class="article-toc" id="toc-wrapper">
          <h4>Sommaire</h4>
          <ol id="article-toc"></ol>
        </div>

        <!-- Corps de l'article -->
        <div class="article-body">
          <?= $article['content'] /* HTML de confiance, échappé côté BDD */ ?>
        </div>

        <!-- Tags -->
        <?php if (!empty($article['tags'])): ?>
        <div style="margin-top:2.5rem;padding-top:1.5rem;border-top:1px solid rgba(200,169,110,.2);">
          <span style="font-size:.8rem;font-weight:700;color:var(--olive);text-transform:uppercase;letter-spacing:.07em;">Tags : </span>
          <?php foreach ($article['tags'] as $tag): ?>
          <a href="/blog/tag/<?= urlencode($tag) ?>/"
             style="display:inline-block;margin:.2rem;padding:.2rem .7rem;background:rgba(107,123,58,.1);color:var(--olive);border-radius:20px;font-size:.78rem;border:1px solid rgba(107,123,58,.25);">
            <?= htmlspecialchars($tag) ?>
          </a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </article>

      <!-- ── Sidebar ────────────────────────────── -->
      <aside class="sidebar" aria-label="Informations complémentaires">

        <!-- Articles récents -->
        <div class="sidebar-widget">
          <h4>Articles récents</h4>
          <?php if (!empty($articles_recents)): ?>
          <ul class="sidebar-list">
            <?php foreach ($articles_recents as $rec): ?>
            <li>
              <a href="/blog/<?= htmlspecialchars($rec['slug']) ?>/"><?= htmlspecialchars($rec['title']) ?></a>
              <div style="font-size:.75rem;color:#a09080;margin-top:.2rem;"><?= $date_fmt($rec['date_published']) ?></div>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php else: ?>
          <p style="font-size:.85rem;color:#8a7060;">Bientôt disponible…</p>
          <?php endif; ?>
        </div>

        <!-- Fabricants à découvrir -->
        <div class="sidebar-widget">
          <h4>Fabricants à découvrir</h4>
          <?php if (!empty($fabricants_sidebar)): ?>
          <ul class="sidebar-list">
            <?php foreach ($fabricants_sidebar as $f): ?>
            <li>
              <a href="/fabricants/<?= htmlspecialchars($f['slug']) ?>/"><?= htmlspecialchars($f['name']) ?></a>
              <div style="font-size:.75rem;color:#a09080;margin-top:.2rem;"><?= htmlspecialchars($f['ville']) ?></div>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php else: ?>
          <p style="font-size:.85rem;color:#8a7060;">Voir l'<a href="/fabricants/">annuaire complet</a></p>
          <?php endif; ?>
        </div>

        <!-- CTA Comparatif -->
        <div class="sidebar-widget" style="background:var(--beige);border:1px solid rgba(200,169,110,.3);text-align:center;">
          <h4 style="margin-bottom:.75rem;">Comparer les produits</h4>
          <p style="font-size:.85rem;color:#6b5a4e;margin-bottom:1rem;">Filtrez par prix, huile, certification et trouvez votre savon idéal.</p>
          <a href="/comparatif/" class="btn" style="font-size:.85rem;">Voir le comparatif</a>
        </div>

      </aside>

    </div>
  </div>
</main>

<?php include ROOT . '/views/includes/footer.php'; ?>
