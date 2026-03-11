<?php
/**
 * views/fabricant.php
 * Fiche fabricant — savon-de-marseille.fr
 *
 * Variables attendues (depuis le router) :
 *   $fabricant  array  {
 *     id, slug, name, ville, adresse, lat, lng, depuis,
 *     description (HTML), certifications[], affiliate_url,
 *     image_url, telephone, site_web, email
 *   }
 *   $articles_fabricant  array  [{slug, title, date_published}]
 */

if (!isset($fabricant)) {
  $fabricant = [
    'id'            => 1,
    'slug'          => 'savonnerie-marius-fabre',
    'name'          => 'Savonnerie Marius Fabre',
    'ville'         => 'Salon-de-Provence',
    'adresse'       => 'Chemin de Saint-Chamas, 13300 Salon-de-Provence',
    'lat'           => 43.6394,
    'lng'           => 5.0977,
    'depuis'        => '1900',
    'description'   => '<p>La Savonnerie Marius Fabre est l\'une des dernières manufactures à fabriquer le savon de Marseille dans les règles de l\'art, selon la méthode du chaudron au feu direct.</p><p>Fondée en 1900, elle reste une référence incontournable pour quiconque cherche un savon de Marseille authentique.</p>',
    'certifications'=> ['Nature & Progrès', 'Tradition marseillaise', 'Made in France'],
    'affiliate_url' => 'https://savon-de-marseille.fr/go/1/',
    'image_url'     => '',
    'telephone'     => '+33 4 90 53 82 75',
    'site_web'      => 'https://www.marius-fabre.fr',
    'email'         => '',
  ];
  $articles_fabricant = [];
}

$page_title       = $fabricant['name'] . ' — Savonnerie à ' . $fabricant['ville'];
$page_description = 'Découvrez ' . $fabricant['name'] . ', savonnerie artisanale à ' . $fabricant['ville'] . ' depuis ' . $fabricant['depuis'] . '. Certifications, produits et infos pratiques.';
$page_canonical   = 'https://savon-de-marseille.fr/fabricants/' . $fabricant['slug'] . '/';

