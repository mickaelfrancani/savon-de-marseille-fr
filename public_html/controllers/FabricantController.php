<?php
/**
 * FabricantController
 */

require_once ROOT_PATH . '/models/Fabricant.php';
require_once ROOT_PATH . '/models/Produit.php';

class FabricantController {
    public function list(): void {
        $model = new Fabricant();
        $fabricants = $model->getAll();

        $pageTitle = 'Fabricants de savon de Marseille - Les producteurs authentiques';
        $metaDescription = 'Decouvrez tous les fabricants authentiques de savon de Marseille : savonneries traditionnelles de Provence, leurs methodes et leurs produits.';
        $canonicalUrl = SITE_URL . '/fabricants/';

        require ROOT_PATH . '/views/fabricants_list.php';
    }

    public function show(string $slug): void {
        $fabricantModel = new Fabricant();
        $fabricant = $fabricantModel->getBySlug($slug);

        if (!$fabricant) {
            http_response_code(404);
            require ROOT_PATH . '/views/404.php';
            return;
        }

        $produits = $fabricantModel->getProduits($fabricant['id']);

        $pageTitle = htmlspecialchars($fabricant['nom']) . ' - Savonnerie de Marseille';
        $metaDescription = 'Decouvrez ' . htmlspecialchars($fabricant['nom']) . ', fabricant authentique de savon de Marseille a ' . htmlspecialchars($fabricant['ville'] ?? 'Provence') . '. Methode traditionnelle et produits naturels.';
        $canonicalUrl = SITE_URL . '/fabricants/' . htmlspecialchars($fabricant['slug']) . '/';

        require ROOT_PATH . '/views/fabricant_show.php';
    }
}
