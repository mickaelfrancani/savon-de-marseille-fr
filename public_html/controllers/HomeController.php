<?php
/**
 * HomeController
 */

require_once ROOT_PATH . '/models/Article.php';
require_once ROOT_PATH . '/models/Fabricant.php';
require_once ROOT_PATH . '/models/Produit.php';

class HomeController {
    public function index(): void {
        $articleModel = new Article();
        $fabricantModel = new Fabricant();
        $produitModel = new Produit();

        $recentArticles = $articleModel->getRecent(6);
        $piliers = $articleModel->getPiliers();
        $fabricants = $fabricantModel->getAll();
        $topProduits = $produitModel->getTopRated(6);

        $pageTitle = 'Savon de Marseille : Guide complet, fabricants et conseils';
        $metaDescription = 'Tout savoir sur le savon de Marseille authentique : fabricants certifies, methode traditionnelle, comparatif et usages. Le guide de reference.';
        $canonicalUrl = SITE_URL . '/';

        require ROOT_PATH . '/views/home.php';
    }
}
