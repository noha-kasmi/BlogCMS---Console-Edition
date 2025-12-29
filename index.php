<?php

class Utilisateur {

    protected $ID;
    protected $Username;
    protected $Email;
    protected $Password;
    protected $Role;
    protected $CreatedAt;
    protected $LastLogin;

    const ROLES = ['visitor', 'author', 'editor', 'admin'];

    public function __construct($ID, $Username, $Email, $Password, $Role, $CreatedAt, $LastLogin) {
        $this->ID = $ID;
        $this->Username = $Username;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->Role = $Role;
        $this->CreatedAt = $CreatedAt;
        $this->LastLogin = $LastLogin;
    }

    public function getID() { return $this->ID; }
    public function getUsername() { return $this->Username; }
    public function getEmail() { return $this->Email; }
    public function getPassword() { return $this->Password; }
    public function getRole() { return $this->Role; }
    public function getCreatedAt() { return $this->CreatedAt; }
    public function getLastLogin() { return $this->LastLogin; }

    public function setUsername($Username) { $this->Username = $Username; }
    public function setEmail($Email) { $this->Email = $Email; }
    public function setPassword($Password) { $this->Password = $Password; }
    public function setRole($Role) { $this->Role = $Role; }
    public function setCreatedAt($CreatedAt) { $this->CreatedAt = $CreatedAt; }
    public function setLastLogin($LastLogin) { $this->LastLogin = $LastLogin; }


// Créer un article
    public function canCreateArticle() {
        if ($this->Role == 'author' || $this->Role == 'editor' || $this->Role == 'admin') {
            return true;
        }
        return false;
    }

    // Modifier un article
    public function canEditArticle() {
        if ($this->Role == 'editor' || $this->Role == 'admin') {
            return true;
        }
        return false;
    }

    // Supprimer un article
    public function canDeleteArticle() {
        if ($this->Role == 'admin') {
            return true;
        }
        return false;
    }

    // Publier un article
    public function canPublishArticle() {
        if ($this->Role == 'author' || $this->Role == 'editor' || $this->Role == 'admin') {
            return true;
        }
        return false;
    }

    // Gérer les catégories
    public function canManageCategories() {
        if ($this->Role == 'editor' || $this->Role == 'admin') {
            return true;
        }
        return false;
    }

    // Créer un commentaire
    public function canCreateComment() {
        return true; // tout le monde
    }

    // Modérer les commentaires
    public function canModerateComments() {
        if ($this->Role == 'editor' || $this->Role == 'admin') {
            return true;
        }
        return false;
    }

    // Gérer les utilisateurs
    public function canManageUsers() {
        if ($this->Role == 'admin') {
            return true;
        }
        return false;
    }
}

class Moderateur extends Utilisateur {}

class Editeur extends Moderateur {
    private $ModerationLevel;

    public function __construct($ID, $Username, $Email, $Password, $Role, $CreatedAt, $LastLogin, $ModerationLevel) {
        parent::__construct($ID, $Username, $Email, $Password, $Role, $CreatedAt, $LastLogin);
        $this->ModerationLevel = $ModerationLevel;
    }

    public function getModerationLevel() {
        return $this->ModerationLevel;
    }

    public function setModerationLevel($ModerationLevel) {
        $this->ModerationLevel = $ModerationLevel;
    }
}

class Administrateur extends Moderateur {
    private $IsSuperAdmin;

    public function __construct($ID, $Username, $Email, $Password, $Role, $CreatedAt, $LastLogin, $IsSuperAdmin) {
        parent::__construct($ID, $Username, $Email, $Password, $Role, $CreatedAt, $LastLogin);
        $this->IsSuperAdmin = $IsSuperAdmin;
    }

    public function getIsSuperAdmin() {
        return $this->IsSuperAdmin;
    }

    public function setIsSuperAdmin($IsSuperAdmin) {
        $this->IsSuperAdmin = $IsSuperAdmin;
    }
}


class Auteur extends Utilisateur {
    private $Bio;
    private array $Articles = [];

    public function __construct($ID, $Username, $Email, $Password, $Role, $CreatedAt, $LastLogin, $Bio) {
        parent::__construct($ID, $Username, $Email, $Password, $Role, $CreatedAt, $LastLogin);
        $this->Bio = $Bio;
    }

