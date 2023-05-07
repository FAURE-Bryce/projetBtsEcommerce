<?php

/**
 * /classe/Marque.php
 * Définition de la class Marque
 *
 * @author B.FAURE
 * @date 02/2023
 */

class Marque
{
    private $id;
    private $libelle;

    public function __construct(){
        
    }

    /* -- Get -- */ 
    /* Début */ 

    public function GetId(): int
    {
        return $this->id;
    }

    public function GetLibelle(): string
    {
        return $this->libelle;
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

    public function SetLibelle(string $libelle)
    {
        $this->libelle = $libelle;
    }

    /* -- Set -- */ 
    /* Fin */ 
}
?>