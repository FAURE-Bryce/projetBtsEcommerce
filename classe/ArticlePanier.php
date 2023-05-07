<?php

/**
 * /classe/ArticlePanier.php
 * Définition de la class ArticlePanier
 *
 * @author B.FAURE
 * @date 02/2023
 */

class ArticlePanier
{
    private $produit;
    private $qte;

    public function __construct(){
        
    }

    /* -- Get -- */ 
    /* Début */ 

    public function GetProduit(): Produit
    {
        return $this->produit;
    }

    public function GetQte(): int
    {
        return $this->qte;
    }

    /* -- Get -- */ 
    /* Fin */ 

    /* -- Set -- */ 
    /* Début */ 

    public function SetProduit(Produit $produit)
    {
        $this->produit = $produit;
    }

    public function SetQte(int $qte)
    {
        $this->qte = $qte;
    }
    /* -- Set -- */ 
    /* Fin */ 
}
?>