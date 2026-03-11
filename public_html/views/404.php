<?php
$pageTitle = 'Page introuvable - Savon de Marseille';
$metaDescription = 'La page que vous recherchez n\'existe pas ou a ete deplacee.';
$canonicalUrl = SITE_URL . '/';
require ROOT_PATH . '/includes/header.php';
?>

<section class="error-page">
    <div class="container text-center">
        <div class="error-icon">&#x1F9FC;</div>
        <h1>Page introuvable</h1>
        <p class="error-subtitle">Oops ! Cette page n'existe pas ou a ete deplacee.</p>
        <div class="error-links">
            <a href="/" class="btn btn-primary">Retour a l'accueil</a>
            <a href="/guide/" class="btn btn-outline">Lire le guide</a>
            <a href="/fabricants/" class="btn btn-outline">Voir les fabricants</a>
        </div>
    </div>
</section>

<?php require ROOT_PATH . '/includes/footer.php'; ?>
