<?php
// Schema.org pour la homepage
$data['schema_json'] = json_encode([
  "@context" => "https://schema.org",
  "@type"    => "WebPage",
  "name"     => $data['page_title'],
  "description" => $data['meta_description'],
  "url"      => $data['canonical'],
]);
include ROOT . '/views/includes/header.php';
?>

<!-- HERO -->
<section class="hero">
  <div class="hero-inner">
    <h1>Le guide de reference du <em>Savon de Marseille</em> authentique</h1>
    <p class="hero-lead">Histoire, fabricants verifies, conseils pratiques et comparatif objectif. Tout ce que vous devez savoir sur ce tresor du patrimoine provencal.</p>
    <div class="hero-btns">
      <a href="/guide" class="btn btn-primary">Lire le guide complet</a>
      <a href="/fabricants" class="btn btn-outline">Voir les fabricants</a>
    </div>
  </div>
</section>

<!-- STATS -->
<section style="padding: 2.5rem 0; background: var(--beige);">
  <div class="container">
    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap:1.5rem; text-align:center;">
      <div>
        <div style="font-family:var(--font-serif); font-size:2.5rem; color:var(--ocre); font-weight:700;"><?= $data['fabricants'] ? count($data['fabricants']) : 10 ?></div>
        <div style="color:var(--gris); font-size:0.88rem; margin-top:0.3rem;">Fabricants authentiques</div>
      </div>
      <div>
        <div style="font-family:var(--font-serif); font-size:2.5rem; color:var(--ocre); font-weight:700;">72%</div>
        <div style="color:var(--gris); font-size:0.88rem; margin-top:0.3rem;">Huiles végétales minimum</div>
      </div>
      <div>
        <div style="font-family:var(--font-serif); font-size:2.5rem; color:var(--ocre); font-weight:700;">+600</div>
        <div style="color:var(--gris); font-size:0.88rem; margin-top:0.3rem;">Ans de tradition</div>
      </div>
      <div>
        <div style="font-family:var(--font-serif); font-size:2.5rem; color:var(--ocre); font-weight:700;">30+</div>
        <div style="color:var(--gris); font-size:0.88rem; margin-top:0.3rem;">Usages quotidiens</div>
      </div>
    </div>
  </div>
</section>

<!-- ARTICLES PILIERS -->
<?php if (!empty($data['articles_piliers'])): ?>
<section>
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Nos guides fondamentaux</h2>
      <p class="section-subtitle">Tout comprendre sur le savon de Marseille, de A a Z</p>
    </div>
    <div class="articles-grid">
      <?php foreach ($data['articles_piliers'] as $article): ?>
      <article class="article-card">
        <?php if (!empty($article['image_hero'])): ?>
        <img src="<?= htmlspecialchars($article['image_hero']) ?>" alt="<?= htmlspecialchars($article['image_alt'] ?? '') ?>" loading="lazy">
        <?php endif; ?>
        <div class="article-card-body">
          <span class="article-tag"><?= htmlspecialchars(ucfirst($article['categorie'])) ?></span>
          <h3><a href="/blog/<?= htmlspecialchars($article['slug']) ?>"><?= htmlspecialchars($article['titre']) ?></a></h3>
          <?php if (!empty($article['chapeau'])): ?>
          <p><?= htmlspecialchars(mb_substr($article['chapeau'], 0, 120)) ?>...</p>
          <?php endif; ?>
          <?php if (!empty($article['temps_lecture'])): ?>
          <div class="article-meta">
            <span>Lecture : <?= $article['temps_lecture'] ?> min</span>
          </div>
          <?php endif; ?>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- DERNIERS ARTICLES -->
<?php if (!empty($data['derniers_articles'])): ?>
<section class="bg-beige">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Derniers articles</h2>
      <p class="section-subtitle">Conseils, actualites et approfondissements</p>
    </div>
    <div class="articles-grid">
      <?php foreach ($data['derniers_articles'] as $article): ?>
      <article class="article-card">
        <div class="article-card-body">
          <span class="article-tag"><?= htmlspecialchars(ucfirst($article['categorie'])) ?></span>
          <h3><a href="/blog/<?= htmlspecialchars($article['slug']) ?>"><?= htmlspecialchars($article['titre']) ?></a></h3>
          <?php if (!empty($article['chapeau'])): ?>
          <p><?= htmlspecialchars(mb_substr($article['chapeau'], 0, 120)) ?>...</p>
          <?php endif; ?>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center; margin-top:2.5rem;">
      <a href="/blog" class="btn btn-primary">Voir tous les articles</a>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- FABRICANTS APERCU -->
<?php if (!empty($data['fabricants'])): ?>
<section>
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Fabricants authentiques</h2>
      <p class="section-subtitle">Les savonneries qui perpétuent le vrai savoir-faire marseillais</p>
    </div>
    <div class="fabricants-grid">
      <?php foreach (array_slice($data['fabricants'], 0, 6) as $f): ?>
      <div class="fabricant-card">
        <h3><?= htmlspecialchars($f['nom']) ?></h3>
        <div class="ville"><?= htmlspecialchars($f['ville']) ?></div>
        <?php if ($f['annee_fondation']): ?><div class="annee">Fondee en <?= $f['annee_fondation'] ?></div><?php endif; ?>
        <?php if (!empty($f['description'])): ?>
        <p><?= htmlspecialchars(mb_substr($f['description'], 0, 110)) ?>...</p>
        <?php endif; ?>
        <?php if (!empty($f['certifications'])): ?>
        <span class="badge"><?= htmlspecialchars($f['certifications']) ?></span>
        <?php endif; ?>
        <div style="margin-top:1rem;">
          <a href="/fabricants/<?= htmlspecialchars($f['slug']) ?>" class="btn btn-primary" style="font-size:0.85rem; padding:0.4rem 1rem;">Voir la fiche</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center; margin-top:2.5rem;">
      <a href="/fabricants" class="btn btn-outline" style="color:var(--brun); border-color:var(--bordure);">Voir tous les fabricants</a>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- SECTION VRAI vs FAUX -->
