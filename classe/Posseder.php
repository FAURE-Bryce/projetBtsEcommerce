<?php

/**
 * /classe/Posseder.php
 * Définition de la class Posseder
 *
 * @author B.FAURE
 * @date 02/2023
 */

class Posseder
{
    private $idStatut;
    private $idCommande;
    private $datePosseder;
    

    /* -- Objet -- */ 
    private $statut;
    private $commande;

    public function __construct(){
        
    }

    /* -- Get Début -- */ 

    public function GetIdStatut(): int
    {
        return $this->idStatut;
    }

    public function GetIdCommande(): string
    {
        return $this->idCommande;
    }

    public function GetDatePosseder(): DateTime
    {
        return $this->datePosseder;
    }

    public function GetStatut(): StatutCommande
    {
        return $this->statut;
    }

    public function GetCommande(): Commande
    {
        return $this->commande;
    }

    /* -- Get Fin -- */ 

    /* -- Set Début -- */ 

    public function SetIdStatut(int $idStatut)
    {
        $this->idStatut = $idStatut;
    }

    public function SetIdCommande(string $idCommande)
    {
        $this->idCommande = $idCommande;
    }

    public function SetDatePosseder(DateTime $datePosseder)
    {
        $this->datePosseder = $datePosseder;
    }

    public function SetStatut(StatutCommande $statut)
    {
        $this->statut = $statut;
    }

    public function SetCommande(Commande $commande)
    {
        $this->commande = $commande;
    }

    /* -- Set Fin -- */ 
}
?>