$page_schema = json_encode([
  '@context'    => 'https://schema.org',
  '@type'       => 'LocalBusiness',
  'name'        => $fabricant['name'],
  'description' => strip_tags($fabricant['description']),
  'address'     => [
    '@type'           => 'PostalAddress',
    'addressLocality' => $fabricant['ville'],
    'addressCountry'  => 'FR',
    'streetAddress'   => $fabricant['adresse'],
  ],
  'geo'     => ['@type' => 'GeoCoordinates', 'latitude' => $fabricant['lat'], 'longitude' => $fabricant['lng']],
  'url'     => $page_canonical,
  'telephone' => $fabricant['telephone'] ?? '',
  'foundingDate' => $fabricant['depuis'],
  'inLanguage' => 'fr-FR',
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

$breadcrumb = [
  ['label' => 'Fabricants', 'url' => '/fabricants/'],
  ['label' => $fabricant['name']],
];

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';

// Leaflet CSS dans <head> : on l'injecte ici proprement
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV/XN/WLEg=" crossorigin="" defer></script>
<?php

// ──────────────────────────────────────────────────────
?>

<div class="fabricant-hero">
  <div class="container">
    <div class="fabricant-header">

      <!-- Info -->
      <div class="fabricant-info">
        <span class="card-category">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Savonnerie
        </span>
        <h1><?= htmlspecialchars($fabricant['name']) ?></h1>

        <div class="fabricant-meta">
          <span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?= htmlspecialchars($fabricant['ville']) ?>
          </span>
          <span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Depuis <?= htmlspecialchars($fabricant['depuis']) ?>
          </span>
          <?php if (!empty($fabricant['telephone'])): ?>
          <span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13.1 19.79 19.79 0 0 1 1.61 4.48 2 2 0 0 1 3.58 2.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.1 6.1l1.2-1.2a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            <a href="tel:<?= htmlspecialchars($fabricant['telephone']) ?>"><?= htmlspecialchars($fabricant['telephone']) ?></a>
          </span>
          <?php endif; ?>
        </div>

        <div class="fabricant-badges">
          <?php foreach ($fabricant['certifications'] as $cert): ?>
          <span class="badge badge--olive">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
            <?= htmlspecialchars($cert) ?>
          </span>
          <?php endforeach; ?>
        </div>

        <!-- CTA Achat affilié -->
        <?php if (!empty($fabricant['affiliate_url'])): ?>
        <div class="fabricant-cta">
          <p>Achetez directement sur le site officiel et soutenez cette savonnerie artisanale.</p>
          <a href="<?= htmlspecialchars($fabricant['affiliate_url']) ?>"
             class="btn"
             rel="nofollow sponsored"
             target="_blank">
            🛒 Acheter sur leur site
          </a>
          <div style="font-size:.72rem;color:#a09080;margin-top:.6rem;">
            Lien affilié — nos avis restent indépendants
          </div>
        </div>
        <?php endif; ?>
      </div>

      <!-- Carte Leaflet -->
      <div class="map-container">
        <div id="leaflet-map"
             data-lat="<?= htmlspecialchars($fabricant['lat']) ?>"
             data-lng="<?= htmlspecialchars($fabricant['lng']) ?>"
             data-name="<?= htmlspecialchars($fabricant['name']) ?>"
             aria-label="Carte de localisation de <?= htmlspecialchars($fabricant['name']) ?>">
        </div>
      </div>

    </div>
  </div>
</div>

<main class="section">
  <div class="container">
    <div class="article-layout">

      <!-- Description -->
      <div>
        <h2>À propos de <?= htmlspecialchars($fabricant['name']) ?></h2>
        <div class="article-body">
          <?= $fabricant['description'] ?>
        </div>

        <!-- Adresse -->
        <div style="background:var(--blanc);border-radius:6px;padding:1.25rem;margin-top:2rem;border:1px solid rgba(200,169,110,.2);">
          <h3 style="font-size:1rem;margin-bottom:.75rem;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:.4rem;" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            Adresse
          </h3>
          <address style="font-style:normal;color:#6b5a4e;"><?= htmlspecialchars($fabricant['adresse']) ?></address>
        </div>

        <?php if (!empty($articles_fabricant)): ?>
        <h2 style="margin-top:3rem;">Articles sur <?= htmlspecialchars($fabricant['name']) ?></h2>
        <ul class="sidebar-list" style="background:var(--blanc);border-radius:6px;padding:1rem 1.25rem;box-shadow:var(--shadow);">
          <?php foreach ($articles_fabricant as $art): ?>
          <li>
            <a href="/blog/<?= htmlspecialchars($art['slug']) ?>/"><?= htmlspecialchars($art['title']) ?></a>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </div>

      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="sidebar-widget" style="text-align:center;">
          <h4>Visiter leur site</h4>
          <p style="font-size:.85rem;color:#6b5a4e;margin-bottom:1rem;">Commandez directement auprès du fabricant.</p>
          <?php if (!empty($fabricant['affiliate_url'])): ?>
          <a href="<?= htmlspecialchars($fabricant['affiliate_url']) ?>"
             class="btn btn--olive"
             rel="nofollow sponsored"
             target="_blank">
            Acheter sur leur site
          </a>
          <?php endif; ?>
          <?php if (!empty($fabricant['site_web'])): ?>
          <div style="margin-top:.75rem;">
            <a href="<?= htmlspecialchars($fabricant['site_web']) ?>"
               style="font-size:.82rem;color:#8a7060;"
               rel="nofollow"
               target="_blank">
              <?= htmlspecialchars(parse_url($fabricant['site_web'], PHP_URL_HOST) ?: $fabricant['site_web']) ?>
            </a>
          </div>
          <?php endif; ?>
        </div>

        <div class="sidebar-widget">
          <h4>Certifications</h4>
          <ul style="display:flex;flex-direction:column;gap:.5rem;">
            <?php foreach ($fabricant['certifications'] as $cert): ?>
            <li style="display:flex;align-items:center;gap:.5rem;font-size:.88rem;">
              <span class="cert-dot cert-dot--yes"></span>
              <?= htmlspecialchars($cert) ?>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="sidebar-widget">
          <h4>Comparer les produits</h4>
          <p style="font-size:.85rem;color:#6b5a4e;margin-bottom:.75rem;">Comparez ce fabricant avec d'autres savonneries.</p>
          <a href="/comparatif/" class="btn btn--outline" style="font-size:.85rem;width:100%;text-align:center;">Voir le comparatif</a>
        </div>
      </aside>

    </div>
  </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
