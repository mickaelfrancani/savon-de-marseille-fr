<?php
/**
 * views/fabricant-list.php
 * Annuaire des fabricants — savon-de-marseille.fr
 *
 * Variables attendues :
 *   $fabricants  array  [{id,slug,name,ville,depuis,certifications[],description_courte}]
 */

if (!isset($fabricants)) {
  $fabricants = [];
}

$page_title       = 'Annuaire des Fabricants de Savon de Marseille';
$page_description = 'Découvrez tous les fabricants authentiques de savon de Marseille. Savonneries artisanales, certifications, adresses et liens officiels.';
$page_canonical   = 'https://savon-de-marseille.fr/fabricants/';

$breadcrumb = [['label' => 'Fabricants']];

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>

<div class="page-header">
  <div class="container">
    <h1>Annuaire des Fabricants</h1>
    <p>Les savonneries artisanales qui respectent la tradition marseillaise — fabrication en chaudron, huiles nobles, marquage authentique.</p>
  </div>
</div>

<main class="section">
  <div class="container">

    <!-- Légende certifications -->
    <div style="display:flex;gap:.75rem;flex-wrap:wrap;margin-bottom:2.5rem;padding:1rem 1.25rem;background:var(--blanc);border-radius:6px;border:1px solid rgba(200,169,110,.2);align-items:center;font-size:.82rem;">
      <strong style="color:var(--olive);">Certifications :</strong>
      <span class="badge badge--olive">Nature &amp; Progrès</span>
      <span class="badge badge--olive">Ecocert / Bio</span>
      <span class="badge badge--ocre">Tradition marseillaise</span>
      <span class="badge badge--brun">Made in France</span>
    </div>

    <?php if (!empty($fabricants)): ?>

    <!-- Grille fabricants -->
    <div class="cards-grid">
      <?php foreach ($fabricants as $fab): ?>
      <div class="card card-fabricant">
        <div class="card-img-placeholder" style="aspect-ratio:3/1;" aria-hidden="true">🏭</div>
        <div class="card-body">
          <div class="card-city">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?= htmlspecialchars($fab['ville']) ?>
          </div>
          <h3><a href="/fabricants/<?= htmlspecialchars($fab['slug']) ?>/"><?= htmlspecialchars($fab['name']) ?></a></h3>
          <p class="card-excerpt">
            <?= !empty($fab['description_courte'])
                ? htmlspecialchars($fab['description_courte'])
                : 'Fabrication artisanale depuis ' . htmlspecialchars($fab['depuis']) . '.' ?>
          </p>
          <div class="fabricant-badges" style="margin-bottom:1rem;">
            <?php foreach (($fab['certifications'] ?? []) as $cert): ?>
            <span class="badge badge--olive"><?= htmlspecialchars($cert) ?></span>
            <?php endforeach; ?>
          </div>
          <div style="display:flex;gap:.6rem;flex-wrap:wrap;">
            <a href="/fabricants/<?= htmlspecialchars($fab['slug']) ?>/" class="btn btn--outline" style="font-size:.82rem;padding:.45rem .9rem;">Voir la fiche</a>
            <?php if (!empty($fab['affiliate_url'])): ?>
            <a href="<?= htmlspecialchars($fab['affiliate_url']) ?>"
               class="btn btn--olive"
               style="font-size:.82rem;padding:.45rem .9rem;"
               rel="nofollow sponsored"
               target="_blank">Acheter</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php else: ?>
    <!-- Fabricants statiques (demo avant BDD) -->
    <?php
    $demo = [
      ['slug'=>'savonnerie-marius-fabre','name'=>'Savonnerie Marius Fabre','ville'=>'Salon-de-Provence','depuis'=>'1900','certs'=>['Nature & Progrès','Tradition'],'desc'=>'L\'une des dernières manufactures à utiliser le procédé au chaudron au feu direct. Référence absolue.'],
      ['slug'=>'la-corvette','name'=>'La Corvette','ville'=>'Saint-Julien','depuis'=>'1856','certs'=>['Ecocert','Bio'],'desc'=>'Fabricant historique, l\'une des plus anciennes maisons de savonnerie de la région marseillaise.'],
      ['slug'=>'fer-a-cheval','name'=>'Fer à Cheval','ville'=>'Marseille','depuis'=>'1856','certs'=>['Tradition','Made in France'],'desc'=>'Institution marseillaise. Le cube vert emblématique est reconnaissable entre mille.'],
      ['slug'=>'savonnerie-du-midi','name'=>'Savonnerie du Midi','ville'=>'Marseille','depuis'=>'1894','certs'=>['Artisanal'],'desc'=>'Savonnerie du cœur de Marseille, perpétuant les gestes ancestraux des maîtres savonniers.'],
      ['slug'=>'rampal-latour','name'=>'Rampal Latour','ville'=>'Salon-de-Provence','depuis'=>'1828','certs'=>['Artisanal','Nature & Progrès'],'desc'=>'La plus ancienne savonnerie de Salon-de-Provence. Gamme étendue de savons de Marseille et d\'Alep.'],
      ['slug'=>'savonnerie-valdisere','name'=>'Savonnerie Valdisère','ville'=>'Marseille','depuis'=>'1928','certs'=>['Tradition'],'desc'=>'Fabricant discret mais respecté des professionnels du secteur pour la qualité de ses cubes traditionnels.'],
    ];
    ?>
    <div class="cards-grid">
      <?php foreach ($demo as $fab): ?>
      <div class="card card-fabricant">
        <div class="card-img-placeholder" style="aspect-ratio:3/1;" aria-hidden="true">🏭</div>
        <div class="card-body">
          <div class="card-city">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?= htmlspecialchars($fab['ville']) ?>
          </div>
          <h3><a href="/fabricants/<?= htmlspecialchars($fab['slug']) ?>/"><?= htmlspecialchars($fab['name']) ?></a></h3>
          <p class="card-excerpt"><?= htmlspecialchars($fab['desc']) ?></p>
          <div class="fabricant-badges" style="margin-bottom:1rem;">
            <?php foreach ($fab['certs'] as $cert): ?>
            <span class="badge badge--olive"><?= htmlspecialchars($cert) ?></span>
            <?php endforeach; ?>
          </div>
          <a href="/fabricants/<?= htmlspecialchars($fab['slug']) ?>/" class="btn btn--outline" style="font-size:.82rem;padding:.45rem .9rem;">Voir la fiche</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
