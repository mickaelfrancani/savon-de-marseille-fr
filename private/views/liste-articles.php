<?php include ROOT . '/views/includes/header.php'; ?>

<section class="article-hero">
  <div class="container">
    <nav class="breadcrumb"><a href="/">Accueil</a> &rsaquo; <span>Blog</span></nav>
    <div class="article-header">
      <h1>Blog Savon de Marseille</h1>
      <p class="article-chapeau">Guides pratiques, histoire et conseils d'utilisation sur le savon de Marseille authentique.</p>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <?php if (empty($data['articles'])): ?>
      <p style="text-align:center; color:var(--gris); padding:3rem 0;">Les articles arrivent bientot.</p>
    <?php else: ?>
    <div class="articles-grid">
      <?php foreach ($data['articles'] as $article): ?>
      <article class="article-card">
        <?php if (!empty($article['image_hero'])): ?>
        <img src="<?= htmlspecialchars($article['image_hero']) ?>" alt="<?= htmlspecialchars($article['image_alt'] ?? '') ?>" loading="lazy">
        <?php endif; ?>
        <div class="article-card-body">
          <span class="article-tag"><?= htmlspecialchars(ucfirst($article['categorie'])) ?></span>
          <h3><a href="/blog/<?= htmlspecialchars($article['slug']) ?>"><?= htmlspecialchars($article['titre']) ?></a></h3>
          <?php if (!empty($article['chapeau'])): ?>
          <p><?= htmlspecialchars(mb_substr($article['chapeau'], 0, 130)) ?>...</p>
          <?php endif; ?>
          <div class="article-meta">
            <?php if (!empty($article['date_publication'])): ?>
            <span><?= date('d/m/Y', strtotime($article['date_publication'])) ?></span>
            <?php endif; ?>
            <?php if (!empty($article['temps_lecture'])): ?>
            <span><?= $article['temps_lecture'] ?> min de lecture</span>
            <?php endif; ?>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    
    <!-- Pagination -->
    <?php
    $totalPages = (int)ceil($data['total'] / $data['limit']);
    if ($totalPages > 1):
    ?>
    <div class="pagination">
      <?php if ($data['page'] > 1): ?>
      <a href="/blog?page=<?= $data['page'] - 1 ?>">&laquo; Precedent</a>
      <?php endif; ?>
      <?php for ($i = max(1, $data['page'] - 2); $i <= min($totalPages, $data['page'] + 2); $i++): ?>
      <?php if ($i === $data['page']): ?>
      <span class="active"><?= $i ?></span>
      <?php else: ?>
      <a href="/blog?page=<?= $i ?>"><?= $i ?></a>
      <?php endif; ?>
      <?php endfor; ?>
      <?php if ($data['page'] < $totalPages): ?>
      <a href="/blog?page=<?= $data['page'] + 1 ?>">Suivant &raquo;</a>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php endif; ?>
  </div>
</section>

<?php include ROOT . '/views/includes/footer.php'; ?>
