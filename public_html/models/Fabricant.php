<?php
/**
 * Model Fabricant
 */

class Fabricant {
    private PDO $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function getAll(): array {
        $stmt = $this->db->prepare(
            'SELECT * FROM fabricants WHERE actif = 1 ORDER BY nom ASC'
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getBySlug(string $slug): ?array {
        $stmt = $this->db->prepare(
            'SELECT * FROM fabricants WHERE slug = :slug AND actif = 1 LIMIT 1'
        );
        $stmt->execute([':slug' => $slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function getWithCoords(): array {
        $stmt = $this->db->prepare(
            'SELECT id, nom, slug, ville, latitude, longitude
             FROM fabricants
             WHERE actif = 1
               AND latitude IS NOT NULL
               AND longitude IS NOT NULL
             ORDER BY nom ASC'
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getProduits(int $fabricantId): array {
        $stmt = $this->db->prepare(
            'SELECT * FROM produits WHERE fabricant_id = :id ORDER BY prix_euros ASC'
        );
        $stmt->execute([':id' => $fabricantId]);
        return $stmt->fetchAll();
    }

    public function count(): int {
        $stmt = $this->db->query('SELECT COUNT(*) FROM fabricants WHERE actif = 1');
        return (int)$stmt->fetchColumn();
    }
}
