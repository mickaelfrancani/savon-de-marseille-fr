<?php
/**
 * views/comparatif.php
 * Comparateur de produits - savon-de-marseille.fr
 *
 * Variables attendues :
 *   $produits  array  [{
 *     id, fabricant_name, fabricant_slug, name, poids_g, prix_euros,
 *     huile_principale, taux_huile_pct, certifications[], affiliate_url,
 *     note_sur_5
 *   }]
 */

if (!isset($produits)) {
  // Données de démonstration
  $produits = [
    ['id'=>1,'fabricant_name'=>'Marius Fabre','fabricant_slug'=>'savonnerie-marius-fabre','name'=>'Savon de Marseille cube 400g','poids_g'=>400,'prix_euros'=>6.90,'huile_principale'=>'Olive','taux_huile_pct'=>72,'certifications'=>['Nature & Progrès'],'affiliate_url'=>'/go/1/','note_sur_5'=>4.8],
    ['id'=>2,'fabricant_name'=>'Fer à Cheval','fabricant_slug'=>'fer-a-cheval','name'=>'Vrai savon de Marseille 300g','poids_g'=>300,'prix_euros'=>4.50,'huile_principale'=>'Coprah','taux_huile_pct'=>72,'certifications'=>['Tradition'],'affiliate_url'=>'/go/2/','note_sur_5'=>4.5],
    ['id'=>3,'fabricant_name'=>'La Corvette','fabricant_slug'=>'la-corvette','name'=>'Savon liquide de Marseille 1L','poids_g'=>1000,'prix_euros'=>8.90,'huile_principale'=>'Olive','taux_huile_pct'=>63,'certifications'=>['Ecocert'],'affiliate_url'=>'/go/3/','note_sur_5'=>4.3],
    ['id'=>4,'fabricant_name'=>'Rampal Latour','fabricant_slug'=>'rampal-latour','name'=>'Savon de Marseille barre 200g','poids_g'=>200,'prix_euros'=>3.80,'huile_principale'=>'Olive','taux_huile_pct'=>72,'certifications'=>['Artisanal'],'affiliate_url'=>'/go/4/','note_sur_5'=>4.6],
    ['id'=>5,'fabricant_name'=>'Marius Fabre','fabricant_slug'=>'savonnerie-marius-fabre','name'=>'Savon de Marseille paillettes 750g','poids_g'=>750,'prix_euros'=>9.50,'huile_principale'=>'Olive','taux_huile_pct'=>72,'certifications'=>['Nature & Progrès','Bio'],'affiliate_url'=>'/go/5/','note_sur_5'=>4.9],
    ['id'=>6,'fabricant_name'=>'Fer à Cheval','fabricant_slug'=>'fer-a-cheval','name'=>'Cube savon de Marseille 600g','poids_g'=>600,'prix_euros'=>7.20,'huile_principale'=>'Coprah','taux_huile_pct'=>72,'certifications'=>['Tradition','Made in France'],'affiliate_url'=>'/go/6/','note_sur_5'=>4.4],
  ];
}

$page_title       = 'Comparatif Savons de Marseille 2025 - Filtrez par prix, huile, certification';
$page_description = 'Comparez les meilleurs savons de Marseille : prix, composition, certifications, fabricants. Filtres dynamiques pour trouver le produit idéal.';
$page_canonical   = 'https://savon-de-marseille.fr/comparatif/';

// Schema Product array
$schema_products = array_map(fn($p) => [
  '@type'       => 'Product',
  'name'        => $p['fabricant_name'] . ' - ' . $p['name'],
  'brand'       => ['@type' => 'Brand', 'name' => $p['fabricant_name']],
  'offers'      => ['@type' => 'Offer', 'price' => $p['prix_euros'], 'priceCurrency' => 'EUR', 'url' => 'https://savon-de-marseille.fr' . $p['affiliate_url']],
  'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => $p['note_sur_5'], 'bestRating' => 5, 'reviewCount' => 1],
], $produits);

