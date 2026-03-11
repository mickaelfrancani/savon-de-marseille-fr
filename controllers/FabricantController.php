<?php
class FabricantController {
    private Fabricant $model;

    public function __construct() {
        $this->model = new Fabricant();
    }

    public function liste(): void {
        $fabricants = $this->model->findAll();
        $mapData    = $this->model->findWithCoords();

        $data = [
            'fabricants'        => $fabricants,
            'map_data'          => json_encode($mapData),
            'page_title'        => 'Annuaire des Fabricants de Savon de Marseille Authentiques',
            'meta_description'  => 'Decouvrez les ' . count($fabricants) . ' fabricants authentiques de savon de Marseille : Marius Fabre, Fer a Cheval, Le Serail, La Licorne et bien d\'autres.',
            'canonical'         => SITE_URL . '/fabricants',
        ];
        include ROOT . '/views/liste-fabricants.php';
    }

    public function show(string $slug): void {
        $fabricant = $this->model->findBySlug($slug);
        if (!$fabricant) {
            http_response_code(404);
            include ROOT . '/views/404.php';
            return;
        }

        $produitModel = new Produit();
        $produits     = $produitModel->findByFabricant($fabricant['id']);

        $data = [
            'fabricant'         => $fabricant,
            'produits'          => $produits,
            'page_title'        => htmlspecialchars($fabricant['nom']) . ' : Savonnerie Authentique de ' . htmlspecialchars($fabricant['ville']),
            'meta_description'  => 'Decouvrez ' . htmlspecialchars($fabricant['nom']) . ', savonnerie fondee en ' . $fabricant['annee_fondation'] . ' a ' . htmlspecialchars($fabricant['ville']) . '. Methode traditionnelle, produits authentiques.',
            'canonical'         => SITE_URL . '/fabricants/' . $fabricant['slug'],
        ];
        include ROOT . '/views/fabricant.php';
    }
}
