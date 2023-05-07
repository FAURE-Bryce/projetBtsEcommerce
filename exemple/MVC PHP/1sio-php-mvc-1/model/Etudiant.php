<?php

/**
 * /model/Etudiant.php
 * Définition de la class Etudiant
 *
 * @author T. Savary
 * @date 05/2021
 */

class Etudiant {
    
    private int $idetudiant;
    private string $nom;
    private string $prenom;
    private DateTime $datenaissance;
    private string $email;
    private string $telmobile;
    private Section $laSection;
    
    public function __construct() {
        
    }
    
    public function getIdEtudiant(): int{
        return$this->idetudiant;
    }
    public function setIdEtudiant(int $pIdEtudiant){
        $this->idetudiant = $pIdEtudiant;
    }
    
    public function getNom(): string{
        return $this->nom;
    }
    public function setNom(string $pNom){
        $this->nom = $pNom;
    }
    
    public function getPrenom(): string{
        return $this->prenom;
    }
    public function setPrenom(string $pPrenom){
        $this->prenom = $pPrenom;
    }
    
    public function getDateNaissance(): DateTime{
        return $this->datenaissance;
    }
    public function setDateNaissance(DateTime $pDateNaissance)
    {
        $this->datenaissance = $pDateNaissance;
    }

    public function getEmail(): string{
        return $this->email;
    }
    public function setEmail(string $pEmail){
        $this->email = $pEmail;
    }
    
    public function getTelMobile(): string{
        return $this->telmobile;
    }
    public function setTelMobile(string $pTelMobile)
    {
        $this->telmobile = $pTelMobile;
    }
    
    public function getLaSection(): Section{
        return $this->laSection;
    }
    public function setLaSection(Section $pLaSection){
        $this->laSection = $pLaSection;
    }
    
}

?>