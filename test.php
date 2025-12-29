<!-- <?php
require_once 'index.php'; // فيه جميع classes

echo "=== TEST ARTICLES ===\n";

// إنشاء Collection
$collection = new Collection();

// إنشاء Auteur
$auteur = new Auteur(
    1,
    "noha",
    "noha@mail.com",
    "1234",
    "auteur",
    date("Y-m-d"),
    null,
    "Bio de Noha"
);

// إنشاء Article
$article1 = new Article(
    1,
    "Article 1",
    "Contenu article 1",
    "Excerpt 1",
    "draft",
    date("Y-m-d"),
    null,
    []
);

// إضافة المقال
$auteur->ajouterArticle($article1);
$collection->addArticle($article1);

echo "✔ Article ajouté\n";


echo "\n=== ARTICLES DANS COLLECTION ===\n";

foreach ($collection->getArticles() as $article) {
    echo "- ID: " . $article->getId() . "\n";
    echo "  Title: " . $article->getTitle() . "\n";
    echo "  Content: " . $article->getContent() . "\n";
}

echo "\n=== MODIFICATION ARTICLE ===\n";

$auteur->modifierArticle(1, "Titre modifié", "Contenu modifié");

$article = $collection->findArticleById(1);
echo "Nouveau titre : " . $article->getTitle() . "\n";

echo "\n=== SUPPRESSION ARTICLE ===\n";

$collection->deleteArticle(1);

if (empty($collection->getArticles())) {
    echo "✔ Article supprimé avec succès\n";
} else {
    echo "❌ Suppression échouée\n";
}

?> -->