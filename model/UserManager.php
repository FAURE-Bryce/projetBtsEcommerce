<?php

/**
 * /model/UserManager.php
 * Définition de la class UserManager
 *
 * @author B.FAURE
 * @date 05/2021
 */

class UserManager {
    
    private static ?\PDO $cnx;
    
    public static function getLesUsersByIdRole(int $id){
        $lesUsers = array();
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select id, nom, prenom, dateNaissance, numeroTelephone, adresse, ville, codePoste, adresseMail, motDePasse, idRole';
            $sql .= ' from user';
            $sql .= ' where idRole = :idRole';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('idRole', $id, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $unUser = new User();
                $unUser->SetId($uneLigne->id);
                $unUser->SetNom($uneLigne->nom);
                $unUser->SetPrenom($uneLigne->prenom);
                $unUser->SetDateDeNaissance($uneLigne->dateNaissance);
                $unUser->SetNumeroTelephone($uneLigne->numeroTelephone);
                $unUser->SetAdresse($uneLigne->adresse);
                $unUser->SetVille($uneLigne->ville);
                $unUser->SetCodePostal($uneLigne->codePoste);
                $unUser->SetEmail($uneLigne->adresseMail);
                $unUser->SetMdp($uneLigne->motDePasse);
                $unUser->SetIdRole($uneLigne->idRole);

                $unUser->SetRole(RoleManager::getRoleById($uneLigne->idRole));
                
                array_push($lesUsers, $unUser);
            } 
            return $lesUsers;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getLesEmailsUsersByIdRole(int $id){
        $lesUsers = array();
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select adresseMail';
            $sql .= ' from user';
            $sql .= ' where idRole = :idRole';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('idRole', $id, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $listeEmailsUsers = array();

                array_push($listeEmailsUsers, $uneLigne->adresseMail);
            } 

            return $listeEmailsUsers;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function addUser($nom, $prenom, $dateNaissance, $numeroTelephone, $adresse, $ville, $codePoste, $adresseMail, $motDePasse, $idRole){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'insert into User(nom, prenom, dateNaissance, numeroTelephone, adresse, ville, codePoste, adresseMail, motDePasse, idRole) ';
            $sql .= 'values (:nom, :prenom, :dateNaissance, :numeroTelephone, :adresse, :ville, :codePoste, :adresseMail, :motDePasse, :idRole)';
            
            $result = self::$cnx->prepare($sql);
            $result->bindParam('nom', $nom, PDO::PARAM_STR);
            $result->bindParam('prenom', $prenom, PDO::PARAM_STR);
            $result->bindParam('dateNaissance', $dateNaissance, PDO::PARAM_STR);
            $result->bindParam('numeroTelephone', $numeroTelephone, PDO::PARAM_STR);
            $result->bindParam('adresse', $adresse, PDO::PARAM_STR);
            $result->bindParam('ville', $ville, PDO::PARAM_STR);
            $result->bindParam('codePoste', $codePoste, PDO::PARAM_INT);
            $result->bindParam('adresseMail', $adresseMail, PDO::PARAM_STR);
            $result->bindParam('motDePasse', $motDePasse, PDO::PARAM_STR);
            $result->bindParam('idRole', $idRole, PDO::PARAM_STR);
            
            $result->execute();

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getUserByAdresseMail(string $adresseMail){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select id, nom, prenom, dateNaissance, numeroTelephone, adresse, ville, codePoste, adresseMail, motDePasse, idRole';
            $sql .= ' from user';
            $sql .= ' where adresseMail = :adresseMail';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('adresseMail', $adresseMail, PDO::PARAM_STR);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            $uneLigne = $result->fetch();

            $unUser = new User();
            $unUser->SetId($uneLigne->id);
            $unUser->SetNom($uneLigne->nom);
            $unUser->SetPrenom($uneLigne->prenom);
            $unUser->SetDateDeNaissance($uneLigne->dateNaissance);
            $unUser->SetNumeroTelephone($uneLigne->numeroTelephone);
            $unUser->SetAdresse($uneLigne->adresse);
            $unUser->SetVille($uneLigne->ville);
            $unUser->SetCodePostal($uneLigne->codePoste);
            $unUser->SetEmail($uneLigne->adresseMail);
            $unUser->SetMdp($uneLigne->motDePasse);
            $unUser->SetIdRole($uneLigne->idRole);

            $unUser->SetRole(RoleManager::getRoleById($uneLigne->idRole));
            
            return $unUser;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getUserById(int $id){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'select id, nom, prenom, dateNaissance, numeroTelephone, adresse, ville, codePoste, adresseMail, motDePasse, idRole';
            $sql .= ' from user';
            $sql .= ' where id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->execute();
            
            $result->setFetchMode(PDO::FETCH_OBJ);
            $uneLigne = $result->fetch();

            $unUser = new User();
            $unUser->SetId($uneLigne->id);
            $unUser->SetNom($uneLigne->nom);
            $unUser->SetPrenom($uneLigne->prenom);
            $unUser->SetDateDeNaissance($uneLigne->dateNaissance);
            $unUser->SetNumeroTelephone($uneLigne->numeroTelephone);
            $unUser->SetAdresse($uneLigne->adresse);
            $unUser->SetVille($uneLigne->ville);
            $unUser->SetCodePostal($uneLigne->codePoste);
            $unUser->SetEmail($uneLigne->adresseMail);
            $unUser->SetMdp($uneLigne->motDePasse);
            $unUser->SetIdRole($uneLigne->idRole);

            $unUser->SetRole(RoleManager::getRoleById($uneLigne->idRole));
            
            return $unUser;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function updateUser($nom, $prenom, $adresse, $cp, $ville, $id){
        try{
            echo "coucou";
            self::$cnx = DbManager::getConnection();
            
            $sql = 'UPDATE User ';
            $sql .= 'SET nom = :nom, prenom= :prenom, adresse = :adresse, codePoste = :cp, ville = :ville ';
            $sql .= 'WHERE id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->bindParam('nom', $nom, PDO::PARAM_STR);
            $result->bindParam('prenom', $prenom, PDO::PARAM_STR);
            $result->bindParam('adresse', $adresse, PDO::PARAM_STR);
            $result->bindParam('cp', $cp, PDO::PARAM_STR);
            $result->bindParam('ville', $ville, PDO::PARAM_STR);
            $result->execute();

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}