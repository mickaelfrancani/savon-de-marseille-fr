<?php
class ArticleController {
    private Article $model;

    public function __construct() {
        $this->model = new Article();
    }

    public function home(): void {
        $fabricantModel = new Fabricant();
        $data = [
            'derniers_articles' => $this->model->findLatest(3),
            'articles_piliers'  => $this->model->findPiliers(),
            'fabricants'        => $fabricantModel->findAll(),
            'page_title'        => 'Savon de Marseille : Guide, Histoire et Fabricants Authentiques',
            'meta_description'  => 'Tout savoir sur le savon de Marseille : guide complet, histoire, fabricants authentiques, comment reconnaitre le vrai savon de Marseille et ses 30 usages.',
            'canonical'         => SITE_URL . '/',
        ];
        include ROOT . '/views/homepage.php';
    }

    public function liste(): void {
        $page   = max(1, (int)($_GET['page'] ?? 1));
        $limit  = 12;
        $offset = ($page - 1) * $limit;

        $data = [
            'articles'          => $this->model->findAll($limit, $offset),
            'total'             => $this->model->count(),
            'page'              => $page,
            'limit'             => $limit,
            'page_title'        => 'Blog Savon de Marseille : Guides et Conseils',
            'meta_description'  => 'Articles sur le savon de Marseille : guides pratiques, conseils d\'utilisation, histoire et fabrication traditionnelle.',
            'canonical'         => SITE_URL . '/blog',
        ];
        include ROOT . '/views/liste-articles.php';
    }

    public function show(string $slug): void {
        $article = $this->model->findBySlug($slug);
        if (!$article) {
            http_response_code(404);
            include ROOT . '/views/404.php';
            return;
        }

        $data = [
            'article'          => $article,
            'page_title'       => htmlspecialchars($article['titre']) . ' | Savon de Marseille',
            'meta_description' => htmlspecialchars($article['meta_description'] ?? ''),
            'canonical'        => SITE_URL . '/blog/' . $article['slug'],
        ];
        include ROOT . '/views/article.php';
    }
}
