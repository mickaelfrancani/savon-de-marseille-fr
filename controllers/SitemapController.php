<?php
class SitemapController {
    public function generate(): void {
        header('Content-Type: application/xml; charset=utf-8');

        $db = getDB();

        $urls = [];

        // Pages statiques
        $staticPages = [
            ['loc' => '/',                        'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => '/guide',                   'priority' => '0.9', 'changefreq' => 'monthly'],
            ['loc' => '/blog',                    'priority' => '0.8', 'changefreq' => 'daily'],
            ['loc' => '/fabricants',              'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => '/comparatif',              'priority' => '0.7', 'changefreq' => 'weekly'],
            ['loc' => '/usages',                  'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => '/histoire',                'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => '/mentions-legales',        'priority' => '0.1', 'changefreq' => 'yearly'],
            ['loc' => '/politique-confidentialite','priority' => '0.1', 'changefreq' => 'yearly'],
        ];

        foreach ($staticPages as $p) {
            $urls[] = [
                'loc'        => SITE_URL . $p['loc'],
                'lastmod'    => date('Y-m-d'),
                'changefreq' => $p['changefreq'],
                'priority'   => $p['priority'],
            ];
        }

        // Articles
        $articles = $db->query(
            "SELECT slug, updated_at FROM articles WHERE publie = 1 ORDER BY date_publication DESC"
        )->fetchAll();
        foreach ($articles as $a) {
            $urls[] = [
                'loc'        => SITE_URL . '/blog/' . $a['slug'],
                'lastmod'    => substr($a['updated_at'], 0, 10),
                'changefreq' => 'monthly',
                'priority'   => '0.6',
            ];
        }

        // Fabricants
        $fabricants = $db->query(
            "SELECT slug, updated_at FROM fabricants WHERE actif = 1 ORDER BY annee_fondation ASC"
        )->fetchAll();
        foreach ($fabricants as $f) {
            $urls[] = [
                'loc'        => SITE_URL . '/fabricants/' . $f['slug'],
                'lastmod'    => substr($f['updated_at'], 0, 10),
                'changefreq' => 'monthly',
                'priority'   => '0.7',
            ];
        }

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            echo "  <url>\n";
            echo "    <loc>" . htmlspecialchars($url['loc']) . "</loc>\n";
            echo "    <lastmod>" . $url['lastmod'] . "</lastmod>\n";
            echo "    <changefreq>" . $url['changefreq'] . "</changefreq>\n";
            echo "    <priority>" . $url['priority'] . "</priority>\n";
            echo "  </url>\n";
        }

        echo '</urlset>';
    }
}
