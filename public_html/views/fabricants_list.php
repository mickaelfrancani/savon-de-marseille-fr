<?php
$schemaOrg = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'name' => 'Fabricants de savon de Marseille',
    'url' => $canonicalUrl,
    'numberOfItems' => count($fabricants),
    'itemListElement' => array_map(function($f, $i) {
        return [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'item' => [
                '@type' => 'LocalBusiness',
                'name' => $f['nom'],
                'url' => SITE_URL . '/fabricants/' . $f['slug'] . '/',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => $f['ville'] ?? '',
                    'addressCountry' => 'FR'
                ]
            ]
        ];
    }, $fabricants, array_keys($fabricants))
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

// Leaflet.js pour la carte
$extraHead = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">';

require ROOT_PATH . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <h1>Fabricants de Savon de Marseille</h1>
        <p>Decouvrez les savonneries authentiques qui perpetuent la tradition provencale.</p>
    </div>
</section>

<!-- Carte Leaflet -->
<section class="fabricants-map-section">
    <div class="container">
        <h2>Carte des savonneries</h2>
        <div id="map-fabricants" style="height: 450px; border-radius: 8px;"></div>
    </div>
</section>

<!-- Liste fabricants -->
<section class="fabricants-list-section">
    <div class="container">
        <?php if (empty($fabricants)): ?>
        <p class="no-content">Aucun fabricant repertorie pour le moment.</p>
        <?php else: ?>
        <div class="grid grid-3">
            <?php foreach ($fabricants as $fab): ?>
            <article class="fabricant-card card">
                <h2 class="card-title">
                    <a href="/fabricants/<?= htmlspecialchars($fab['slug']) ?>/"><?= htmlspecialchars($fab['nom']) ?></a>
                </h2>
                <?php if (!empty($fab['ville'])): ?>
                <p class="fabricant-location">
                    <span class="icon-location">&#x1F4CD;</span>
                    <?= htmlspecialchars($fab['ville']) ?>
                    <?php if (!empty($fab['departement'])): ?>
                    - <?= htmlspecialchars($fab['departement']) ?>
                    <?php endif; ?>
                </p>
                <?php endif; ?>
                <?php if (!empty($fab['annee_fondation'])): ?>
                <p class="fabricant-annee">Fondee en <?= htmlspecialchars($fab['annee_fondation']) ?></p>
                <?php endif; ?>
                <?php if (!empty($fab['certifications'])): ?>
                <p class="fabricant-certif"><span class="badge-certifie"><?= htmlspecialchars($fab['certifications']) ?></span></p>
                <?php endif; ?>
                <?php if (!empty($fab['description'])): ?>
                <p class="fabricant-excerpt"><?= htmlspecialchars(mb_substr($fab['description'], 0, 120)) ?>...</p>
                <?php endif; ?>
                <a href="/fabricants/<?= htmlspecialchars($fab['slug']) ?>/" class="read-more">Voir la fiche &rarr;</a>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV/XN/WLs=" crossorigin=""></script>
<script>
(function() {
    var map = L.map('map-fabricants').setView([43.2965, 5.3698], 7);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 18
    }).addTo(map);

    // Charger les fabricants via API
    fetch('/api/fabricants.json')
        .then(function(r) { return r.json(); })
        .then(function(data) {
            data.features.forEach(function(feature) {
                var coords = feature.geometry.coordinates;
                var props = feature.properties;
                var marker = L.marker([coords[1], coords[0]]);
                marker.bindPopup(
                    '<strong><a href="/fabricants/' + props.slug + '/">' + props.nom + '</a></strong>' +
                    (props.ville ? '<br>' + props.ville : '')
                );
                marker.addTo(map);
            });
        })
        .catch(function(err) {
            console.log('Carte: impossible de charger les fabricants', err);
        });
})();
</script>

<?php require ROOT_PATH . '/includes/footer.php'; ?>
