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
            'fabricants'       => $fabricants,
            'map_data'         => json_encode($mapData),
            'page_title'       => 'Annuaire des Fabricants de Savon de Marseille Authentiques',
            'meta_description' => "Decouvrez les fabricants authentiques de savon de Marseille.",
            'canonical'        => SITE_URL . '/fabricants',
        ];
        include ROOT . '/views/liste-fabricants.php';
    }

    private function mapFabricantToView(array $fab): array {
        $certs = [];
        if (!empty($fab['certifications'])) {
            $certs = array_values(array_filter(array_map('trim', explode(',', $fab['certifications']))));
        }
        $description = $fab['description'] ?? '';
        if (!empty($description) && strpos($description, '<') === false) {
            $description = '<p>' . nl2br(htmlspecialchars($description)) . '</p>';
        }
        $adresse = '';
        if (!empty($fab['code_postal']) && !empty($fab['ville'])) {
            $adresse = $fab['code_postal'] . ' ' . $fab['ville'];
        } elseif (!empty($fab['ville'])) {
            $adresse = $fab['ville'];
        }
        return array_merge($fab, [
            'name'          => $fab['nom'] ?? '',
            'depuis'        => $fab['annee_fondation'] ?? '',
            'lat'           => $fab['latitude'] ?? null,
            'lng'           => $fab['longitude'] ?? null,
            'affiliate_url' => $fab['url_affiliation'] ?? '',
            'site_web'      => $fab['url_officielle'] ?? '',
            'certifications'=> $certs,
            'description'   => $description,
            'adresse'       => $adresse,
            'telephone'     => $fab['telephone'] ?? '',
            'image_url'     => $fab['image'] ?? '',
        ]);
    }

    public function show(string $slug): void {
        $fabricant = $this->model->findBySlug($slug);
        if (!$fabricant) {
            http_response_code(404);
            include ROOT . '/views/404.php';
            return;
        }
        $fabricant = $this->mapFabricantToView($fabricant);
        $produitModel = new Produit();
        $produits     = $produitModel->findByFabricant($fabricant['id']);
        $data = [
            'fabricant'        => $fabricant,
            'produits'         => $produits,
            'page_title'       => htmlspecialchars($fabricant['name']) . ' : Savonnerie Authentique de ' . htmlspecialchars($fabricant['ville']),
            'meta_description' => 'Decouvrez ' . htmlspecialchars($fabricant['name']) . ', savonnerie fondee en ' . $fabricant['depuis'] . ' a ' . htmlspecialchars($fabricant['ville']) . '.',
            'canonical'        => SITE_URL . '/fabricants/' . $fabricant['slug'],
        ];
        include ROOT . '/views/fabricant.php';
    }
}
