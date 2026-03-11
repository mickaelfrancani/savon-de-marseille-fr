<?php
/**
 * StaticController - Pages legales
 */

class StaticController {
    public function legal(): void {
        $pageTitle = 'Mentions Legales - Savon de Marseille';
        $metaDescription = 'Mentions legales du site savon-de-marseille.fr : editeur, hebergeur, propriete intellectuelle et conditions d\'utilisation.';
        $canonicalUrl = SITE_URL . '/mentions-legales/';

        require ROOT_PATH . '/views/legal.php';
    }

    public function privacy(): void {
        $pageTitle = 'Politique de Confidentialite - Savon de Marseille';
        $metaDescription = 'Politique de confidentialite et de protection des donnees personnelles du site savon-de-marseille.fr.';
        $canonicalUrl = SITE_URL . '/politique-confidentialite/';

        require ROOT_PATH . '/views/privacy.php';
    }
}