<section class="bg-beige">
  <div class="container">
    <div style="max-width:780px; margin:0 auto; text-align:center;">
      <h2 class="section-title">Comment reconnaitre un vrai savon de Marseille ?</h2>
      <p style="color:var(--gris); margin-bottom:2rem;">Le marche est inonde de savons qui usurpent l'appellation. Notre guide vous apprend a faire la difference en quelques secondes.</p>
      <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem; text-align:left; margin-bottom:2.5rem;">
        <div style="background:var(--blanc); padding:1.5rem; border-radius:var(--radius); border:2px solid var(--vert);">
          <div style="color:var(--vert); font-weight:700; font-size:1.1rem; margin-bottom:0.8rem;">Le vrai</div>
          <ul style="color:var(--brun); font-size:0.9rem; line-height:1.8; padding-left:1.2rem;">
            <li>72% minimum d'huiles végétales</li>
            <li>Fabriqué a Marseille ou en Provence</li>
            <li>Mentions gravees sur le cube</li>
            <li>Methode au chaudron traditionnelle</li>
            <li>Sans colorant ni conservateur chimique</li>
          </ul>
        </div>
        <div style="background:var(--blanc); padding:1.5rem; border-radius:var(--radius); border:2px solid #EF4444;">
          <div style="color:#EF4444; font-weight:700; font-size:1.1rem; margin-bottom:0.8rem;">Le faux</div>
          <ul style="color:var(--brun); font-size:0.9rem; line-height:1.8; padding-left:1.2rem;">
            <li>Fabriqué hors de France</li>
            <li>Huiles animales ou graisses industrielles</li>
            <li>Colorants et parfums de synthese</li>
            <li>Processus chimique accelere</li>
            <li>Appellation "style marseillais"</li>
          </ul>
        </div>
      </div>
      <a href="/blog/vrai-faux-savon-de-marseille" class="btn btn-primary">Lire le guide complet</a>
    </div>
  </div>
</section>

<!-- FAQ SCHEMA.ORG -->
<section>
  <div class="container">
    <div class="section-header" style="text-align:center;">
      <h2 class="section-title">Questions frequentes</h2>
    </div>
    <div class="faq">
      <div class="faq-item">
        <div class="faq-question">Le savon de Marseille est-il certifie par un label officiel ? <span>+</span></div>
        <div class="faq-answer">Il n'existe pas de label "Appellation d'Origine Protegee" pour le savon de Marseille, mais l'UPRA (Union Professionnelle des Fabricants de Savon de Marseille) a etabli un cahier des charges strict que respectent les vrais fabricants traditionnels.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question">Quelle est la difference entre savon de Marseille et savon artisanal ? <span>+</span></div>
        <div class="faq-answer">Le savon de Marseille est une preparation spécifique a base d'huiles végétales (72% minimum), fabriquee selon un procede traditionnel au chaudron. Le savon artisanal est un terme generique qui peut designer tout savon fait main, sans criteres precis de composition.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question">Peut-on utiliser le savon de Marseille sur le visage ? <span>+</span></div>
        <div class="faq-answer">Oui, le savon de Marseille pur vegetal a 72% d'huiles convient pour le visage, notamment les peaux normales a mixtes. Les peaux sensibles ou très seches prefereront un savon surgras. Evitez le contact avec les yeux.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question">Combien de temps dure un cube de savon de Marseille ? <span>+</span></div>
        <div class="faq-answer">Un cube de 300g dure en moyenne 2 a 3 mois pour une personne utilisant le savon quotidiennement (corps et mains). Il dure plus longtemps si on le conserve au sec entre les utilisations.</div>
      </div>
      <div class="faq-item">
        <div class="faq-question">Le savon de Marseille est-il biodégradable ? <span>+</span></div>
        <div class="faq-answer">Oui, le savon de Marseille traditionnel est entierement biodégradable. Il est compose d'huiles végétales saponifiees, sans produits chimiques de synthese, ce qui en fait un excellent choix ecologique pour l'entretien de la maison et du corps.</div>
      </div>
    </div>
  </div>
</section>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Le savon de Marseille est-il certifie par un label officiel ?",
      "acceptedAnswer": {"@type": "Answer", "text": "Il n'existe pas de label AOP pour le savon de Marseille, mais l'UPRA a etabli un cahier des charges strict que respectent les vrais fabricants traditionnels."}
    },
    {
      "@type": "Question",
      "name": "Quelle est la difference entre savon de Marseille et savon artisanal ?",
      "acceptedAnswer": {"@type": "Answer", "text": "Le savon de Marseille est une preparation spécifique a base d'huiles végétales (72% minimum), fabriquee selon un procede traditionnel au chaudron."}
    },
    {
      "@type": "Question",
      "name": "Peut-on utiliser le savon de Marseille sur le visage ?",
      "acceptedAnswer": {"@type": "Answer", "text": "Oui, le savon de Marseille pur vegetal a 72% d'huiles convient pour le visage, notamment les peaux normales a mixtes."}
    }
  ]
}
</script>

<?php include ROOT . '/views/includes/footer.php'; ?>
