<?php
/**
 * Router principal - savon-de-marseille.fr
 * Architecture MVC light - index.php unique entry point
 */

define('ROOT', '/home/savonmarseille/web/savon-de-marseille.fr/private');
define('PUBLIC_HTML', __DIR__);

require_once ROOT . '/config/database.php';
require_once ROOT . '/models/Article.php';
require_once ROOT . '/models/Fabricant.php';
require_once ROOT . '/models/Produit.php';
require_once ROOT . '/controllers/ArticleController.php';
require_once ROOT . '/controllers/FabricantController.php';
require_once ROOT . '/controllers/ComparatifController.php';
require_once ROOT . '/controllers/SitemapController.php';

// Parse URL
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = rtrim($requestUri, '/') ?: '/';

// Routing
switch (true) {

    // Accueil
    case $requestUri === '/' || $requestUri === '':
        $controller = new ArticleController();
        $controller->home();
        break;

    // Guide complet (article pilier)
    case $requestUri === '/guide':
        $controller = new ArticleController();
        $controller->show('guide-complet-savon-de-marseille');
        break;

    // Blog - liste
    case $requestUri === '/blog':
        $controller = new ArticleController();
        $controller->liste();
        break;

    // Blog - article
    case preg_match('#^/blog/([a-z0-9\-]+)$#', $requestUri, $m):
        $controller = new ArticleController();
        $controller->show($m[1]);
        break;

    // Usages
    case $requestUri === '/usages':
        $controller = new ArticleController();
        $controller->show('30-usages-savon-de-marseille');
        break;

    // Histoire
    case $requestUri === '/histoire':
        $controller = new ArticleController();
        $controller->show('histoire-savon-de-marseille');
        break;

    // Fabricants - liste
    case $requestUri === '/fabricants':
        $controller = new FabricantController();
        $controller->liste();
        break;

    // Fabricants - fiche
    case preg_match('#^/fabricants/([a-z0-9\-]+)$#', $requestUri, $m):
        $controller = new FabricantController();
        $controller->show($m[1]);
        break;

    // Comparatif
    case $requestUri === '/comparatif':
        $controller = new ComparatifController();
        $controller->index();
        break;

    // Cloaking liens affilies
    case preg_match('#^/go/(\d+)$#', $requestUri, $m):
        handleAffiliateRedirect((int)$m[1]);
        break;

    // Sitemap XML
    case $requestUri === '/sitemap.xml':
        $controller = new SitemapController();
        $controller->generate();
        break;

    // Mentions legales (image PNG)
    case $requestUri === '/mentions-legales':
        include ROOT . '/views/legal.php';
        break;

    // Politique de confidentialite (image PNG)
    case $requestUri === '/politique-confidentialite':
        include ROOT . '/views/privacy.php';
        break;

    // 404
    default:
        http_response_code(404);
        include ROOT . '/views/404.php';
        break;
}

/**
 * Cloaking liens affilies avec tracking UTM
 */
function handleAffiliateRedirect(int $id): void {
    $db = getDB();
    $stmt = $db->prepare('SELECT * FROM liens_affilies WHERE id = ? AND actif = 1 LIMIT 1');
    $stmt->execute([$id]);
    $lien = $stmt->fetch();

    if (!$lien) {
        http_response_code(404);
        echo 'Lien introuvable.';
        return;
    }

    // Construire URL avec UTM
    $url = $lien['url_destination'];
    $params = http_build_query(array_filter([
        'utm_source'   => $lien['utm_source'],
        'utm_medium'   => $lien['utm_medium'],
        'utm_campaign' => $lien['utm_campaign'],
    ]));
    if ($params) {
        $url .= (strpos($url, '?') !== false ? '&' : '?') . $params;
    }

    // Log le clic (RGPD : IP hashee)
    try {
        $ipHash = hash('sha256', $_SERVER['REMOTE_ADDR'] ?? '');
        $logStmt = $db->prepare('INSERT INTO clics_affilies (lien_id, ip_hash, user_agent, referer) VALUES (?, ?, ?, ?)');
        $logStmt->execute([
            $id,
            $ipHash,
            substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 500),
            substr($_SERVER['HTTP_REFERER'] ?? '', 0, 1000),
        ]);
        $db->exec("UPDATE liens_affilies SET clics = clics + 1 WHERE id = $id");
    } catch (PDOException $e) {
        error_log('Affiliate log error: ' . $e->getMessage());
    }

    header('Location: ' . $url, true, 301);
    exit;
}
