<?php
/**
 * Model Article
 */

class Article {
    private PDO $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function getAll(int $limit = 20, int $offset = 0): array {
        $stmt = $this->db->prepare(
            'SELECT a.*, c.nom AS categorie_nom, c.slug AS categorie_slug
             FROM articles a
             LEFT JOIN categories c ON a.categorie_id = c.id
             ORDER BY a.date_publication DESC
             LIMIT :limit OFFSET :offset'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getBySlug(string $slug): ?array {
        $stmt = $this->db->prepare(
            'SELECT a.*, c.nom AS categorie_nom, c.slug AS categorie_slug
             FROM articles a
             LEFT JOIN categories c ON a.categorie_id = c.id
             WHERE a.slug = :slug
             LIMIT 1'
        );
        $stmt->execute([':slug' => $slug]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function getPiliers(): array {
        $stmt = $this->db->prepare(
            'SELECT a.*, c.nom AS categorie_nom
             FROM articles a
             LEFT JOIN categories c ON a.categorie_id = c.id
             WHERE a.est_pilier = 1
             ORDER BY a.date_publication DESC'
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByCategory(string $categorySlug, int $limit = 20): array {
        $stmt = $this->db->prepare(
            'SELECT a.*, c.nom AS categorie_nom, c.slug AS categorie_slug
             FROM articles a
             JOIN categories c ON a.categorie_id = c.id
             WHERE c.slug = :slug
             ORDER BY a.date_publication DESC
             LIMIT :limit'
        );
        $stmt->bindValue(':slug', $categorySlug, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRecent(int $limit = 5): array {
        $stmt = $this->db->prepare(
            'SELECT a.titre, a.slug, a.extrait, a.date_publication, c.nom AS categorie_nom
             FROM articles a
             LEFT JOIN categories c ON a.categorie_id = c.id
             ORDER BY a.date_publication DESC
             LIMIT :limit'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function count(): int {
        $stmt = $this->db->query('SELECT COUNT(*) FROM articles');
        return (int)$stmt->fetchColumn();
    }
}
