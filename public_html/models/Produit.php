<?php
/**
 * Model Produit
 */

class Produit {
    private PDO $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function getAll(int $limit = 50): array {
        $stmt = $this->db->prepare(
            'SELECT p.*, f.nom AS fabricant_nom, f.slug AS fabricant_slug
             FROM produits p
             JOIN fabricants f ON p.fabricant_id = f.id
             WHERE f.actif = 1
             ORDER BY p.note_editoriale DESC, p.prix_euros ASC
             LIMIT :limit'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById(int $id): ?array {
        $stmt = $this->db->prepare(
            'SELECT p.*, f.nom AS fabricant_nom, f.slug AS fabricant_slug
             FROM produits p
             JOIN fabricants f ON p.fabricant_id = f.id
             WHERE p.id = :id
             LIMIT 1'
        );
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function getByCertifie(): array {
        $stmt = $this->db->prepare(
            'SELECT p.*, f.nom AS fabricant_nom, f.slug AS fabricant_slug
             FROM produits p
             JOIN fabricants f ON p.fabricant_id = f.id
             WHERE p.certifie = 1 AND f.actif = 1
             ORDER BY p.prix_euros ASC'
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTopRated(int $limit = 10): array {
        $stmt = $this->db->prepare(
            'SELECT p.*, f.nom AS fabricant_nom, f.slug AS fabricant_slug
             FROM produits p
             JOIN fabricants f ON p.fabricant_id = f.id
             WHERE f.actif = 1 AND p.note_editoriale IS NOT NULL
             ORDER BY p.note_editoriale DESC, p.prix_euros ASC
             LIMIT :limit'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
