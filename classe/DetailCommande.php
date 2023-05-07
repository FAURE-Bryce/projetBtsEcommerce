<?php

/**
 * /classe/DetailCommande.php
 * Définition de la class DetailCommande
 *
 * @author B.FAURE
 * @date 02/2023
 */

class DetailCommande
{
    private $idProduit;
    private $idCommande;
    private $qte;
    

    /* -- Objet -- */ 
    private $produit;
    private $commande;

    public function __construct(){
        
    }

    /* -- Get -- */ 
    /* Début */ 

    public function GetIdProduit(): int
    {
        return $this->idProduit;
    }

    public function GetIdCommande(): int
    {
        return $this->idCommande;
    }

    public function GetQte(): int
    {
        return $this->qte;
    }

    public function GetProduit(): Produit
    {
        return $this->produit;
    }

    public function GetCommande(): Commande
    {
        return $this->commande;
    }

    /* -- Get -- */ 
    /* Fin */ 

    /* -- Set -- */ 
    /* Début */ 

    //SetIdProduit n'est là que pour le chargement des données, on ne peut pas modifier une pk de table !
    public function SetIdProduit(int $idProduit)
    {
        $this->idProduit = $idProduit;
    }

    //SetIdCommande n'est là que pour le chargement des données, on ne peut pas modifier une pk de table !
    public function SetIdCommande(string $idCommande)
    {
        $this->idCommande = $idCommande;
    }

    public function SetQte(string $qte)
    {
        $this->qte = $qte;
    }

    public function SetProduit(Produit $produit)
    {
        $this->produit = $produit;
    }

    public function SetCommande(Commande $commande)
    {
        $this->commande = $commande;
    }
    
    /* -- Set -- */ 
    /* Fin */ 
}
?>