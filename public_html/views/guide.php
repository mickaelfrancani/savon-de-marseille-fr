<?php
// Schema.org FAQPage
$schemaOrg = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'name' => 'Guide du savon de Marseille',
    'url' => $canonicalUrl,
    'mainEntity' => [
        [
            '@type' => 'Question',
            'name' => 'Qu\'est-ce que le vrai savon de Marseille ?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Le vrai savon de Marseille est fabrique selon une methode traditionnelle ancestrale, a base d\'huile vegetale (olive ou coprah) saponifiee a chaud, sans colorants ni parfums synthetiques. Il doit contenir au minimum 72% d\'acide gras.'
            ]
        ],
        [
            '@type' => 'Question',
            'name' => 'Comment reconnaitre un vrai savon de Marseille ?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Un vrai savon de Marseille porte obligatoirement la mention "72% d\'huile" et le cachet de la savonnerie. Il se presente sous forme de pain cubique ou rectangulaire, sans emballage plastique. La couleur est naturelle : vert olive pour l\'huile d\'olive, blanc/ivoire pour l\'huile de coprah.'
            ]
        ],
        [
            '@type' => 'Question',
            'name' => 'Quelle est la difference entre savon de Marseille et savon de Marseille certifie ?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Le label "Savon de Marseille" n\'est pas protege juridiquement, ce qui permet a n\'importe quel fabricant de l\'utiliser. Le savon certifie par l\'Union des Professionnels du Savon de Marseille (UPSM) garantit une fabrication dans la region marseillaise et le respect de la recette traditionnelle.'
            ]
        ]
    ]
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

require ROOT_PATH . '/includes/header.php';
?>

<section class="page-header">
    <div class="container">
        <h1>Guide Complet du Savon de Marseille</h1>
        <p>Tout ce que vous devez savoir sur le savon de Marseille : histoire, fabrication, certification et usages.</p>
    </div>
</section>

<div class="container container-narrow">

    <!-- Introduction -->
    <section class="guide-section">
        <h2>Qu'est-ce que le vrai savon de Marseille ?</h2>
        <p>Le savon de Marseille est l'un des produits naturels les plus anciens et les plus polyvalents qui soit. Sa fabrication remonte au X&egrave;me si&egrave;cle en Provence, et son appellation renvoie a une m&eacute;thode traditionnelle ancestrale qui fait appel exclusivement a des huiles v&eacute;g&eacute;tales saponifi&eacute;es a chaud.</p>
        <p>Contrairement aux savons industriels, le vrai savon de Marseille est exempt de colorants, parfums artificiels, ou d&eacute;riv&eacute;s p&eacute;trochimiques. Sa formule minimaliste (huile + soude + eau) en fait un produit d'une efficacit&eacute; remarquable pour l'hygi&egrave;ne, l'entretien et bien plus encore.</p>
    </section>

    <!-- Comment reconnaitre -->
    <section class="guide-section">
        <h2>Comment reconnaitre un vrai savon de Marseille ?</h2>
        <ul class="guide-checklist">
            <li>La mention <strong>"72% d'huile"</strong> inscrite sur le pain</li>
            <li>Le cachet de la savonnerie (nom + adresse)</li>
            <li>Forme cubique ou rectangulaire traditionnel</li>
            <li>Couleur naturelle : vert pour l'huile d'olive, blanc pour l'huile de coprah</li>
            <li>Pas d'emballage plastique (un vrai savon respire)</li>
            <li>Odeur neutre ou tres legere (pas de parfum ajout&eacute;)</li>
        </ul>
    </section>

    <!-- Fabrication -->
    <section class="guide-section">
        <h2>La fabrication traditionnelle</h2>
        <p>La methode ancestrale comporte plusieurs etapes rigoureuses :</p>
        <ol class="guide-steps">
            <li><strong>Saponification a chaud</strong> : melange d'huile vegetale et de soude (lessive de soude) dans de grandes chaudrieres pendant plusieurs jours.</li>
            <li><strong>Relargage</strong> : addition de sel pour separer le savon de la glycerine et des impuretes.</li>
            <li><strong>Cuitage</strong> : cuisson finale pour affiner la pate, verification du taux d'acide gras (72% minimum).</li>
            <li><strong>Mise en formes</strong> : coulee dans des cadres, decoupe en pains.</li>
            <li><strong>Sechage</strong> : sechage naturel pendant plusieurs semaines.</li>
        </ol>
    </section>

    <!-- Articles piliers -->
    <?php if (!empty($piliers)): ?>
    <section class="guide-articles">
        <h2>Articles de reference</h2>
        <ul class="article-list">
            <?php foreach ($piliers as $a): ?>
            <li>
                <a href="/blog/<?= htmlspecialchars($a['slug']) ?>/"><?= htmlspecialchars($a['titre']) ?></a>
                <?php if (!empty($a['extrait'])): ?>
                <p><?= htmlspecialchars(mb_substr(strip_tags($a['extrait']), 0, 120)) ?>...</p>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <?php endif; ?>

    <!-- FAQ Schema.org visible -->
    <section class="guide-faq">
        <h2>Questions fr&eacute;quentes</h2>

        <details class="faq-item">
            <summary>Qu'est-ce que le vrai savon de Marseille ?</summary>
            <p>Le vrai savon de Marseille est fabrique selon une methode traditionnelle ancestrale, a base d'huile vegetale (olive ou coprah) saponifiee a chaud, sans colorants ni parfums synthetiques. Il doit contenir au minimum 72% d'acide gras.</p>
        </details>

        <details class="faq-item">
            <summary>Comment reconnaitre un vrai savon de Marseille ?</summary>
            <p>Un vrai savon de Marseille porte obligatoirement la mention "72% d'huile" et le cachet de la savonnerie. Il se presente sous forme de pain cubique ou rectangulaire, sans emballage plastique. La couleur est naturelle : vert olive pour l'huile d'olive, blanc/ivoire pour l'huile de coprah.</p>
        </details>

        <details class="faq-item">
            <summary>Quelle est la difference entre savon de Marseille et savon de Marseille certifie ?</summary>
            <p>Le label "Savon de Marseille" n'est pas protege juridiquement, ce qui permet a n'importe quel fabricant de l'utiliser. Le savon certifie par l'Union des Professionnels du Savon de Marseille (UPSM) garantit une fabrication dans la region marseillaise et le respect de la recette traditionnelle.</p>
        </details>
    </section>

    <div class="guide-cta">
        <a href="/fabricants/" class="btn btn-primary">Voir les fabricants certifies</a>
        <a href="/comparatif/" class="btn btn-secondary">Comparer les savons</a>
    </div>

</div>

<?php require ROOT_PATH . '/includes/footer.php'; ?>
