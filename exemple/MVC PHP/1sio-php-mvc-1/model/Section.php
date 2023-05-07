<?php

/**
 * /model/Section.php
 * Définition de la class Section
 * Une section correspond à une classe d'étudiants, exemple: 1SIO SISR, 1SIO SLAM...
 *
 * @author T. Savary
 * @date 05/2021
 */

class Section {
    
    private $idsection;
    private $libellesection;
    
    public function __construct() {
    }
    
    public function getIdSection(){
        return $this->idsection;
    }
    public function setIdSection(int $pIdSection){
        $this->idsection = $pIdSection;
    }
    public function getLibelleSection(){
        return $this->libellesection;
    }
    public function setLibelleSection(string $pLibelleSection){
        $this->libellesection = $pLibelleSection;
    }
}

?>