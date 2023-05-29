<?php

/**
 * /classe/TypeEcran.php
 * Définition de la class TypeEcran
 *
 * @author B.FAURE
 * @date 02/2023
 */

class TypeEcran
{
    private $id;
    private $libelle;

    public function __construct(){
        
    }

    /* -- Get Début -- */ 

    public function GetId(): int
    {
        return $this->id;
    }

    public function GetLibelle(): string
    {
        return $this->libelle;
    }

    /* -- Get Fin -- */ 

    /* -- Set Début -- */ 

    public function SetId(int $id)
    {
        $this->id = $id;
    }

    public function SetLibelle(string $libelle)
    {
        $this->libelle = $libelle;
    }

    /* -- Set Fin -- */
}
?>