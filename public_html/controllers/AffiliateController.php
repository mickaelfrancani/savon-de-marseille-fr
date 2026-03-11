<?php
/**
 * AffiliateController
 * Systeme de tracking des liens affilies
 */

class AffiliateController {
    public function redirect(int $id): void {
        $db = getDB();

        // Recuperer le lien
        $stmt = $db->prepare(
            'SELECT * FROM affiliate_links WHERE id = :id LIMIT 1'
        );
        $stmt->execute([':id' => $id]);
        $link = $stmt->fetch();

        if (!$link) {
            http_response_code(404);
            require ROOT_PATH . '/views/404.php';
            return;
        }

        // Incrementer le compteur de clics
        $update = $db->prepare(
            'UPDATE affiliate_links SET clics = clics + 1 WHERE id = :id'
        );
        $update->execute([':id' => $id]);

        // Construire l'URL avec parametres UTM
        $url = $link['url_destination'];
        $params = http_build_query([
            'utm_source'   => $link['utm_source'] ?? 'savon-de-marseille',
            'utm_medium'   => $link['utm_medium'] ?? 'affiliation',
            'utm_campaign' => $link['utm_campaign'] ?? 'default',
        ]);

        // Ajouter les UTM a l'URL
        $separator = (strpos($url, '?') !== false) ? '&' : '?';
        $finalUrl = $url . $separator . $params;

        // Redirect 301
        header('Location: ' . $finalUrl, true, 301);
        exit;
    }
}
