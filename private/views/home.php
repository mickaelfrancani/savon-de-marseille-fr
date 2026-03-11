<?php
/**
 * views/home.php
 * Homepage — savon-de-marseille.fr
 */

$page_title       = 'Guide du savon de Marseille authentique';
$page_description = 'Découvrez le guide indépendant du savon de Marseille : fabricants, comparatif, usages, et comment reconnaître un vrai savon de Marseille.';
$page_canonical   = 'https://savon-de-marseille.fr/';

// Breadcrumb : none sur la homepage
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>

<!-- ══════════════════════════════════════════════
     HERO
══════════════════════════════════════════════════ -->
<section class="hero" aria-labelledby="hero-title">
  <div class="hero-inner">
    <span class="hero-badge">🫒 Guide indépendant depuis 2024</span>
    <h1 id="hero-title">Votre guide indépendant du savon de Marseille authentique</h1>
    <p class="hero-sub">
      Fabricants certifiés, comparatif produits, usages, recettes…<br>
      Tout ce que vous devez savoir pour choisir un <strong>vrai</strong> savon de Marseille.
    </p>
    <div class="hero-cta-group">
      <a href="/guide/" class="btn">Lire le Guide complet</a>
      <a href="/comparatif/" class="btn btn--outline">Comparer les produits</a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     STATS RAPIDES
══════════════════════════════════════════════════ -->
<div style="background:var(--blanc);border-bottom:1px solid rgba(200,169,110,.2);">
  <div class="container" style="padding-top:2rem;padding-bottom:2rem;">
    <div class="stats-row">
      <div class="stat-block">
        <span class="stat-highlight">12+</span>
        <p>Fabricants<br>référencés</p>
      </div>
      <div class="stat-block">
        <span class="stat-highlight">50+</span>
        <p>Produits<br>comparés</p>
      </div>
      <div class="stat-block">
        <span class="stat-highlight">200</span>
        <p>Ans d'histoire<br>documentée</p>
      </div>
      <div class="stat-block">
        <span class="stat-highlight">100%</span>
        <p>Indépendant<br>sans pub cachée</p>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════
     À LA UNE (3 derniers articles)
══════════════════════════════════════════════════ -->
<section class="section" aria-labelledby="une-title">
  <div class="container">
    <h2 id="une-title">À la une</h2>
    <p style="color:#6b5a4e;margin-bottom:2rem;">Les derniers articles de notre rédaction</p>

    <?php
    // TODO: remplacer par une requête BDD réelle
    $articles_une = [
      [
        'slug'     => 'comment-reconnaitre-vrai-savon-marseille',
        'category' => 'Authenticité',
        'title'    => 'Comment reconnaître un vrai savon de Marseille ?',
        'excerpt'  => 'Les 5 critères essentiels pour ne plus jamais se faire avoir : marquage à chaud, composition, huile d\'olive, cube traditionnel…',
        'date'     => '8 mars 2025',
        'icon'     => '🔍',
      ],
      [
        'slug'     => 'meilleurs-fabricants-savon-marseille',
        'category' => 'Fabricants',
        'title'    => 'Les meilleurs fabricants de savon de Marseille en 2025',
        'excerpt'  => 'Notre sélection des savonneries qui respectent encore le cahier des charges traditionnel, avec production dans les Bouches-du-Rhône.',
        'date'     => '2 mars 2025',
        'icon'     => '🏭',
      ],
      [
        'slug'     => '72-pour-cent-huile-olive-quelle-difference',
        'category' => 'Guide',
        'title'    => 'Savon 72% huile d\'olive : quelle différence avec les autres ?',
        'excerpt'  => 'Le taux de 72% est souvent mentionné comme critère de qualité. Mais que signifie-t-il vraiment, et est-il suffisant pour garantir l\'authenticité ?',
        'date'     => '24 février 2025',
        'icon'     => '🫒',
      ],
    ];
    ?>

    <div class="cards-grid">
      <?php foreach ($articles_une as $art): ?>
      <article class="card">
        <div class="card-img-placeholder" aria-hidden="true"><?= $art['icon'] ?></div>
        <div class="card-body">
          <span class="card-category"><?= htmlspecialchars($art['category']) ?></span>
          <h3><a href="/blog/<?= htmlspecialchars($art['slug']) ?>/"><?= htmlspecialchars($art['title']) ?></a></h3>
          <p class="card-excerpt"><?= htmlspecialchars($art['excerpt']) ?></p>
          <div class="card-meta">
            <span>La Rédaction</span>
            <span class="card-meta-dot">•</span>
            <span><?= htmlspecialchars($art['date']) ?></span>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-3">
      <a href="/blog/" class="btn btn--outline">Voir tous les articles</a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     VRAI vs FAUX (teaser)
