<?php
class ComparatifController {
    public function index(): void {
        $produitModel = new Produit();
        $filters      = array_intersect_key($_GET, ['bio' => 1, 'certifie_upra' => 1, 'vegan' => 1, 'fabricant_id' => 1]);
        $produits     = $produitModel->findAll($filters);

        $fabricantModel = new Fabricant();
        $fabricants     = $fabricantModel->findAll();

        $data = [
            'produits'          => $produits,
            'fabricants'        => $fabricants,
            'filters'           => $filters,
            'page_title'        => 'Comparatif Savon de Marseille : Quel Fabricant Choisir ?',
            'meta_description'  => 'Comparez les savons de Marseille authentiques par fabricant, prix, certification UPRA et composition. Guide d\'achat independant.',
            'canonical'         => SITE_URL . '/comparatif',
        ];
        include ROOT . '/views/comparatif.php';
    }
}
