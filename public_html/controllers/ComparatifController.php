<?php
/**
 * ComparatifController
 */

require_once ROOT_PATH . '/models/Produit.php';
require_once ROOT_PATH . '/models/Fabricant.php';

class ComparatifController {
    public function index(): void {
        $produitModel = new Produit();
        $fabricantModel = new Fabricant();

        $produits = $produitModel->getAll(50);
        $produitsCertifies = $produitModel->getByCertifie();
        $topRated = $produitModel->getTopRated(10);
        $fabricants = $fabricantModel->getAll();

        $pageTitle = 'Comparatif savons de Marseille - Quel savon choisir en 2026 ?';
        $metaDescription = 'Comparatif complet des savons de Marseille : prix, certifications, ingredients, fabricants. Notre guide pour choisir le meilleur savon authentique.';
        $canonicalUrl = SITE_URL . '/comparatif/';

        require ROOT_PATH . '/views/comparatif.php';
    }
}
