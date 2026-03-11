<?php
/**
 * Router principal - savon-de-marseille.fr
 * MVC Light - tout dans public_html (open_basedir safe)
 */

define('ROOT_PATH', __DIR__);
define('SITE_URL', 'https://savon-de-marseille.fr');
define('SITE_NAME', 'Savon de Marseille');

require_once ROOT_PATH . '/config/database.php';

// Recuperer l'URI proprement
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');
if (empty($uri)) {
    $uri = '/';
}

$matched = false;

if ($uri === '' || $uri === '/') {
    require_once ROOT_PATH . '/controllers/HomeController.php';
    $controller = new HomeController();
    $controller->index();
    $matched = true;
}
elseif ($uri === '/sitemap.xml' || $uri === '/sitemap') {
    require_once ROOT_PATH . '/sitemap.php';
    $matched = true;
}
elseif ($uri === '/guide') {
    require_once ROOT_PATH . '/controllers/ArticleController.php';
    $controller = new ArticleController();
    $controller->guide();
    $matched = true;
}
elseif ($uri === '/blog') {
    require_once ROOT_PATH . '/controllers/ArticleController.php';
    $controller = new ArticleController();
    $controller->list();
    $matched = true;
}
elseif (preg_match('#^/blog/([a-z0-9\-]+)$#', $uri, $matches)) {
    require_once ROOT_PATH . '/controllers/ArticleController.php';
    $controller = new ArticleController();
    $controller->show($matches[1]);
    $matched = true;
}
elseif ($uri === '/fabricants') {
    require_once ROOT_PATH . '/controllers/FabricantController.php';
    $controller = new FabricantController();
    $controller->list();
    $matched = true;
}
elseif (preg_match('#^/fabricants/([a-z0-9\-]+)$#', $uri, $matches)) {
    require_once ROOT_PATH . '/controllers/FabricantController.php';
    $controller = new FabricantController();
    $controller->show($matches[1]);
    $matched = true;
}
elseif ($uri === '/comparatif') {
    require_once ROOT_PATH . '/controllers/ComparatifController.php';
    $controller = new ComparatifController();
    $controller->index();
    $matched = true;
}
elseif ($uri === '/usages') {
    require_once ROOT_PATH . '/controllers/ArticleController.php';
    $controller = new ArticleController();
    $controller->usages();
    $matched = true;
}
elseif (preg_match('#^/go/(\d+)$#', $uri, $matches)) {
    require_once ROOT_PATH . '/controllers/AffiliateController.php';
    $controller = new AffiliateController();
    $controller->redirect((int)$matches[1]);
    $matched = true;
}
elseif ($uri === '/mentions-legales') {
    require_once ROOT_PATH . '/controllers/StaticController.php';
    $controller = new StaticController();
    $controller->legal();
    $matched = true;
}
elseif ($uri === '/politique-confidentialite') {
    require_once ROOT_PATH . '/controllers/StaticController.php';
    $controller = new StaticController();
    $controller->privacy();
    $matched = true;
}
elseif ($uri === '/api/fabricants.json' || $uri === '/api/fabricants') {
    require_once ROOT_PATH . '/api/fabricants_json.php';
    $matched = true;
}

if (!$matched) {
    http_response_code(404);
    $pageTitle = 'Page introuvable';
    $metaDescription = '';
    $canonicalUrl = SITE_URL . '/';
    require ROOT_PATH . '/views/404.php';
}
