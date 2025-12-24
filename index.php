<?php 
class utilisateur {
    private $ID ;
    private $Username ;
    private $Email ; 
    private $Password ; 
    private $Role ;
    private $CreatedAt ;
    private $LastLogin ; 

    public function __construct($id, $username, $email, $password, $role, $createdAt, $lastLogin){
        $this->ID = $id;
        $this->Username = $username ; 
        $this->Email = $email ; 
        $this->Password = $password ; 
        $this->Role = $role ; 
        $this->CreatedAt = $createdAt ; 
        $this->LastLogin = $lastLogin;
    }

    public function afficherInfos(){
        return"Utilisateur : .$username (.$email)";
    }

    $user1 = new User('john','john@mail.com');

    $user1->afficherInfos();
}

class editeur extends utilisateur{
    private $ModerationLevel ; 

    public function __construct($id, $username, $email, $password, $role, $createdAt, $lastLogin ,$ModerationLevel){
        $this->ID = $id;
        $this->Username = $username ; 
        $this->Email = $email ; 
        $this->Password = $password ; 
        $this->Role = $role ; 
        $this->CreatedAt = $createdAt ; 
        $this->LastLogin = $lastLogin;
        $this->ModerationLevel = $moderationLevel ;
    }
}

class administrateur extends utilisateur{
    private $IsSuperAdmin ;

    public function __construct($id, $username, $email, $password, $role, $createdAt, $lastLogin ,$IsSuperAdmin){
        $this->ID = $id;
        $this->Username = $username ; 
        $this->Email = $email ; 
        $this->Password = $password ; 
        $this->Role = $role ; 
        $this->CreatedAt = $createdAt ; 
        $this->LastLogin = $lastLogin;
        $this->IsSuperAdmin = $isSuperAdmin ;
    }
} 

class auteur extends utilisateur{
    private $Bio ;

    public function __construct($id, $username, $email, $password, $role, $createdAt, $lastLogin ,$Bio){
        $this->ID = $id;
        $this->Username = $username ; 
        $this->Email = $email ; 
        $this->Password = $password ; 
        $this->Role = $role ; 
        $this->CreatedAt = $createdAt ; 
        $this->LastLogin = $lastLogin;
        $this->Bio = $bio ; 
    }
}

class article {
    private $Id ;
    private $Title ; 
    private $Content ; 
    private $Excerpt ; 
    private $Status ;
    private $Author ; 
    private $CreatedAt ; 
    private $PublishedAt ; 

    public function __construct($Id, $Title, $Content, $Excerpt, $Status, $Author,$createdAt,$PublishedAt){
        $this->Id = $id ; 
        $this->Title = $title ;
        $this->Content = $Content ; 
        $this->Excerpt = $excerpt ; 
        $this->Status = $status ; 
        $this->Author = $author ;
        $this->CreatedAt = $createdAt ;
        $this->PublishedAt = $publishedAt ;
    }
}

class categorie {
    private $Id ; 
    private $Name ; 
    private $Description ; 
    private $Parent ; 
    private $CreatedAt ;

    public function __construct($Id, $Name,$Description,$Parent,$CreatedAt){
        $this->Id = $id ; 
        $this->Name = $name ;
        $this->Description = $description ; 
        $this->Parent = $parent ; 
        $this->CreatedAt = $createdAt ;
    }
}

class commentaire {
    private $Contenue ;
    private $DateCm ;
    private $UserName ; 
}

    public function __construct($Contenue,$DateCm,$UserName){
        $this->Contenue = $contenue ; 
        $this->DateCm = $dateCm ; 
        $this->UserName = $username ; 
    }


?>