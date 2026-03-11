<?php
class ComparatifController {

    private function mapProduitToView(array $p): array {
        $certs = [];
        if (!empty($p["certifie_upra"]) || !empty($p["certifie"])) $certs[] = "UPRA";
        if (!empty($p["bio"]))   $certs[] = "Bio";
        if (!empty($p["vegan"])) $certs[] = "Vegan";

        // Lien affiliation : url_achat ou /go/{id}/
        $affiliateUrl = !empty($p["url_achat"]) ? $p["url_achat"] : (!empty($p["lien_affilie_id"]) ? "/go/" . $p["lien_affilie_id"] . "/" : "");

        // Note : note_editoriale (1-5) -> note_sur_5 (afficher sur 5.0)
        $note = !empty($p["note_editoriale"]) ? (float)$p["note_editoriale"] : 0.0;

        // Taux huile olive
        $taux = !empty($p["pourcentage_huile_olive"]) ? (int)$p["pourcentage_huile_olive"] : 72;

        // Poids
        $poids = !empty($p["poids_grammes"]) ? (int)$p["poids_grammes"] : (!empty($p["poids_g"]) ? (int)$p["poids_g"] : 0);

        // Prix
        $prix = !empty($p["prix_euros"]) ? (float)$p["prix_euros"] : (!empty($p["prix_ttc"]) ? (float)$p["prix_ttc"] : 0.0);

        return array_merge($p, [
            "name"           => $p["nom"] ?? "",
            "fabricant_name" => $p["fabricant_nom"] ?? "",
            "fabricant_slug" => $p["fabricant_slug"] ?? "",
            "poids_g"        => $poids,
            "huile_principale" => $p["type_huile"] ?? "",
            "taux_huile_pct" => $taux,
            "certifications" => $certs,
            "affiliate_url"  => $affiliateUrl,
            "note_sur_5"     => $note,
            "prix_euros"     => $prix,
        ]);
    }

    public function index(): void {
        $produitModel = new Produit();
        $filters      = array_intersect_key($_GET, ["bio" => 1, "certifie_upra" => 1, "vegan" => 1, "fabricant_id" => 1]);
        $raw          = $produitModel->findAll($filters);
        $produits     = array_map([$this, "mapProduitToView"], $raw);

        $fabricantModel = new Fabricant();
        $fabricants     = $fabricantModel->findAll();

        $data = [
            "produits"         => $produits,
            "fabricants"       => $fabricants,
            "filters"          => $filters,
            "page_title"       => "Comparatif Savon de Marseille : Quel Fabricant Choisir ?",
            "meta_description" => "Comparez les savons de Marseille authentiques par fabricant, prix, certification UPRA et composition.",
            "canonical"        => SITE_URL . "/comparatif",
        ];
        include ROOT . "/views/comparatif.php";
    }
}
