<?php
/**
 * views/usages.php
 * Page des usages du savon de Marseille — savon-de-marseille.fr
 */

$page_title       = 'Usages du savon de Marseille — Toutes les utilisations';
$page_description = 'Découvrez tous les usages du savon de Marseille : corps, maison, lessive, jardin, bébé, animaux. Guide pratique et recettes.';
$page_canonical   = 'https://savon-de-marseille.fr/usages/';

$breadcrumb = [['label' => 'Usages']];

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>

<div class="page-header">
  <div class="container">
    <h1>Usages du savon de Marseille</h1>
    <p>Du corps à la maison, en passant par le jardin — le savon de Marseille authentique est bien plus qu'un simple savon de toilette.</p>
  </div>
</div>

<main>

  <!-- Usages principaux -->
  <section class="section">
    <div class="container">
      <h2>Toutes les utilisations</h2>

      <?php
      $usages = [
        ['icon'=>'🛁','title'=>'Hygiène corporelle','desc'=>'Idéal pour le corps et les mains. Doux pour les peaux sensibles, sans perturbateurs endocriniens.'],
        ['icon'=>'🏠','title'=>'Entretien ménager','desc'=>'Nettoie les surfaces, sols, salle de bain. Remplace avantageusement de nombreux produits chimiques.'],
        ['icon'=>'👕','title'=>'Lessive','desc'=>'En paillettes ou râpé, il nettoie le linge en douceur. Parfait pour les peaux sensibles et les vêtements délicats.'],
        ['icon'=>'🌿','title'=>'Jardin & plantes','desc'=>'Dilué, il éloigne les pucerons et parasites sans abîmer les plantes ni polluer le sol.'],
        ['icon'=>'👶','title'=>'Bébé','desc'=>'Sans parfum, ni conservateur, le savon de Marseille authentique convient parfaitement au bain de bébé.'],
        ['icon'=>'🐾','title'=>'Animaux','desc'=>'Pour laver chiens et chats — inoffensif, sans détergents agressifs pour leur peau et leur fourrure.'],
        ['icon'=>'🚗','title'=>'Voiture','desc'=>'Excellent dégraissant pour nettoyer les jantes, carrosserie et habitacle sans rayer les surfaces.'],
        ['icon'=>'✂️','title'=>'Travaux & bricolage','desc'=>'Idéal pour graisser les sécateurs, protéger les chaussures en cuir, lubrifier les charnières.'],
      ];
      ?>

      <div class="usages-grid">
        <?php foreach ($usages as $u): ?>
        <div class="usage-card">
          <div class="usage-icon" aria-hidden="true"><?= $u['icon'] ?></div>
          <h3><?= htmlspecialchars($u['title']) ?></h3>
          <p><?= htmlspecialchars($u['desc']) ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Recettes pratiques -->
  <section class="section section--alt">
    <div class="container">
      <h2>Recettes pratiques</h2>
      <p style="color:#6b5a4e;margin-bottom:2.5rem;">Des préparations simples pour remplacer les produits du commerce.</p>

      <div class="cards-grid">

        <div class="card">
          <div class="card-img-placeholder" aria-hidden="true">🧴</div>
          <div class="card-body">
            <span class="card-category">Maison</span>
            <h3>Spray nettoyant multi-surfaces</h3>
            <p class="card-excerpt">
              <strong>Ingrédients :</strong> 1L d'eau tiède, 2 c.s. de paillettes de savon de Marseille, 10 gouttes d'huile essentielle de tea tree.
            </p>
            <p style="font-size:.85rem;color:#6b5a4e;">
              Dissoudre les paillettes dans l'eau chaude. Laisser refroidir, ajouter l'HE. Vaporiser et essuyer.
            </p>
          </div>
        </div>

        <div class="card">
          <div class="card-img-placeholder" aria-hidden="true">👕</div>
          <div class="card-body">
            <span class="card-category">Lessive</span>
            <h3>Lessive maison au savon de Marseille</h3>
            <p class="card-excerpt">
              <strong>Ingrédients :</strong> 150g paillettes de savon, 1 kg cristaux de soude, 200g bicarbonate de soude.
            </p>
            <p style="font-size:.85rem;color:#6b5a4e;">
              Mélanger tous les ingrédients. Utiliser 3 à 4 cuillères à soupe par machine à 30-40°C.
            </p>
          </div>
        </div>

        <div class="card">
          <div class="card-img-placeholder" aria-hidden="true">🌿</div>
          <div class="card-body">
            <span class="card-category">Jardin</span>
            <h3>Insecticide naturel anti-pucerons</h3>
            <p class="card-excerpt">
              <strong>Ingrédients :</strong> 1L d'eau, 20g de savon de Marseille râpé ou paillettes.
            </p>
            <p style="font-size:.85rem;color:#6b5a4e;">
              Dissoudre le savon dans l'eau chaude, laisser refroidir. Vaporiser sur les feuilles atteintes matin ou soir.
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- CTA Guide -->
  <section class="section" style="background:var(--brun);">
    <div class="container text-center">
      <h2 style="color:var(--ocre);">En savoir plus</h2>
      <p style="color:rgba(253,250,245,.8);max-width:520px;margin:0 auto 2rem;">
        Notre guide complet vous explique tout sur le savon de Marseille : fabrication, authenticité, conservation et bien plus encore.
      </p>
      <a href="/guide/" class="btn">Lire le Guide complet</a>
    </div>
  </section>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
