<?php
// Schema.org Article
$schemaOrg = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Article',
    'headline' => $article['titre'],
    'description' => $article['meta_description'] ?? '',
    'url' => $canonicalUrl,
    'datePublished' => $article['date_publication'],
    'dateModified' => $article['date_publication'],
    'author' => [
        '@type' => 'Organization',
        'name' => 'Savon de Marseille',
        'url' => SITE_URL . '/'
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => 'Savon de Marseille',
        'logo' => [
            '@type' => 'ImageObject',
            'url' => SITE_URL . '/img/logo.png'
        ]
    ],
    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => $canonicalUrl
    ]
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

require ROOT_PATH . '/includes/header.php';
?>

<article class="article-single" itemscope itemtype="https://schema.org/Article">
    <div class="container container-narrow">
        <header class="article-header">
            <?php if (!empty($article['categorie_nom'])): ?>
            <a href="/blog/" class="article-category"><?= htmlspecialchars($article['categorie_nom']) ?></a>
            <?php endif; ?>
            <h1 itemprop="headline"><?= htmlspecialchars($article['titre']) ?></h1>
            <div class="article-meta">
                <time datetime="<?= htmlspecialchars($article['date_publication']) ?>" itemprop="datePublished">
                    <?= htmlspecialchars(date('d F Y', strtotime($article['date_publication']))) ?>
                </time>
            </div>
        </header>

        <?php if (!empty($article['extrait'])): ?>
        <div class="article-excerpt">
            <p><strong><?= htmlspecialchars($article['extrait']) ?></strong></p>
        </div>
        <?php endif; ?>

        <div class="article-content" itemprop="articleBody">
            <?= $article['contenu'] ?>
        </div>

        <footer class="article-footer">
            <a href="/blog/" class="btn btn-outline">&larr; Retour au blog</a>
        </footer>
    </div>
</article>

<?php require ROOT_PATH . '/includes/footer.php'; ?>
