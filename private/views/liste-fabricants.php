<?php
$data['schema_json'] = json_encode([
  "@context" => "https://schema.org",
  "@type"    => "ItemList",
  "name"     => $data['page_title'],
  "itemListElement" => array_map(function($f, $i) {
    return ["@type" => "ListItem", "position" => $i + 1, "name" => $f['nom'], "url" => SITE_URL . '/fabricants/' . $f['slug']];
  }, $data['fabricants'], array_keys($data['fabricants']))
]);
include ROOT . '/views/includes/header.php';
?>

<section class="article-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Fil d'Ariane">
      <a href="/">Accueil</a> &rsaquo;
      <span>Fabricants</span>
    </nav>
    <div class="article-header">
      <h1>Annuaire des Fabricants de Savon de Marseille</h1>
      <p class="article-chapeau"><?= count($data['fabricants']) ?> savonneries authentiques, sélectionnées pour leur respect des méthodes traditionnelles et la qualité de leurs produits.</p>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="fabricants-grid">
      <?php foreach ($data['fabricants'] as $f): ?>
      <div class="fabricant-card">
        <h3><a href="/fabricants/<?= htmlspecialchars($f['slug']) ?>"><?= htmlspecialchars($f['nom']) ?></a></h3>
        <div class="ville"><?= htmlspecialchars($f['ville']) ?></div>
        <?php if ($f['annee_fondation']): ?><div class="annee">Fondée en <?= $f['annee_fondation'] ?></div><?php endif; ?>
        <?php if (!empty($f['description'])): ?>
        <p><?= htmlspecialchars(mb_substr($f['description'], 0, 130)) ?>...</p>
        <?php endif; ?>
        <?php if (!empty($f['certifications'])): ?>
        <div style="margin-top:0.5rem;">
          <?php foreach (explode(',', $f['certifications']) as $cert): ?>
          <span class="badge"><?= htmlspecialchars(trim($cert)) ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <div style="margin-top:1rem;">
          <a href="/fabricants/<?= htmlspecialchars($f['slug']) ?>" class="btn btn-primary" style="font-size:0.85rem; padding:0.4rem 1rem;">Voir la fiche</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php if (!empty($data['map_data'])): ?>
<section class="bg-beige">
  <div class="container">
    <h2 class="section-title">Carte des savonneries</h2>
    <p class="section-subtitle">Localisation des fabricants authentiques en Provence et dans le Sud de la France</p>
    <div id="map"></div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    var fabricants = <?= $data['map_data'] ?>;
    var map = L.map('map').setView([43.45, 5.2], 9);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    fabricants.forEach(function(f) {
      if (f.lat && f.lng) {
        L.marker([f.lat, f.lng])
          .addTo(map)
          .bindPopup('<strong><a href="/fabricants/' + f.slug + '">' + f.nom + '</a></strong><br>' + f.ville);
      }
    });
    </script>
  </div>
</section>
<?php endif; ?>

<?php include ROOT . '/views/includes/footer.php'; ?>
