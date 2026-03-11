<?php
class Fabricant {
    private PDO $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function findBySlug(string $slug): ?array {
        $stmt = $this->db->prepare(
            'SELECT *, latitude AS lat, longitude AS lng FROM fabricants WHERE slug = ? AND actif = 1 LIMIT 1'
        );
        $stmt->execute([$slug]);
        return $stmt->fetch() ?: null;
    }

    public function findAll(): array {
        $stmt = $this->db->query(
            'SELECT id, slug, nom, ville, departement, annee_fondation, description, specialites, certifications, url_officielle, latitude AS lat, longitude AS lng
             FROM fabricants WHERE actif = 1 ORDER BY annee_fondation ASC'
        );
        return $stmt->fetchAll();
    }

    public function findWithCoords(): array {
        $stmt = $this->db->query(
            'SELECT id, slug, nom, ville, latitude AS lat, longitude AS lng, description, url_officielle
             FROM fabricants WHERE actif = 1 AND latitude IS NOT NULL AND longitude IS NOT NULL'
        );
        return $stmt->fetchAll();
    }

    public function count(): int {
        return (int)$this->db->query('SELECT COUNT(*) FROM fabricants WHERE actif = 1')->fetchColumn();
    }
}
