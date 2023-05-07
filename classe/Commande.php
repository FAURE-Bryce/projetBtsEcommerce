<?php

/**
 * /classe/Commande.php
 * Définition de la class Commande
 *
 * @author B.FAURE
 * @date 02/2023
 */

class Commande
{
    private $id;
    private $idModePaiment;
    private $idUser;

    /* -- Objet -- */ 
    private $modePaiment;
    private $user;
    

    public function __construct(){
        
    }

    /* -- Get -- */ 
    /* Début */ 

    public function GetId(): int
    {
        return $this->id;
    }

    public function GetIdModePaiement(): int
    {
        return $this->idModePaiment;
    }

    public function GetIdUser(): int
    {
        return $this->idUser;
    }

    public function GetModePaiement(): ModePaiment
    {
        return $this->idModePaiment;
    }

    public function GetUser(): User
    {
        return $this->idUser;
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

    public function SetIdModePaiement(string $idModePaiment)
    {
        $this->idModePaiment = $idModePaiment;
    }

    public function SetIdUser(string $idUser)
    {
        $this->idUser = $idUser;
    }

    public function SetModePaiement(ModePaiement $modePaiment)
    {
        $this->modePaiment = $modePaiment;
    }

    public function SetUser(User $user)
    {
        $this->user = $user;
    }
    
    /* -- Set -- */ 
    /* Fin */ 
}
?>