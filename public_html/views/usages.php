<?php
require ROOT_PATH . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <h1>Usages du Savon de Marseille</h1>
        <p>Decouvrez les multiples utilisations du savon de Marseille : corps, maison, lessive et bien plus.</p>
    </div>
</section>

<div class="container">

    <!-- Usages principaux -->
    <section class="usages-grid-section">
        <div class="usages-grid">
            <div class="usage-card">
                <div class="usage-icon">&#x1F6BF;</div>
                <h2>Hygi&egrave;ne corporelle</h2>
                <p>Ideal pour le corps et les mains. Sa formule douce respecte le pH naturel de la peau. Recommande pour les peaux sensibles et les allergies aux parfums de synthese.</p>
                <ul>
                    <li>Douche et bain</li>
                    <li>Lavage des mains</li>
                    <li>Rasage (mousse naturelle)</li>
                </ul>
            </div>

            <div class="usage-card">
                <div class="usage-icon">&#x1F9B4;</div>
                <h2>Soin visage et cheveux</h2>
                <p>Le savon de Marseille a l'huile d'olive nourrit la peau du visage en douceur. Evitez les formulations au coprah qui peuvent etre assecher certains types de peau.</p>
                <ul>
                    <li>Demaquillage doux</li>
                    <li>Soin pour peau grasse</li>
                    <li>Shampoing naturel (version liquide)</li>
                </ul>
            </div>

            <div class="usage-card">
                <div class="usage-icon">&#x1F455;</div>
                <h2>Lessive naturelle</h2>
                <p>Rape ou en copeaux, le savon de Marseille est une alternative eco-responsable aux lessives chimiques. Efficace sur les taches courantes et respectueux des fibres textiles.</p>
                <ul>
                    <li>Lessive maison (copeaux + cristaux de soude)</li>
                    <li>Pre-traitement des taches</li>
                    <li>Lavage des textiles delicats</li>
                </ul>
            </div>

            <div class="usage-card">
                <div class="usage-icon">&#x1F9F9;</div>
                <h2>Entretien menager</h2>
                <p>Anti-bacterien naturel, le savon de Marseille nettoie en profondeur sans agresser les surfaces. Parfait pour un menage zero dechet.</p>
                <ul>
                    <li>Nettoyage des sols</li>
                    <li>Degraissage cuisine</li>
                    <li>Nettoyage sanitaires</li>
                    <li>Brillance cuir et bois</li>
                </ul>
            </div>

            <div class="usage-card">
                <div class="usage-icon">&#x1F33F;</div>
                <h2>Jardin et plantes</h2>
                <p>Dilue dans l'eau, le savon de Marseille est un insecticide naturel et un fongicide doux pour vos plantes. 100% biodegradable.</p>
                <ul>
                    <li>Anti-pucerons (dilution 1%)</li>
                    <li>Traitement contre l'oïdium</li>
                    <li>Nettoyage des outils de jardin</li>
                </ul>
            </div>

            <div class="usage-card">
                <div class="usage-icon">&#x1F436;</div>
                <h2>Animaux domestiques</h2>
                <p>Le savon de Marseille pur (sans huiles essentielles) peut etre utilise pour le bain des animaux. Il est doux pour leur peau et ecologique.</p>
                <ul>
                    <li>Shampooing chien et chat</li>
                    <li>Anti-puces (complementaire)</li>
                    <li>Nettoyage gamelles et jouets</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Articles sur les usages -->
    <?php if (!empty($usageArticles)): ?>
    <section class="usage-articles">
        <h2>Nos guides pratiques</h2>
        <div class="grid grid-3">
            <?php foreach ($usageArticles as $article): ?>
            <article class="card">
                <h3><a href="/blog/<?= htmlspecialchars($article['slug']) ?>/"><?= htmlspecialchars($article['titre']) ?></a></h3>
                <?php if (!empty($article['extrait'])): ?>
                <p><?= htmlspecialchars(mb_substr(strip_tags($article['extrait']), 0, 120)) ?>...</p>
                <?php endif; ?>
                <a href="/blog/<?= htmlspecialchars($article['slug']) ?>/" class="read-more">Lire &rarr;</a>
            </article>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <div class="section-cta">
        <a href="/comparatif/" class="btn btn-primary">Choisir son savon</a>
        <a href="/fabricants/" class="btn btn-outline">Voir les fabricants</a>
    </div>

</div>

<?php require ROOT_PATH . '/includes/footer.php'; ?>
