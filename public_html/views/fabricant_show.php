<?php
// Schema.org LocalBusiness
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => $fabricant['nom'],
    'url' => $canonicalUrl,
    'description' => $fabricant['description'] ?? '',
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => $fabricant['ville'] ?? '',
        'addressRegion' => $fabricant['departement'] ?? 'Provence',
        'addressCountry' => 'FR'
    ]
];

if (!empty($fabricant['latitude']) && !empty($fabricant['longitude'])) {
    $schema['geo'] = [
        '@type' => 'GeoCoordinates',
        'latitude' => $fabricant['latitude'],
        'longitude' => $fabricant['longitude']
    ];
}

if (!empty($fabricant['url_officielle'])) {
    $schema['sameAs'] = $fabricant['url_officielle'];
}

if (!empty($fabricant['annee_fondation'])) {
    $schema['foundingDate'] = $fabricant['annee_fondation'];
}

$schemaOrg = json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

require ROOT_PATH . '/includes/header.php';
?>

<article class="fabricant-single" itemscope itemtype="https://schema.org/LocalBusiness">
    <div class="container">

        <nav class="breadcrumb" aria-label="Fil d'Ariane">
            <ol>
                <li><a href="/">Accueil</a></li>
                <li><a href="/fabricants/">Fabricants</a></li>
                <li aria-current="page"><?= htmlspecialchars($fabricant['nom']) ?></li>
            </ol>
        </nav>

        <header class="fabricant-header">
            <h1 itemprop="name"><?= htmlspecialchars($fabricant['nom']) ?></h1>
            <div class="fabricant-info-bar">
                <?php if (!empty($fabricant['ville'])): ?>
                <span class="info-item">
                    &#x1F4CD; <span itemprop="addressLocality"><?= htmlspecialchars($fabricant['ville']) ?></span>
                    <?php if (!empty($fabricant['departement'])): ?>
                    , <?= htmlspecialchars($fabricant['departement']) ?>
                    <?php endif; ?>
                </span>
                <?php endif; ?>
                <?php if (!empty($fabricant['annee_fondation'])): ?>
                <span class="info-item">&#x1F4C5; Depuis <?= htmlspecialchars($fabricant['annee_fondation']) ?></span>
                <?php endif; ?>
                <?php if (!empty($fabricant['certifications'])): ?>
                <span class="info-item badge-certifie"><?= htmlspecialchars($fabricant['certifications']) ?></span>
                <?php endif; ?>
            </div>
        </header>

        <div class="fabricant-body">
            <?php if (!empty($fabricant['description'])): ?>
            <div class="fabricant-description" itemprop="description">
                <h2>Presentation</h2>
                <p><?= nl2br(htmlspecialchars($fabricant['description'])) ?></p>
            </div>
            <?php endif; ?>

            <?php if (!empty($fabricant['methode'])): ?>
            <div class="fabricant-methode">
                <h2>Methode de fabrication</h2>
                <p><?= nl2br(htmlspecialchars($fabricant['methode'])) ?></p>
            </div>
            <?php endif; ?>

            <!-- Produits -->
            <?php if (!empty($produits)): ?>
            <section class="fabricant-produits">
                <h2>Produits disponibles</h2>
                <div class="produits-grid">
                    <?php foreach ($produits as $produit): ?>
                    <div class="produit-card">
                        <h3><?= htmlspecialchars($produit['nom']) ?></h3>
                        <div class="produit-details">
                            <?php if (!empty($produit['poids_grammes'])): ?>
                            <span><?= htmlspecialchars($produit['poids_grammes']) ?>g</span>
                            <?php endif; ?>
                            <?php if (!empty($produit['type_huile'])): ?>
                            <span><?= htmlspecialchars($produit['type_huile']) ?></span>
                            <?php endif; ?>
                            <?php if (!empty($produit['prix_euros'])): ?>
                            <span class="produit-prix"><?= number_format($produit['prix_euros'], 2, ',', ' ') ?> &euro;</span>
                            <?php endif; ?>
                            <?php if ($produit['certifie']): ?>
                            <span class="badge-certifie">Certifie</span>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($produit['description'])): ?>
                        <p><?= htmlspecialchars(mb_substr($produit['description'], 0, 150)) ?>...</p>
                        <?php endif; ?>
                        <?php if (!empty($produit['url_achat'])): ?>
                        <a href="<?= htmlspecialchars($produit['url_achat']) ?>" class="btn btn-buy" rel="nofollow sponsored" target="_blank">
                            Acheter &rarr;
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>

            <!-- Site officiel -->
            <?php if (!empty($fabricant['url_officielle'])): ?>
            <div class="fabricant-links">
                <a href="<?= htmlspecialchars($fabricant['url_officielle']) ?>" class="btn btn-outline" rel="noopener" target="_blank" itemprop="url">
                    Visiter le site officiel &rarr;
                </a>
            </div>
            <?php endif; ?>
        </div>

        <footer class="fabricant-footer">
            <a href="/fabricants/" class="btn btn-outline">&larr; Tous les fabricants</a>
        </footer>
    </div>
</article>

<?php require ROOT_PATH . '/includes/footer.php'; ?>