$page_schema = json_encode([
  '@context' => 'https://schema.org',
  '@graph'   => $schema_products,
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

$breadcrumb = [['label' => 'Comparatif']];

include ROOT . '/views/includes/header.php';
?>

<div class="page-header">
  <div class="container">
    <h1>Comparatif Savons de Marseille</h1>
    <p>Filtrez par poids, huile, certification ou prix pour trouver le savon qui vous correspond.</p>
  </div>
</div>

<main class="section">
  <div class="container">

    <!-- Filtres -->
    <div class="comparatif-filters">

      <div class="filter-group">
        <label for="filter-poids">Poids</label>
        <select id="filter-poids">
          <option value="">Tous</option>
          <option value="100">100g</option>
          <option value="200">200g</option>
          <option value="300">300g</option>
          <option value="400">400g</option>
          <option value="600">600g</option>
          <option value="750">750g</option>
          <option value="1000">1 kg+</option>
        </select>
      </div>

      <div class="filter-group">
        <label for="filter-huile">Huile principale</label>
        <select id="filter-huile">
          <option value="">Toutes</option>
          <option value="Olive">Olive</option>
          <option value="Coprah">Coprah</option>
          <option value="Palme">Palme</option>
        </select>
      </div>

      <div class="filter-group">
        <label for="filter-cert">Certification</label>
        <select id="filter-cert">
          <option value="">Toutes</option>
          <option value="Nature &amp; Progrès">Nature &amp; Progrès</option>
          <option value="Ecocert">Ecocert</option>
          <option value="Bio">Bio</option>
          <option value="Tradition">Tradition</option>
          <option value="Made in France">Made in France</option>
        </select>
      </div>

      <div class="filter-group">
        <label for="filter-prix">Prix max (€)</label>
        <select id="filter-prix">
          <option value="">Sans limite</option>
          <option value="5">Moins de 5€</option>
          <option value="8">Moins de 8€</option>
          <option value="12">Moins de 12€</option>
          <option value="20">Moins de 20€</option>
        </select>
      </div>

      <div style="align-self:flex-end;">
        <span id="comparatif-count" style="font-size:.85rem;color:var(--olive);font-weight:700;">
          <?= count($produits) ?> produit<?= count($produits) > 1 ? 's' : '' ?>
        </span>
      </div>

    </div>

    <!-- Tableau -->
    <div class="table-wrap">
      <table class="comparatif-table" id="comparatif-table">
        <thead>
          <tr>
            <th data-sort="fabricant">Fabricant <span class="sort-icon">↕</span></th>
            <th data-sort="produit">Produit <span class="sort-icon">↕</span></th>
            <th data-sort="poids">Poids <span class="sort-icon">↕</span></th>
            <th data-sort="huile">Huile <span class="sort-icon">↕</span></th>
            <th data-sort="taux">% Huile <span class="sort-icon">↕</span></th>
            <th data-sort="cert">Certif. <span class="sort-icon">↕</span></th>
            <th data-sort="note">Note <span class="sort-icon">↕</span></th>
            <th data-sort="prix">Prix <span class="sort-icon">↕</span></th>
            <th>Acheter</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($produits as $p): ?>
          <tr data-row
              data-fabricant="<?= htmlspecialchars($p['fabricant_name']) ?>"
              data-produit="<?= htmlspecialchars($p['name']) ?>"
              data-poids="<?= (int)$p['poids_g'] ?>"
              data-huile="<?= htmlspecialchars($p['huile_principale']) ?>"
              data-taux="<?= (int)$p['taux_huile_pct'] ?>"
              data-cert="<?= htmlspecialchars($p['certifications'][0] ?? '') ?>"
              data-note="<?= (float)$p['note_sur_5'] ?>"
              data-prix="<?= (float)$p['prix_euros'] ?>">
            <td>
              <a href="/fabricants/<?= htmlspecialchars($p['fabricant_slug']) ?>/" style="font-weight:700;color:var(--brun);">
                <?= htmlspecialchars($p['fabricant_name']) ?>
              </a>
            </td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td style="white-space:nowrap;"><?= number_format($p['poids_g'] >= 1000 ? $p['poids_g']/1000 : $p['poids_g'], $p['poids_g'] >= 1000 ? 1 : 0) ?><?= $p['poids_g'] >= 1000 ? ' kg' : ' g' ?></td>
            <td><?= htmlspecialchars($p['huile_principale']) ?></td>
            <td>
              <span style="font-weight:700;color:<?= $p['taux_huile_pct'] >= 72 ? 'var(--olive)' : '#a07040' ?>;">
                <?= (int)$p['taux_huile_pct'] ?>%
              </span>
            </td>
            <td>
              <div style="display:flex;flex-wrap:wrap;gap:.25rem;">
                <?php foreach ($p['certifications'] as $cert): ?>
                <span class="badge badge--olive" style="font-size:.68rem;"><?= htmlspecialchars($cert) ?></span>
                <?php endforeach; ?>
              </div>
            </td>
            <td>
              <span title="<?= (float)$p['note_sur_5'] ?>/5" style="font-weight:700;color:var(--ocre);">
                ★ <?= number_format($p['note_sur_5'], 1) ?>
              </span>
            </td>
            <td style="font-weight:700;white-space:nowrap;"><?= number_format($p['prix_euros'], 2, ',', ' ') ?> €</td>
            <td>
              <?php if (!empty($p['affiliate_url'])): ?>
              <a href="<?= htmlspecialchars($p['affiliate_url']) ?>"
                 class="btn btn--olive"
                 rel="nofollow sponsored"
                 target="_blank">
                Voir sur Amazon
              </a>
              <?php else: ?>
              <span class="btn btn--disabled" style="opacity:.45;cursor:not-allowed;">Bientot disponible</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Note affiliés -->
    <p style="font-size:.78rem;color:#a09080;margin-top:1.5rem;text-align:right;">
      ⓘ Les liens "Acheter" sont des liens affiliés. Nos évaluations restent totalement indépendantes.
    </p>

  </div>
</main>

<?php include ROOT . '/views/includes/footer.php'; ?>
