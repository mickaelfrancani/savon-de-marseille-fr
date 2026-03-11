<?php
/**
 * ArticleController
 */

require_once ROOT_PATH . '/models/Article.php';

class ArticleController {
    public function list(): void {
        $model = new Article();
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 12;
        $offset = ($page - 1) * $perPage;
        $total = $model->count();
        $articles = $model->getAll($perPage, $offset);
        $totalPages = (int)ceil($total / $perPage);

        $pageTitle = 'Blog - Articles sur le savon de Marseille';
        $metaDescription = 'Articles, conseils et actualites sur le savon de Marseille. Decouvrez notre blog dedie au savon traditionnel provencal.';
        $canonicalUrl = SITE_URL . '/blog/';

        require ROOT_PATH . '/views/article_list.php';
    }

    public function show(string $slug): void {
        $model = new Article();
        $article = $model->getBySlug($slug);

        if (!$article) {
            http_response_code(404);
            require ROOT_PATH . '/views/404.php';
            return;
        }

        $pageTitle = htmlspecialchars($article['titre']) . ' - Savon de Marseille';
        $metaDescription = htmlspecialchars($article['meta_description'] ?? mb_substr(strip_tags($article['extrait'] ?? $article['contenu']), 0, 160));
        $canonicalUrl = SITE_URL . '/blog/' . htmlspecialchars($article['slug']) . '/';

        require ROOT_PATH . '/views/article_show.php';
    }

    public function guide(): void {
        $model = new Article();
        $piliers = $model->getPiliers();
        $guideArticles = $model->getByCategory('guide', 20);

        $pageTitle = 'Guide complet du savon de Marseille - Fabrication, certification et usages';
        $metaDescription = 'Le guide complet du savon de Marseille : histoire, fabrication traditionnelle, certification, bienfaits et utilisations. Tout ce que vous devez savoir.';
        $canonicalUrl = SITE_URL . '/guide/';

        require ROOT_PATH . '/views/guide.php';
    }

    public function usages(): void {
        $model = new Article();
        $usageArticles = $model->getByCategory('usages', 20);

        $pageTitle = 'Les usages du savon de Marseille - Applications et conseils pratiques';
        $metaDescription = 'Decouvrez tous les usages du savon de Marseille : corps, visage, cheveux, lessive, menage. Conseils pratiques et recettes naturelles.';
        $canonicalUrl = SITE_URL . '/usages/';

        require ROOT_PATH . '/views/usages.php';
    }
}
