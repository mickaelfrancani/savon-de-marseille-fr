<?php
class Article {
    private PDO $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function findBySlug(string $slug): ?array {
        $stmt = $this->db->prepare(
            'SELECT *, COALESCE(chapeau, extrait) AS chapeau FROM articles WHERE slug = ? AND publie = 1 LIMIT 1'
        );
        $stmt->execute([$slug]);
        return $stmt->fetch() ?: null;
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare(
            'SELECT *, COALESCE(chapeau, extrait) AS chapeau FROM articles WHERE id = ? LIMIT 1'
        );
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function findAll(int $limit = 20, int $offset = 0): array {
        $stmt = $this->db->prepare(
            'SELECT id, slug, titre, COALESCE(chapeau, extrait) AS chapeau, categorie, type, temps_lecture, image_hero, image_alt, date_publication
             FROM articles WHERE publie = 1 ORDER BY date_publication DESC LIMIT ? OFFSET ?'
        );
        $stmt->execute([$limit, $offset]);
        return $stmt->fetchAll();
    }

    public function findLatest(int $limit = 3): array {
        $stmt = $this->db->prepare(
            'SELECT id, slug, titre, COALESCE(chapeau, extrait) AS chapeau, categorie, temps_lecture, image_hero, image_alt, date_publication
             FROM articles WHERE publie = 1 ORDER BY date_publication DESC LIMIT ?'
        );
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }

    public function findPiliers(): array {
        // Fallback : type='pilier' ou est_pilier=1
        $stmt = $this->db->query(
            'SELECT id, slug, titre, COALESCE(chapeau, extrait) AS chapeau, categorie, temps_lecture, image_hero, image_alt, date_publication
             FROM articles WHERE publie = 1 AND (type = "pilier" OR est_pilier = 1) ORDER BY date_publication ASC'
        );
        return $stmt->fetchAll();
    }

    public function count(): int {
        return (int)$this->db->query('SELECT COUNT(*) FROM articles WHERE publie = 1')->fetchColumn();
    }
}
