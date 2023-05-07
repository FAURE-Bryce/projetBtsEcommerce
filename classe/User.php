<?php

/**
 * /classe/User.php
 * Définition de la class User
 *
 * @author B.FAURE
 * @date 02/2023
 */

class User
{
    private $id;
    private $nom;
    private $prenom;
    private $dateDeNaissance;
    private $numeroTelephone;
    private $adresse;
    private $ville;
    private $cp;
    private $email;
    private $mdp;
    private $idRole;
    

    /* -- Objet -- */ 
    private $role;

    public function __construct(){
        
    }

    /* -- Get -- */ 
    /* Début */ 

    public function GetId(): int
    {
        return $this->id;
    }

    public function GetNom(): string
    {
        return $this->nom;
    }

    public function GetPrenom(): string
    {
        return $this->prenom;
    }

    public function GetDateDeNaissance(): string
    {
        return $this->dateDeNaissance;
    }

    public function GetNumeroTelephone(): string
    {
        return $this->numeroTelephone;
    }

    public function GetAdresse(): string
    {
        return $this->adresse;
    }

    public function GetVille(): string
    {
        return $this->ville;
    }

    public function GetCodePostal(): string
    {
        return $this->cp;
    }

    public function GetEmail(): string
    {
        return $this->email;
    }

    public function GetMdp(): string
    {
        return $this->mdp;
    }

    public function GetRole(): Role
    {
        return $this->role;
    }

    /* -- Get -- */ 
    /* Fin */ 

    /* -- Set -- */ 
    /* Début */ 

    //SetId n'est là que pour le chargement des données, on ne peut pas modifier une pk de table !
    public function SetId(int $id)
    {
        $this->id = $id;
    }

    public function SetNom(string $nom)
    {
        $this->nom = $nom;
    }
    
    public function SetPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }

    public function SetDateDeNaissance(string $dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;
    }

    public function SetNumeroTelephone(string $numeroTelephone)
    {
        $this->numeroTelephone = $numeroTelephone;
    }

    public function SetAdresse(string $adresse)
    {
        $this->adresse = $adresse;
    }

    public function SetVille(string $ville)
    {
        $this->ville = $ville;
    }

    public function SetCodePostal(string $cp)
    {
        $this->cp = $cp;
    }

    public function SetEmail(string $email)
    {
        $this->email = $email;
    }

    public function SetMdp(string $mdp)
    {
        $this->mdp = $mdp;
    }

    //SetIdRole n'est là que pour le chargement des données, on ne peut pas modifier une pk de table !
    public function SetIdRole(int $idRole)
    {
        $this->idRole = $idRole;
    }

    public function SetRole(Role $role)
    {
        $this->role = $role;
    }
    
    /* -- Set -- */ 
    /* Fin */ 
}
?>