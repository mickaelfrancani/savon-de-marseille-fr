<?php
/**
 * Sitemap XML dynamique - savon-de-marseille.fr
 */

define('ROOT_PATH', __DIR__);
define('SITE_URL', 'https://savon-de-marseille.fr');

require_once ROOT_PATH . '/config/database.php';

header('Content-Type: application/xml; charset=UTF-8');

$db = getDB();

// Recuperer les articles
$stmtA = $db->query('SELECT slug, date_publication FROM articles ORDER BY date_publication DESC');
$articles = $stmtA->fetchAll();

// Recuperer les fabricants
$stmtF = $db->query('SELECT slug FROM fabricants WHERE actif = 1 ORDER BY nom ASC');
$fabricants = $stmtF->fetchAll();

$today = date('Y-m-d');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <!-- Pages statiques -->
    <url>
        <loc><?= SITE_URL ?>/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= SITE_URL ?>/guide/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc><?= SITE_URL ?>/fabricants/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc><?= SITE_URL ?>/comparatif/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= SITE_URL ?>/usages/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= SITE_URL ?>/blog/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc><?= SITE_URL ?>/mentions-legales/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.2</priority>
    </url>
    <url>
        <loc><?= SITE_URL ?>/politique-confidentialite/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.2</priority>
    </url>

    <!-- Articles dynamiques -->
    <?php foreach ($articles as $article): ?>
    <url>
        <loc><?= SITE_URL ?>/blog/<?= htmlspecialchars($article['slug']) ?>/</loc>
        <lastmod><?= htmlspecialchars(date('Y-m-d', strtotime($article['date_publication']))) ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <?php endforeach; ?>

    <!-- Fabricants dynamiques -->
    <?php foreach ($fabricants as $fab): ?>
    <url>
        <loc><?= SITE_URL ?>/fabricants/<?= htmlspecialchars($fab['slug']) ?>/</loc>
        <lastmod><?= $today ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>

</urlset>
