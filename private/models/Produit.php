<?php
class Produit {
    private PDO $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function findAll(array $filters = []): array {
        $where = ['p.actif = 1'];
        $params = [];

        if (!empty($filters['bio'])) {
            $where[] = 'p.bio = 1';
        }
        if (!empty($filters['certifie_upra'])) {
            $where[] = 'p.certifie_upra = 1';
        }
        if (!empty($filters['vegan'])) {
            $where[] = 'p.vegan = 1';
        }
        if (!empty($filters['fabricant_id'])) {
            $where[] = 'p.fabricant_id = ?';
            $params[] = $filters['fabricant_id'];
        }

        $whereClause = 'WHERE ' . implode(' AND ', $where);

        $stmt = $this->db->prepare(
            "SELECT p.*, f.nom AS fabricant_nom, f.slug AS fabricant_slug, f.ville AS fabricant_ville
             FROM produits p
             JOIN fabricants f ON f.id = p.fabricant_id
             $whereClause
             ORDER BY p.certifie_upra DESC, p.bio DESC, f.annee_fondation ASC"
        );
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function findByFabricant(int $fabricantId): array {
        $stmt = $this->db->prepare(
            'SELECT * FROM produits WHERE fabricant_id = ? AND actif = 1 ORDER BY prix_ttc ASC'
        );
        $stmt->execute([$fabricantId]);
        return $stmt->fetchAll();
    }
}
