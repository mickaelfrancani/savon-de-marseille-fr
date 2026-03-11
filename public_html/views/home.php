<?php
// Schema.org WebSite + SearchAction
$schemaOrg = json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebSite',
            '@id' => SITE_URL . '/#website',
            'url' => SITE_URL . '/',
            'name' => 'Savon de Marseille',
            'description' => 'Le guide de reference sur le savon de Marseille authentique',
            'inLanguage' => 'fr-FR',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => SITE_URL . '/blog/?s={search_term_string}'
                ],
                'query-input' => 'required name=search_term_string'
            ]
        ],
        [
            '@type' => 'Organization',
            '@id' => SITE_URL . '/#organization',
            'name' => 'Savon de Marseille',
            'url' => SITE_URL . '/',
            'logo' => SITE_URL . '/img/logo.png'
        ]
    ]
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

require ROOT_PATH . '/includes/header.php';
?>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <h1>Le Savon de Marseille Authentique</h1>
        <p class="hero-subtitle">Guide complet, fabricants certifies et conseils pratiques pour choisir le vrai savon de Marseille.</p>
        <div class="hero-cta">
            <a href="/guide/" class="btn btn-primary">Lire le guide</a>
            <a href="/comparatif/" class="btn btn-secondary">Comparer les savons</a>
        </div>
    </div>
</section>

<!-- Articles piliers -->
<?php if (!empty($piliers)): ?>
<section class="section-piliers">
    <div class="container">
        <h2>Les incontournables</h2>
        <div class="grid grid-3">
            <?php foreach ($piliers as $pilier): ?>
            <article class="card">
                <h3><a href="/blog/<?= htmlspecialchars($pilier['slug']) ?>/"><?= htmlspecialchars($pilier['titre']) ?></a></h3>
                <?php if (!empty($pilier['extrait'])): ?>
                <p><?= htmlspecialchars(mb_substr(strip_tags($pilier['extrait']), 0, 150)) ?>...</p>
                <?php endif; ?>
                <a href="/blog/<?= htmlspecialchars($pilier['slug']) ?>/" class="read-more">Lire la suite &rarr;</a>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Fabricants mis en avant -->
<?php if (!empty($fabricants)): ?>
<section class="section-fabricants">
    <div class="container">
        <h2>Les savonneries authentiques</h2>
        <p class="section-intro">Decouvrez les fabricants qui perpetuent la tradition du vrai savon de Marseille.</p>
        <div class="grid grid-4">
            <?php foreach (array_slice($fabricants, 0, 8) as $fab): ?>
            <div class="fabricant-card">
                <h3><a href="/fabricants/<?= htmlspecialchars($fab['slug']) ?>/"><?= htmlspecialchars($fab['nom']) ?></a></h3>
                <?php if (!empty($fab['ville'])): ?>
                <p class="fabricant-ville"><?= htmlspecialchars($fab['ville']) ?></p>
                <?php endif; ?>
                <?php if (!empty($fab['annee_fondation'])): ?>
                <p class="fabricant-annee">Depuis <?= htmlspecialchars($fab['annee_fondation']) ?></p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <a href="/fabricants/" class="btn btn-outline">Voir tous les fabricants</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Articles recents -->
<?php if (!empty($recentArticles)): ?>
<section class="section-blog">
    <div class="container">
        <h2>Derniers articles</h2>
        <div class="grid grid-3">
            <?php foreach ($recentArticles as $article): ?>
            <article class="card">
                <div class="card-meta">
                    <time datetime="<?= htmlspecialchars($article['date_publication']) ?>">
                        <?= htmlspecialchars(date('d/m/Y', strtotime($article['date_publication']))) ?>
                    </time>
                    <?php if (!empty($article['categorie_nom'])): ?>
                    <span class="tag"><?= htmlspecialchars($article['categorie_nom']) ?></span>
                    <?php endif; ?>
                </div>
                <h3><a href="/blog/<?= htmlspecialchars($article['slug']) ?>/"><?= htmlspecialchars($article['titre']) ?></a></h3>
                <?php if (!empty($article['extrait'])): ?>
                <p><?= htmlspecialchars(mb_substr(strip_tags($article['extrait']), 0, 120)) ?>...</p>
                <?php endif; ?>
            </article>
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <a href="/blog/" class="btn btn-outline">Voir tous les articles</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Top produits -->
<?php if (!empty($topProduits)): ?>
<section class="section-produits">
    <div class="container">
        <h2>Notre selection</h2>
        <div class="produits-grid">
            <?php foreach ($topProduits as $produit): ?>
            <div class="produit-card">
                <h3><?= htmlspecialchars($produit['nom']) ?></h3>
                <p class="produit-fabricant">par <a href="/fabricants/<?= htmlspecialchars($produit['fabricant_slug']) ?>/"><?= htmlspecialchars($produit['fabricant_nom']) ?></a></p>
                <?php if (!empty($produit['prix_euros'])): ?>
                <p class="produit-prix"><?= number_format($produit['prix_euros'], 2, ',', ' ') ?> &euro;</p>
                <?php endif; ?>
                <?php if ($produit['certifie']): ?>
                <span class="badge-certifie">Certifie</span>
                <?php endif; ?>
                <?php if (!empty($produit['url_achat'])): ?>
                <?php
                    // Trouver l'ID du lien affilié pour ce produit
                    $db = getDB();
                    $stmtAff = $db->prepare('SELECT id FROM affiliate_links WHERE url_destination LIKE :url LIMIT 1');
                    $stmtAff->execute([':url' => '%' . $produit['fabricant_slug'] . '%']);
                    $affLink = $stmtAff->fetch();
                ?>
                <?php if ($affLink): ?>
                <a href="/go/<?= (int)$affLink['id'] ?>/" class="btn btn-buy" rel="nofollow sponsored" target="_blank">Voir le produit</a>
                <?php else: ?>
                <a href="<?= htmlspecialchars($produit['url_achat']) ?>" class="btn btn-buy" rel="nofollow sponsored" target="_blank">Voir le produit</a>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require ROOT_PATH . '/includes/footer.php'; ?>