══════════════════════════════════════════════════ -->
<section class="vrai-faux" aria-labelledby="vraifaux-title">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:center;flex-wrap:wrap;">
      <div>
        <span style="display:inline-block;background:rgba(200,169,110,.15);border:1px solid rgba(200,169,110,.3);color:var(--ocre);padding:.3rem .9rem;border-radius:20px;font-size:.78rem;letter-spacing:.08em;text-transform:uppercase;font-weight:700;margin-bottom:1.25rem;">⚠️ Vrai vs Faux</span>
        <h2 id="vraifaux-title">80% des savons vendus ne sont pas de vrais savons de Marseille</h2>
        <p>L'appellation "savon de Marseille" n'est pas protégée par une AOP. N'importe quel fabricant peut l'utiliser, même si son produit est fabriqué en Chine avec de l'huile de palme.</p>
        <p>Nos experts ont passé au crible les produits du marché. Le résultat est sans appel.</p>
        <a href="/blog/comment-reconnaitre-vrai-savon-marseille/" class="btn mt-2">Découvrir les critères d'authenticité</a>
      </div>
      <div class="stats-row" style="flex-direction:column;gap:1.5rem;align-items:flex-start;">
        <div class="stat-block" style="text-align:left;">
          <span class="stat-highlight">80%</span>
          <p style="text-align:left;">des savons vendus ne respectent<br>pas le cahier des charges traditionnel</p>
        </div>
        <div class="stat-block" style="text-align:left;">
          <span class="stat-highlight">4</span>
          <p style="text-align:left;">savonneries historiques<br>encore actives à Marseille</p>
        </div>
        <div class="stat-block" style="text-align:left;">
          <span class="stat-highlight">72%</span>
          <p style="text-align:left;">d'huile végétale minimum<br>dans un vrai savon de Marseille</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     FABRICANTS MIS EN AVANT
══════════════════════════════════════════════════ -->
<section class="section section--alt" aria-labelledby="fab-title">
  <div class="container">
    <h2 id="fab-title">Fabricants authentiques</h2>
    <p style="color:#6b5a4e;margin-bottom:2rem;">Les savonneries qui respectent la tradition marseillaise</p>

    <?php
    // TODO: remplacer par une requête BDD réelle
    $fabricants = [
      ['slug' => 'savonnerie-marius-fabre',   'name' => 'Savonnerie Marius Fabre', 'ville' => 'Salon-de-Provence', 'depuis' => '1900', 'certs' => ['Nature & Progrès', 'Tradition'], 'icon' => '🏆'],
      ['slug' => 'la-corvette',               'name' => 'La Corvette',             'ville' => 'Saint-Julien-lès-Metz', 'depuis' => '1856', 'certs' => ['Ecocert'], 'icon' => '⚓'],
      ['slug' => 'savon-de-marseille-fer-a-cheval', 'name' => 'Fer à Cheval',     'ville' => 'Marseille', 'depuis' => '1856', 'certs' => ['Tradition', 'Bio'], 'icon' => '🐴'],
      ['slug' => 'savonnerie-valdisere',      'name' => 'Savonnerie Valdisère',    'ville' => 'Marseille', 'depuis' => '1928', 'certs' => ['Artisanal'], 'icon' => '🫒'],
    ];
    ?>

    <div class="cards-grid">
      <?php foreach ($fabricants as $fab): ?>
      <div class="card card-fabricant">
        <div class="card-img-placeholder" aria-hidden="true" style="aspect-ratio:3/1;"><?= $fab['icon'] ?></div>
        <div class="card-body">
          <div class="card-city">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <?= htmlspecialchars($fab['ville']) ?>
          </div>
          <h3><a href="/fabricants/<?= htmlspecialchars($fab['slug']) ?>/"><?= htmlspecialchars($fab['name']) ?></a></h3>
          <p class="card-excerpt" style="font-size:.82rem;color:#8a7060;">Fabrication traditionnelle depuis <?= htmlspecialchars($fab['depuis']) ?></p>
          <div class="fabricant-badges">
            <?php foreach ($fab['certs'] as $cert): ?>
              <span class="badge badge--olive"><?= htmlspecialchars($cert) ?></span>
            <?php endforeach; ?>
          </div>
          <a href="/fabricants/<?= htmlspecialchars($fab['slug']) ?>/" class="btn btn--outline" style="font-size:.85rem;padding:.5rem 1rem;">Voir la savonnerie</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-3">
      <a href="/fabricants/" class="btn btn--outline">Voir tous les fabricants</a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════
     COMPARATIF RAPIDE
══════════════════════════════════════════════════ -->
<section class="section" aria-labelledby="comp-title">
  <div class="container text-center">
    <h2 id="comp-title">Comparez les produits</h2>
    <p style="color:#6b5a4e;max-width:560px;margin:0 auto 2rem;">
      Filtrez par poids, huile, certification ou prix. Trouvez le savon de Marseille qui vous correspond en quelques clics.
    </p>
    <div style="display:flex;gap:2rem;justify-content:center;flex-wrap:wrap;margin-bottom:2.5rem;">
      <div style="text-align:center;">
        <div style="font-size:2rem;margin-bottom:.4rem;">⚖️</div>
        <strong style="font-size:.88rem;">Par poids</strong>
        <p style="font-size:.82rem;color:#8a7060;margin:0;">100g à 1kg</p>
      </div>
      <div style="text-align:center;">
        <div style="font-size:2rem;margin-bottom:.4rem;">🫒</div>
        <strong style="font-size:.88rem;">Par huile</strong>
        <p style="font-size:.82rem;color:#8a7060;margin:0;">Olive, coprah, palme…</p>
      </div>
      <div style="text-align:center;">
        <div style="font-size:2rem;margin-bottom:.4rem;">✅</div>
        <strong style="font-size:.88rem;">Par certification</strong>
        <p style="font-size:.82rem;color:#8a7060;margin:0;">Bio, Ecocert, Tradition</p>
      </div>
      <div style="text-align:center;">
        <div style="font-size:2rem;margin-bottom:.4rem;">💶</div>
        <strong style="font-size:.88rem;">Par prix</strong>
        <p style="font-size:.82rem;color:#8a7060;margin:0;">Du moins cher au premium</p>
      </div>
    </div>
    <a href="/comparatif/" class="btn" style="font-size:1rem;padding:.9rem 2.5rem;">Accéder au comparatif complet</a>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
