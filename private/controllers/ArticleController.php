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
            'meta_description'  => 'Articles sur le savon de Marseille : guides pratiques, conseils utilisation, histoire et fabrication traditionnelle.',
            'canonical'         => SITE_URL . '/blog',
        ];
        include ROOT . '/views/liste-articles.php';
    }

    public function show(string $slug): void {
        $article = $this->model->findBySlug($slug);
        // Map DB fields to view-expected keys
        if ($article) {
            $article = array_merge($article, [
                'title'          => $article['titre'],
                'content'        => $article['contenu'],
                'excerpt'        => $article['chapeau'] ?? $article['meta_description'] ?? '',
                'author'         => 'La Redaction',
                'date_published' => $article['date_publication'],
                'date_modified'  => $article['updated_at'] ?? $article['date_publication'],
                'category_label' => ucfirst($article['categorie'] ?? ''),
                'category_slug'  => $article['categorie'] ?? '',
                'image_url'      => $article['image_hero'] ?? '',
                'tags'           => [],
            ]);
        }
        if (!$article) {
            http_response_code(404);
            include ROOT . '/views/404.php';
            return;
        }

        // Articles recents pour sidebar (exclure article courant)
        $articlesRecents = $this->model->findLatest(6);
        $articlesRecents = array_values(array_filter($articlesRecents, function($a) use ($slug) {
            return $a['slug'] !== $slug;
        }));
        $articlesRecents = array_slice($articlesRecents, 0, 5);
        $articlesRecents = array_map(function($a) {
            return [
                'slug'           => $a['slug'],
                'title'          => $a['titre'],
                'date_published' => $a['date_publication'],
            ];
        }, $articlesRecents);

        // Fabricants sidebar
        $fabricantModel = new Fabricant();
        $allFabricants = $fabricantModel->findAll();
        $fabricantsSidebar = array_map(function($f) {
            return ['slug' => $f['slug'], 'name' => $f['nom'], 'ville' => $f['ville'] ?? ''];
        }, array_slice($allFabricants, 0, 4));

        $data = [
            'article'            => $article,
            'articles_recents'   => $articlesRecents,
            'fabricants_sidebar' => $fabricantsSidebar,
            'page_title'         => htmlspecialchars($article['titre']) . ' | Savon de Marseille',
            'meta_description'   => htmlspecialchars($article['meta_description'] ?? ''),
            'canonical'          => SITE_URL . '/blog/' . $article['slug'],
        ];
        include ROOT . '/views/article.php';
    }
}
