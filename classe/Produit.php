<?php

/**
 * /classe/Produit.php
 * Définition de la class Produit
 *
 * @author B.FAURE
 * @date 02/2023
 */

class Produit
{
    private $id;
    private $libelle;
    private $resume;
    private $description;
    private $pathPhoto;
    private $qteEnStock;
    private $prixVenteUHT;
    private $idModel;
    private $idMarque;
    private $idTaille;
    private $idType;
    

    /* -- Objet -- */ 
    private $model;
    private $marque;
    private $taille;
    private $type;

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

    public function GetResume(): string
    {
        return $this->resume;
    }

    public function GetDescription(): string
    {
        return $this->description;
    }

    public function GetPathPhoto(): string
    {
        return $this->pathPhoto;
    }

    public function GetQteEnStock(): int
    {
        return $this->qteEnStock;
    }

    public function GetPrixVenteUht(): float
    {
        return $this->prixVenteUHT;
    }

    public function GetIdModel(): int
    {
        return $this->idModel;
    }

    public function GetIdMarque(): int
    {
        return $this->idMarque;
    }

    public function GetIdTaille(): int
    {
        return $this->idTaille;
    }

    public function GetIdType(): int
    {
        return $this->idType;
    }

    public function GetModel(): Model
    {
        return $this->model;
    }

    public function GetMarque(): Marque
    {
        return $this->marque;
    }

    public function GetTaille(): Taille
    {
        return $this->taille;
    }

    public function GetType(): TypeEcran
    {
        return $this->type;
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

    public function SetResume(string $resume)
    {
        $this->resume = $resume;
    }

    public function SetDescription(string $description)
    {
        $this->description = $description;
    }

    public function SetPathPhoto(string $pathPhoto)
    {
        $this->pathPhoto = $pathPhoto;
    }

    public function SetQteEnStock(int $qteEnStock)
    {
        $this->qteEnStock = $qteEnStock;
    }

    public function SetPrixVenteUht(float $prixVenteUHT)
    {
        $this->prixVenteUHT = $prixVenteUHT;
    }

    //SetIdModel n'est là que pour le chargement des données, on ne peut pas modifier une pk de table !
    public function SetIdModel(int $idModel)
    {
        $this->idModel = $idModel;
    }

    //SetIdMarque n'est là que pour le chargement des données, on ne peut pas modifier une pk de table !
    public function SetIdMarque(int $idMarque)
    {
        $this->idMarque = $idMarque;
    }

    //SetIdTaille n'est là que pour le chargement des données, on ne peut pas modifier une pk de table !
    public function SetIdTaille(int $idTaille)
    {
        $this->idTaille = $idTaille;
    }

    //SetIdType n'est là que pour le chargement des données, on ne peut pas modifier une pk de table !
    public function SetIdType(int $idType)
    {
        $this->idType = $idType;
    }

    public function SetModel(Model $model)
    {
        $this->model = $model;
    }

    public function SetMarque(Marque $marque)
    {
        $this->marque = $marque;
    }

    public function SetTaille(Taille $taille)
    {
        $this->taille = $taille;
    }

    public function SetType(TypeEcran $type)
    {
        $this->type = $type;
    }

    /* -- Set -- */ 
    /* Fin */ 
}
?>