    public function getBio() {
        return $this->Bio;
    }

    public function setBio($Bio) {
        $this->Bio = $Bio;
    }

    public function listerArticles() {
        return $this->Articles;
    }

    public function ajouterArticle(Article $article) {
        $this->Articles[] = $article;
    }

    public function modifierArticle($id, $newTitle, $newContent) {
        foreach ($this->Articles as $article) {
            if ($article->getId() === $id) {
                $article->setTitle($newTitle);
                $article->setContent($newContent);
                return true;
            }
        }
        return false;
    }

    public function supprimerArticle($id) {
        foreach ($this->Articles as $index => $article) {
            if ($article->getId() === $id) {
                unset($this->Articles[$index]);
                return true;
            }
        }
        return false;
    }
}


class Article {
    private $Id;
    private $Title;
    private $Content;
    private $Excerpt;
    private $Status;
    private $CreatedAt;
    private $PublishedAt;
    private $commentaire = [];

    public function __construct($Id, $Title, $Content, $Excerpt, $Status, $CreatedAt, $PublishedAt, $commentaire = []) {
        $this->Id = $Id;
        $this->Title = $Title;
        $this->Content = $Content;
        $this->Excerpt = $Excerpt;
        $this->Status = $Status;
        $this->CreatedAt = $CreatedAt;
        $this->PublishedAt = $PublishedAt;
        $this->commentaire = $commentaire;
    }

    public function getId() {
        return $this->Id;
    }

    public function getTitle() {
        return $this->Title;
    }

    public function getContent() {
        return $this->Content;
    }

    public function getExcerpt() {
        return $this->Excerpt;
    }

    public function getStatus() {
        return $this->Status;
    }

    public function getCreatedAt() {
        return $this->CreatedAt;
    }

    public function getPublishedAt() {
        return $this->PublishedAt;
    }

    public function getCommentaires() {
        return $this->commentaire;
    }

    public function setTitle($Title) {
        $this->Title = $Title;
    }

    public function setContent($Content) {
        $this->Content = $Content;
    }

    public function setExcerpt($Excerpt) {
        $this->Excerpt = $Excerpt;
    }

    public function setStatus($Status) {
        $this->Status = $Status;
    }

    public function setCreatedAt($CreatedAt) {
        $this->CreatedAt = $CreatedAt;
    }

    public function setPublishedAt($PublishedAt) {
        $this->PublishedAt = $PublishedAt;
    }

    public function setCommentaires(array $commentaire) {
        $this->commentaire = $commentaire;
    }

    public function listerCommentaires() {
        return $this->commentaire;
    }

    public function ajouterCommentaire(Commentaire $commentaire) {
        $this->commentaire[] = $commentaire;
    }
}


    // function ajouter comment 
    // function modifier comment  
    // function supprimer comment  


class Commentaire {
    private $Id;
    private $Title;
    private $Content;
    private $Username;

    public function __construct($Id, $Title, $Content, $Username) {
        $this->Id = $Id;
        $this->Title = $Title;
        $this->Content = $Content;
        $this->Username = $Username;
    }

    public function getId() {
        return $this->Id;
    }

    public function getTitle() {
        return $this->Title;
    }

    public function getContent() {
        return $this->Content;
    }

    public function getUsername() {
        return $this->Username;
    }

    public function setTitle($Title) {
        $this->Title = $Title;
    }

    public function setContent($Content) {
        $this->Content = $Content;
    }

    public function setUsername($Username) {
        $this->Username = $Username;
    }
}


class Categorie {
    private $Id;
    private $Name;
    private $Description;
    private $Parent;
    private $CreatedAt;

    public function __construct($Id, $Name, $Description, $Parent, $CreatedAt) {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Parent = $Parent;
        $this->CreatedAt = $CreatedAt;
    }

    // Ajout des getters
    public function getId() { return $this->Id; }
    public function getName() { return $this->Name; }
    public function getDescription() { return $this->Description; }
    public function getParent() { return $this->Parent; }
    public function getCreatedAt() { return $this->CreatedAt; }

