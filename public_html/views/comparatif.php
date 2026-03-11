<?php
// Schema.org pour le comparatif
$schemaItems = [];
foreach ($produits as $i => $p) {
    $item = [
        '@type' => 'Product',
        'name' => $p['nom'],
        'brand' => [
            '@type' => 'Brand',
            'name' => $p['fabricant_nom']
        ]
    ];
    if (!empty($p['prix_euros'])) {
        $item['offers'] = [
            '@type' => 'Offer',
            'priceCurrency' => 'EUR',
            'price' => $p['prix_euros'],
            'availability' => 'https://schema.org/InStock'
        ];
    }
    if (!empty($p['note_editoriale'])) {
        $item['aggregateRating'] = [
            '@type' => 'AggregateRating',
            'ratingValue' => $p['note_editoriale'],
            'bestRating' => '5',
            'ratingCount' => '1'
        ];
    }
    $schemaItems[] = $item;
    if ($i >= 9) break; // max 10 produits dans le schema
}

$schemaOrg = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'name' => 'Comparatif savons de Marseille',
    'url' => $canonicalUrl,
    'itemListElement' => $schemaItems
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

require ROOT_PATH . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <h1>Comparatif Savons de Marseille 2026</h1>
        <p>Notre guide pour choisir le meilleur savon de Marseille authentique selon vos besoins.</p>
    </div>
</section>

<div class="container">

    <!-- Filtres -->
    <div class="comparatif-filters">
        <button class="filter-btn active" data-filter="all">Tous</button>
        <button class="filter-btn" data-filter="certifie">Certifies</button>
        <button class="filter-btn" data-filter="top">Mieux notes</button>
    </div>

    <!-- Top selectes -->
    <?php if (!empty($topRated)): ?>
    <section class="comparatif-top">
        <h2>Notre selection</h2>
        <div class="grid grid-3">
            <?php foreach ($topRated as $rank => $produit): ?>
            <div class="produit-card produit-top" data-certifie="<?= $produit['certifie'] ? '1' : '0' ?>">
                <div class="rank-badge">#<?= $rank + 1 ?></div>
                <h3><?= htmlspecialchars($produit['nom']) ?></h3>
                <p class="produit-fabricant">
                    <a href="/fabricants/<?= htmlspecialchars($produit['fabricant_slug']) ?>/"><?= htmlspecialchars($produit['fabricant_nom']) ?></a>
                </p>
                <div class="produit-details">
                    <?php if (!empty($produit['poids_grammes'])): ?>
                    <span><?= htmlspecialchars($produit['poids_grammes']) ?>g</span>
                    <?php endif; ?>
                    <?php if (!empty($produit['prix_euros'])): ?>
                    <span class="produit-prix"><?= number_format($produit['prix_euros'], 2, ',', ' ') ?> &euro;</span>
                    <?php endif; ?>
                    <?php if ($produit['certifie']): ?>
                    <span class="badge-certifie">Certifie</span>
                    <?php endif; ?>
                </div>
                <?php if (!empty($produit['note_editoriale'])): ?>
                <div class="produit-note" aria-label="Note: <?= htmlspecialchars($produit['note_editoriale']) ?>/5">
                    <?= str_repeat('&#9733;', (int)$produit['note_editoriale']) ?><?= str_repeat('&#9734;', 5 - (int)$produit['note_editoriale']) ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($produit['url_achat'])): ?>
                <a href="<?= htmlspecialchars($produit['url_achat']) ?>" class="btn btn-buy" rel="nofollow sponsored" target="_blank">Voir le prix &rarr;</a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Tableau comparatif complet -->
    <?php if (!empty($produits)): ?>
    <section class="comparatif-tableau">
        <h2>Tableau comparatif complet</h2>
        <div class="table-wrapper">
            <table class="comparatif-table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Fabricant</th>
                        <th>Poids</th>
                        <th>Prix</th>
                        <th>Type d'huile</th>
                        <th>Certifie</th>
                        <th>Note</th>
                        <th>Achat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $p): ?>
                    <tr class="<?= $p['certifie'] ? 'row-certifie' : '' ?>" data-certifie="<?= $p['certifie'] ? '1' : '0' ?>">
                        <td><strong><?= htmlspecialchars($p['nom']) ?></strong></td>
                        <td><a href="/fabricants/<?= htmlspecialchars($p['fabricant_slug']) ?>/"><?= htmlspecialchars($p['fabricant_nom']) ?></a></td>
                        <td><?= !empty($p['poids_grammes']) ? htmlspecialchars($p['poids_grammes']) . 'g' : '-' ?></td>
                        <td><?= !empty($p['prix_euros']) ? number_format($p['prix_euros'], 2, ',', ' ') . ' &euro;' : '-' ?></td>
                        <td><?= !empty($p['type_huile']) ? htmlspecialchars($p['type_huile']) : '-' ?></td>
                        <td><?= $p['certifie'] ? '<span class="badge-certifie">Oui</span>' : '-' ?></td>
                        <td><?= !empty($p['note_editoriale']) ? htmlspecialchars($p['note_editoriale']) . '/5' : '-' ?></td>
                        <td>
                            <?php if (!empty($p['url_achat'])): ?>
                            <a href="<?= htmlspecialchars($p['url_achat']) ?>" class="btn-sm btn-buy" rel="nofollow sponsored" target="_blank">Voir</a>
                            <?php else: ?>-<?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php endif; ?>

</div>

<script>
// Filtrage tableau comparatif
document.querySelectorAll('.filter-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(function(b) { b.classList.remove('active'); });
        this.classList.add('active');
        var filter = this.getAttribute('data-filter');
        document.querySelectorAll('[data-certifie]').forEach(function(el) {
            if (filter === 'all') {
                el.style.display = '';
            } else if (filter === 'certifie') {
                el.style.display = el.getAttribute('data-certifie') === '1' ? '' : 'none';
            }
        });
    });
});
</script>

<?php require ROOT_PATH . '/includes/footer.php'; ?>
