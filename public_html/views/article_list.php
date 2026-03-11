<?php require ROOT_PATH . '/includes/header.php'; ?>

<section class="page-header">
    <div class="container">
        <h1>Blog - Savon de Marseille</h1>
        <p>Articles, conseils et actualites sur le savon de Marseille traditionnel.</p>
    </div>
</section>

<section class="blog-section">
    <div class="container">
        <?php if (empty($articles)): ?>
        <p class="no-content">Aucun article pour le moment. Revenez bientot !</p>
        <?php else: ?>
        <div class="grid grid-3">
            <?php foreach ($articles as $article): ?>
            <article class="card">
                <div class="card-meta">
                    <time datetime="<?= htmlspecialchars($article['date_publication']) ?>">
                        <?= htmlspecialchars(date('d/m/Y', strtotime($article['date_publication']))) ?>
                    </time>
                    <?php if (!empty($article['categorie_nom'])): ?>
                    <a href="#" class="tag"><?= htmlspecialchars($article['categorie_nom']) ?></a>
                    <?php endif; ?>
                </div>
                <h2 class="card-title">
                    <a href="/blog/<?= htmlspecialchars($article['slug']) ?>/"><?= htmlspecialchars($article['titre']) ?></a>
                </h2>
                <?php if (!empty($article['extrait'])): ?>
                <p class="card-excerpt"><?= htmlspecialchars(mb_substr(strip_tags($article['extrait']), 0, 150)) ?>...</p>
                <?php endif; ?>
                <a href="/blog/<?= htmlspecialchars($article['slug']) ?>/" class="read-more">Lire la suite &rarr;</a>
            </article>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
        <nav class="pagination" aria-label="Navigation des pages">
            <?php if ($page > 1): ?>
            <a href="/blog/?page=<?= $page - 1 ?>" class="page-prev">&larr; Precedent</a>
            <?php endif; ?>
            <span class="page-info">Page <?= $page ?> / <?= $totalPages ?></span>
            <?php if ($page < $totalPages): ?>
            <a href="/blog/?page=<?= $page + 1 ?>" class="page-next">Suivant &rarr;</a>
            <?php endif; ?>
        </nav>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<?php require ROOT_PATH . '/includes/footer.php'; ?>
