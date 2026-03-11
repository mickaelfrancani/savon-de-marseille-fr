<?php
/**
 * views/guide.php
 * Guide complet du savon de Marseille — savon-de-marseille.fr
 */

$page_title       = 'Le Guide Complet du Savon de Marseille Authentique';
$page_description = 'Tout savoir sur le savon de Marseille : histoire, fabrication traditionnelle, composition, comment le choisir, le conserver et l\'utiliser.';
$page_canonical   = 'https://savon-de-marseille.fr/guide/';

$page_schema = json_encode([
  '@context'  => 'https://schema.org',
  '@type'     => 'Article',
  'headline'  => 'Le Guide Complet du Savon de Marseille',
  'author'    => ['@type' => 'Organization', 'name' => 'La Rédaction — savon-de-marseille.fr'],
  'publisher' => ['@type' => 'Organization', 'name' => 'savon-de-marseille.fr', 'url' => 'https://savon-de-marseille.fr'],
  'datePublished' => '2025-01-01',
  'inLanguage'    => 'fr-FR',
  'url'           => $page_canonical,
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

$breadcrumb = [['label' => 'Le Guide']];

include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/nav.php';
?>

<div class="page-header">
  <div class="container">
    <span class="hero-badge" style="margin-bottom:1rem;">📖 Guide mis à jour 2025</span>
    <h1>Le Guide Complet du Savon de Marseille</h1>
    <p>Tout ce que vous devez savoir : histoire, fabrication, comment choisir un vrai savon, le conserver et l'utiliser au quotidien.</p>
  </div>
</div>

<main>
  <section class="section">
    <div class="container">
      <div class="article-layout">

        <!-- Contenu principal -->
        <article class="article-body">

          <!-- Sommaire -->
          <div class="guide-toc">
            <h3>📋 Au programme</h3>
            <ol>
              <li><a href="#histoire">Histoire et origines du savon de Marseille</a></li>
              <li><a href="#fabrication">La fabrication traditionnelle : le procédé au chaudron</a></li>
              <li><a href="#composition">Composition : huiles, soude et rien d'autre</a></li>
              <li><a href="#authentique">Comment reconnaître un vrai savon de Marseille ?</a></li>
              <li><a href="#certification">Certifications et labels : ce qu'ils signifient</a></li>
              <li><a href="#choisir">Bien choisir son savon de Marseille</a></li>
              <li><a href="#conservation">Conservation et bonne utilisation</a></li>
              <li><a href="#marche">État du marché : qui fabrique encore vraiment ?</a></li>
            </ol>
          </div>

          <!-- Section 1 -->
          <h2 id="histoire">1. Histoire et origines du savon de Marseille</h2>
          <p>
            L'histoire du savon de Marseille remonte au XIV<sup>e</sup> siècle. Marseille, port méditerranéen idéalement positionné, importait huile d'olive et soude naturelle (soude de Barille tirée des cendres de plantes marines). La première savonnerie attestée date de 1370.
          </p>
          <p>
            C'est Louis XIV qui, en 1688, par l'Edit de Colbert, réglementera strictement sa fabrication : seule l'huile d'olive est autorisée, la fabrication est limitée à la région de Marseille, et toute tromperie est sévèrement punie. Cette réglementation royale sera le fondement de la réputation internationale du savon de Marseille.
          </p>
          <blockquote>
            « La fabrication du savon de Marseille ne peut se faire qu'avec de l'huile d'olive pure, sans aucun mélange d'autres corps gras. »
            <cite>— Édit de Colbert, 1688</cite>
          </blockquote>
          <p>
            À son apogée au XIX<sup>e</sup> siècle, Marseille comptait plus de 90 savonneries qui exportaient dans le monde entier. La Première Guerre mondiale, puis la concurrence des détergents synthétiques dans les années 1950-1970, ont progressivement réduit ce nombre à une poignée de fabricants.
          </p>

          <!-- Section 2 -->
          <h2 id="fabrication">2. La fabrication traditionnelle : le procédé au chaudron</h2>
          <p>
            Le procédé traditionnel, dit <strong>« à chaud »</strong>, est une saponification en chaudron qui dure plusieurs jours. Voici les grandes étapes :
          </p>
          <ol style="padding-left:1.5rem;margin-bottom:1.25rem;">
            <li style="margin-bottom:.5rem;"><strong>Empâtage :</strong> les huiles végétales et la soude sont chauffées ensemble dans un grand chaudron en inox. La réaction de saponification commence.</li>
            <li style="margin-bottom:.5rem;"><strong>Cuisson :</strong> pendant 10 jours, la pâte est chauffée et brassée en continu à 120°C. La soude se consomme entièrement.</li>
            <li style="margin-bottom:.5rem;"><strong>Lavages successifs :</strong> la pâte est lavée avec de l'eau salée pour éliminer la glycérine et les impuretés (les "eaux-mères").</li>
            <li style="margin-bottom:.5rem;"><strong>Vidange et moulage :</strong> la pâte, encore liquide, est coulée sur le sol de la savonnerie (le "parquet"), où elle se solidifie en une grande plaque.</li>
            <li style="margin-bottom:.5rem;"><strong>Découpe et séchage :</strong> les cubes sont découpés à la main, tamponnés au fer chaud, puis séchés plusieurs semaines à l'air.</li>
          </ol>
          <p>
            Ce procédé garantit un savon <strong>à la soude entièrement consommée</strong> (le pH est neutre en surface), riche en glycérine naturelle préservée, et sans aucun résidu chimique.
          </p>

          <!-- Section 3 -->
          <h2 id="composition">3. Composition : huiles, soude et rien d'autre</h2>
          <p>Un vrai savon de Marseille ne contient que :</p>
          <ul style="padding-left:1.5rem;margin-bottom:1.25rem;">
            <li style="margin-bottom:.4rem;"><strong>Huiles végétales</strong> (olive, coprah, palme…) à minimum 72%</li>
            <li style="margin-bottom:.4rem;"><strong>Soude (hydroxyde de sodium)</strong> pour la saponification — entièrement consommée en fin de procédé</li>
            <li style="margin-bottom:.4rem;"><strong>Eau</strong></li>
            <li style="margin-bottom:.4rem;"><strong>Sel marin</strong> (pour les lavages)</li>
          </ul>
          <p>
            <strong>Ce qu'un vrai savon de Marseille ne contient PAS :</strong> colorants, parfums synthétiques, conservateurs, tensioactifs, parabens, huile de palme seule ou en majorité, silicones.
          </p>

          <!-- Section 4 -->
          <h2 id="authentique">4. Comment reconnaître un vrai savon de Marseille ?</h2>
          <p>Cinq critères clés :</p>
          <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem;margin:1.5rem 0;">
            <?php
            $criteres = [
              ['emoji'=>'🔥','title'=>'Marquage à chaud','desc'=>'Le tampon "Savon de Marseille" gravé au fer chaud sur les 6 faces du cube.'],
              ['emoji'=>'🫒','title'=>'72% huile végétale','desc'=>'Minimum 72% d\'huiles végétales nobles (olive ou coprah). Vérifiez l\'INCI.'],
              ['emoji'=>'🔢','title'=>'Liste INCI courte','desc'=>'4 à 6 ingrédients max. Si vous voyez des tensioactifs ou parfums : fuyez.'],
              ['emoji'=>'🟢','title'=>'Couleur naturelle','desc'=>'Vert olive (huile d\'olive) ou brun clair (coprah). Pas de blanc pur artificiel.'],
              ['emoji'=>'🏭','title'=>'Fabriqué en France','desc'=>'Région PACA ou Bouches-du-Rhône. Vérifiez l\'origine sur l\'emballage.'],
            ];
            foreach ($criteres as $c):
            ?>
            <div style="background:var(--blanc);border-radius:6px;padding:1rem;border:1px solid rgba(200,169,110,.2);">
              <div style="font-size:1.8rem;margin-bottom:.5rem;"><?= $c['emoji'] ?></div>
              <strong style="font-size:.9rem;"><?= htmlspecialchars($c['title']) ?></strong>
              <p style="font-size:.82rem;color:#6b5a4e;margin:.3rem 0 0;"><?= htmlspecialchars($c['desc']) ?></p>
            </div>
            <?php endforeach; ?>
          </div>

          <!-- Section 5 -->
          <h2 id="certification">5. Certifications et labels</h2>
          <p>
            En l'absence d'une AOP officielle, plusieurs labels tentent de garantir la qualité :
          </p>
          <ul style="padding-left:1.5rem;margin-bottom:1.25rem;">
            <li style="margin-bottom:.5rem;"><span class="badge badge--olive">Nature &amp; Progrès</span> — label biologique exigeant, audits indépendants réguliers.</li>
            <li style="margin-bottom:.5rem;"><span class="badge badge--olive">Ecocert</span> — certifie la composition naturelle et l'origine des ingrédients.</li>
            <li style="margin-bottom:.5rem;"><span class="badge badge--ocre">Tradition marseillaise</span> — charte de la savonnerie marseillaise, procédé au chaudron obligatoire.</li>
            <li style="margin-bottom:.5rem;"><span class="badge badge--brun">Made in France</span> — fabrication sur le territoire français.</li>
          </ul>

          <!-- Section 6 -->
          <h2 id="choisir">6. Bien choisir son savon de Marseille</h2>
          <p>
            Pour un usage <strong>corps et mains</strong> : privilégiez l'huile d'olive (plus douce, hydratante, idéale peaux sèches). Pour un usage <strong>ménager et lessive</strong> : le coprah est plus efficace dégraissant. Pour les <strong>peaux sensibles et bébés</strong> : vérifiez l'absence de parfum.
          </p>
          <a href="/comparatif/" class="btn mt-2">Comparer les produits →</a>

          <!-- Section 7 -->
          <h2 id="conservation">7. Conservation et bonne utilisation</h2>
          <ul style="padding-left:1.5rem;margin-bottom:1.25rem;">
            <li style="margin-bottom:.4rem;">Conservez-le <strong>au sec entre les utilisations</strong> (porte-savon aéré).</li>
            <li style="margin-bottom:.4rem;">Évitez l'immersion prolongée dans l'eau.</li>
            <li style="margin-bottom:.4rem;">Un savon bien conservé peut durer des <strong>années sans se périmer</strong>.</li>
            <li style="margin-bottom:.4rem;">Les paillettes se conservent en bocal hermétique à l'abri de l'humidité.</li>
          </ul>

          <!-- Section 8 -->
          <h2 id="marche">8. État du marché : qui fabrique encore vraiment ?</h2>
          <p>
            Aujourd'hui, seules une poignée de savonneries respectent encore intégralement le procédé traditionnel : <strong>Marius Fabre</strong>, <strong>Fer à Cheval</strong>, <strong>La Corvette</strong>, <strong>Rampal Latour</strong>… La plupart des produits vendus sous l'appellation "savon de Marseille" sont fabriqués industriellement en dehors de la région, voire à l'étranger.
          </p>
          <a href="/fabricants/" class="btn btn--outline mt-2">Voir l'annuaire des fabricants →</a>

        </article>

        <!-- Sidebar -->
        <aside class="sidebar">
          <div class="sidebar-widget">
            <h4>Navigation rapide</h4>
            <ul class="sidebar-list">
              <li><a href="#histoire">Histoire</a></li>
              <li><a href="#fabrication">Fabrication</a></li>
              <li><a href="#composition">Composition</a></li>
              <li><a href="#authentique">Reconnaître l'authentique</a></li>
              <li><a href="#certification">Certifications</a></li>
              <li><a href="#choisir">Bien choisir</a></li>
              <li><a href="#conservation">Conservation</a></li>
              <li><a href="#marche">État du marché</a></li>
            </ul>
          </div>
          <div class="sidebar-widget" style="background:var(--beige);border:1px solid rgba(200,169,110,.25);text-align:center;">
            <h4>Comparer les produits</h4>
            <p style="font-size:.85rem;color:#6b5a4e;margin-bottom:1rem;">Trouvez votre savon idéal grâce à notre comparatif.</p>
            <a href="/comparatif/" class="btn" style="font-size:.85rem;">Voir le comparatif</a>
          </div>
          <div class="sidebar-widget">
            <h4>Fabricants recommandés</h4>
            <ul class="sidebar-list">
              <li><a href="/fabricants/savonnerie-marius-fabre/">Marius Fabre</a></li>
              <li><a href="/fabricants/fer-a-cheval/">Fer à Cheval</a></li>
              <li><a href="/fabricants/la-corvette/">La Corvette</a></li>
              <li><a href="/fabricants/rampal-latour/">Rampal Latour</a></li>
            </ul>
          </div>
        </aside>

      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>
