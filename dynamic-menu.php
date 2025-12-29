<?php

require_once 'index.php';

echo "=== BLOGCMS CONSOLE ===\n";

// --- INITIALISATION DE LA COLLECTION ---
$db = new Collection();

// --- AJOUT DES UTILISATEURS DE CHAQUE RÔLE ---
// Auteur
$db->getUsers()[] = new Auteur(1, "john", "john@example.com", "1234", "author", date('Y-m-d'), null, "Bio de John");
// Editeur
$db->getUsers()[] = new Editeur(2, "emma", "emma@example.com", "1234", "editor", date('Y-m-d'), null, 5);
// Administrateur
$db->getUsers()[] = new Administrateur(3, "admin", "admin@example.com", "1234", "admin", date('Y-m-d'), null, true);
// Visiteur (optionnel)
$db->getUsers()[] = new Utilisateur(4, "visitor1", "visitor@example.com", "1234", "visitor", date('Y-m-d'), null);

// --- AJOUT D’ARTICLES POUR TEST ---
$db->addArticle(new Article(1, "Premier article", "Contenu du premier article", "Extrait...", "published", date('Y-m-d'), date('Y-m-d')));
$db->addArticle(new Article(2, "Deuxième article", "Contenu du deuxième article", "Extrait...", "draft", date('Y-m-d'), null));

$running = true;

while ($running) {
    // AFFICHAGE DE L'EN-TÊTE AVEC ÉTAT DE CONNEXION
    if ($db->isLoggedIn()) {
        $user = $db->getCurrentUser();
        echo "\n--- Connecté en tant que: {$user->getUsername()} ({$user->getRole()}) ---\n";
    } else {
        echo "\n--- MENU VISITEUR (non connecté) ---\n";
    }

    // MENU DYNAMIQUE
    if (!$db->isLoggedIn()) {
        echo "1. Voir tous les articles\n";
        echo "2. Se connecter\n";
        echo "0. Quitter\n";
    } else {
        echo "1. Voir tous les articles\n";
        if ($user->canCreateArticle()) {
            echo "2. Créer un nouvel article\n";
        }
        echo "3. Voir mes informations\n";
        echo "4. Se déconnecter\n";
        echo "0. Quitter\n";
    }

    $choice = readline("Votre choix : ");

    // TRAITEMENT DES CHOIX
    if (!$db->isLoggedIn()) {
        switch ($choice) {
            case '1':
                $articles = $db->getArticles();
                if (empty($articles)) {
                    echo "Aucun article disponible.\n";
                } else {
                    foreach ($articles as $article) {
                        echo "[{$article->getId()}] {$article->getTitle()} ({$article->getStatus()})\n";
                    }
                }
                break;
            case '2':
                $username = readline("Username : ");
                $password = readline("Password : ");
                if ($db->login($username, $password)) {
                    echo "Connexion réussie !\n";
                } else {
                    echo "Échec de connexion\n";
                }
                break;
            case '0':
                $running = false;
                echo "Au revoir !\n";
                break;
            default:
                echo "Choix invalide\n";
        }
    } else {
        switch ($choice) {
            case '1':
                $articles = $db->getArticles();
                if (empty($articles)) {
                    echo "Aucun article disponible.\n";
                } else {
                    foreach ($articles as $article) {
                        echo "[{$article->getId()}] {$article->getTitle()} ({$article->getStatus()})\n";
                    }
                }
                break;
            case '2':
                if ($user->canCreateArticle()) {
                    $title = readline("Titre de l'article : ");
                    $content = readline("Contenu : ");
                    $id = count($db->getArticles()) + 1;
                    $article = new Article($id, $title, $content, substr($content,0,50), "draft", date('Y-m-d'), null);
                    $db->addArticle($article);
                    if (method_exists($user, 'ajouterArticle')) {
                        $user->ajouterArticle($article);
                    }
                    echo "Article créé avec succès !\n";
                } else {
                    echo "Vous n'avez pas le droit de créer un article.\n";
                }
                break;
            case '3':
                echo "👤 Username: {$user->getUsername()}\n";
                echo "🎭 Rôle: {$user->getRole()}\n";
                if ($user instanceof Auteur) {
                    echo "📝 Articles publiés: " . count($user->listerArticles()) . "\n";
                    echo "💬 Bio: {$user->getBio()}\n";
                }
                if ($user instanceof Editeur) {
                    echo "⚡ Niveau de modération: {$user->getModerationLevel()}\n";
                }
                if ($user instanceof Administrateur) {
                    echo "💎 Super admin: " . ($user->getIsSuperAdmin() ? "Oui" : "Non") . "\n";
                }
                break;
            case '4':
                $db->logout();
                echo "Déconnexion réussie\n";
                break;
            case '0':
                $running = false;
                echo "Au revoir !\n";
                break;
            default:
                echo "Choix invalide\n";
        }
    }
}
