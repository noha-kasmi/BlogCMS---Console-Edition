<?php 
class User {
    private $username ;
    private $Email ; 

    public function __construct( $username, $email){
        $this->username = $username ; 
        $this->Email = $email ; 
    }

    public function afficherInfos(){
        return "Utilisateur :" .$this->username .$this->Email ;
    }
}
    $user1 = new User("john","john@mail.com");

    echo $user1 ->afficherInfos();
?>
<?php 
class User {
    private $username ;
    private $Email ; 
    private $role ;

    public function __construct( $username, $email , $role){
        $this->username = $username ; 
        $this->Email = $email ; 
        $this->role = $role ;
    }

    public function afficherInfos(){
        return "Utilisateur :" .$this->username .$this->Email ;
    }
    
    public function estAuteur(){
        if ($this->role == "auteur"){
            return true ; 
        }
        }
    }

$userAuteur = new User("lea", "lea@blog.com", "auteur");
$userVisiteur = new User("visiteur", "v@blog.com", "visiteur");

echo "Lea peut-elle créer un article ? " . ($userAuteur->estAuteur() ? "OUI" : "NON") . "\n";
echo "Le visiteur peut-il créer un article ? " . ($userVisiteur->estAuteur() ? "OUI" : "NON") . "\n";
?>



<?php 
class User {
    private $username ;
    private $Email ; 
    private $role ;

    public function __construct( $username, $email , $role){
        $this->username = $username ; 
        $this->Email = $email ; 
        $this->role = $role ;
    }

    public function afficherInfos(){
        return "Utilisateur :" .$this->username .$this->Email ;
    }
    
    public function estAuteur(){
        if ($this->role == "auteur"){
            return true ; 
        }
    }
}
class article {
    private $title ;
    private $content ;
    private $status ; 
    
    public function __construct( $title, $content , $status){
        $this->title = $title ; 
        $this->content = $content ; 
        $this->status = "brouillon";
    }

    public function publier() {
        $this->status = "publié" ;
    }
}

$userAuteur = new User("lea", "lea@blog.com", "auteur");
$userVisiteur = new User("visiteur", "v@blog.com", "visiteur");

echo "Lea peut-elle créer un article ? " . ($userAuteur->estAuteur() ? "OUI" : "NON") . "\n";
echo "Le visiteur peut-il créer un article ? " . ($userVisiteur->estAuteur() ? "OUI" : "NON") . "\n";
?>


$article = new Article("Mon premier article", "Contenu du blog...");