    // Ajout des setters
    public function setName($Name) { $this->Name = $Name; }
    public function setDescription($Description) { $this->Description = $Description; }
    public function setParent($Parent) { $this->Parent = $Parent; }
}

class Collection {
    private $users = [];
    private $articles = [];
    private $categories = [];
    private $current_user = null;

    public function __construct($users = [], $articles = [], $categories = []) {
        $this->users = $users;
        $this->articles = $articles;
        $this->categories = $categories;
    }

    // --- Auth ---
    public function getUsers() {
        return $this->users;
    }

    public function login($username, $password) {
        foreach ($this->users as $user) {
            if ($user->getUsername() === $username && $user->getPassword() === $password) {
                $this->current_user = $user;
                return true;
            }
        }
        return false;
    }

    public function logout() {
        $this->current_user = null;
    }

    public function getCurrentUser() {
        return $this->current_user;
    }

    public function isLoggedIn() {
        return $this->current_user !== null;
    }

    // --- Articles existants ---
    public function addArticle(Article $article) {
        $this->articles[] = $article;
    }

    public function getArticles() {
        return $this->articles;
    }

    public function findArticleById($id) {
        foreach ($this->articles as $article) {
            if ($article->getId() === $id) {
                return $article;
            }
        }
        return null;
    }

    public function deleteArticle($id) {
        foreach ($this->articles as $index => $article) {
            if ($article->getId() === $id) {
                unset($this->articles[$index]);
                return true;
            }
        }
        return false;
    }

    // ================================
    // ✅ CRUD UTILISATEURS (ADMIN ONLY)
    // ================================
    public function addUser(Utilisateur $user) {
        if ($this->current_user && $this->current_user->canManageUsers()) {
            $this->users[] = $user;
            return true;
        }
        return false;
    }

    public function getUserById($id) {
        if ($this->current_user && $this->current_user->canManageUsers()) {
            foreach ($this->users as $user) {
                if ($user->getID() === $id) {
                    return $user;
                }
            }
        }
        return null;
    }

    public function updateUser($id, $newData) {
        if ($this->current_user && $this->current_user->canManageUsers()) {
            foreach ($this->users as $user) {
                if ($user->getID() === $id) {
                    if (isset($newData['Username'])) $user->setUsername($newData['Username']);
                    if (isset($newData['Email'])) $user->setEmail($newData['Email']);
                    if (isset($newData['Password'])) $user->setPassword($newData['Password']);
                    if (isset($newData['Role'])) $user->setRole($newData['Role']);
                    return true;
                }
            }
        }
        return false;
    }

    public function deleteUser($id) {
        if ($this->current_user && $this->current_user->canManageUsers()) {
            foreach ($this->users as $index => $user) {
                if ($user->getID() === $id) {
                    unset($this->users[$index]);
                    return true;
                }
            }
        }
        return false;
    }

    // ================================
    // ✅ CRUD CATÉGORIES (EDITOR & ADMIN)
    // ================================
    public function addCategorie(Categorie $categorie) {
        if ($this->current_user && $this->current_user->canManageCategories()) {
            $this->categories[] = $categorie;
            return true;
        }
        return false;
    }

    public function getCategories() {
        return $this->categories;
    }

    public function getCategorieById($id) {
        if ($this->current_user && $this->current_user->canManageCategories()) {
            foreach ($this->categories as $cat) {
                if ($cat->getId() === $id) {
                    return $cat;
                }
            }
        }
        return null;
    }

    public function updateCategorie($id, $newData) {
        if ($this->current_user && $this->current_user->canManageCategories()) {
            foreach ($this->categories as $cat) {
                if ($cat->getId() === $id) {
                    if (isset($newData['Name'])) $cat->setName($newData['Name']);
                    if (isset($newData['Description'])) $cat->setDescription($newData['Description']);
                    if (isset($newData['Parent'])) $cat->setParent($newData['Parent']);
                    return true;
                }
            }
        }
        return false;
    }

    public function deleteCategorie($id) {
        if ($this->current_user && $this->current_user->canManageCategories()) {
            foreach ($this->categories as $index => $cat) {
                if ($cat->getId() === $id) {
                    unset($this->categories[$index]);
                    return true;
                }
            }
        }
        return false;
    }
}