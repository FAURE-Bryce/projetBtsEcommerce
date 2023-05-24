<?php

/**
 * /model/TailleManager.php
 * Définition de la class TailleManager
 *
 * @author B.FAURE
 * @date 05/2021
 */

class CommandeManager {
    
    private static ?\PDO $cnx;
    
    public static function insertCommande(int $idModePaiement, int $idUser){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'insert into commande (idModePaiement, idUser)';
            $sql .= ' values (:idModePaiement, :idUser)';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('idModePaiement', $idModePaiement, PDO::PARAM_INT);
            $result->bindParam('idUser', $idUser, PDO::PARAM_INT);
            $result->execute();

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getLastIdCommande(){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'SELECT id';
            $sql .= ' FROM commande';
            $sql .= ' WHERE id = (SELECT MAX(id) from commande)';
            
            $result = self::$cnx->prepare($sql);
            
            $result->execute();

            $result->setFetchMode(PDO::FETCH_OBJ);

            $uneLigne = $result->fetch();
            
            $idCommande = $uneLigne->id;

            return $idCommande;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getLesCommandesByIdUser(int $idUser, int $nbElementParPage, int $numPage){
        try{

            
            $numPage = ($numPage-1)*$nbElementParPage;

            self::$cnx = DbManager::getConnection();
            
            $sql = 'SELECT id, idModePaiement';
            $sql .= ' FROM commande';
            $sql .= ' WHERE idUser = :idUser';
            $sql .= ' LIMIT :nbElementParPage OFFSET :numPage ;';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('numPage', $numPage, PDO::PARAM_INT);
            $result->bindParam('nbElementParPage', $nbElementParPage, PDO::PARAM_INT);
            $result->bindParam('idUser', $idUser, PDO::PARAM_INT);
            $result->execute();

            $listCommandeUser = array();

            $result->setFetchMode(PDO::FETCH_OBJ);
            while ($uneLigne = $result->fetch()) {
                $uneCommande = new Commande();
                $uneCommande->SetId($uneLigne->id);
                $uneCommande->SetIdModePaiement($uneLigne->idModePaiement);
                $uneCommande->SetIdUser($idUser);

                $uneCommande->SetModePaiement(ModePaiementManager::getModePaiementById($uneLigne->idModePaiement));
                $uneCommande->SetUser(UserManager::getUserById($idUser));
                
                array_push($listCommandeUser, $uneCommande);
            } 

            return $listCommandeUser;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getLaCommandeById(int $id){
        try{
            self::$cnx = DbManager::getConnection();
            
            $sql = 'SELECT idUser, idModePaiement';
            $sql .= ' FROM commande';
            $sql .= ' WHERE id = :id';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->execute();

            $listCommandeUser = array();

            $result->setFetchMode(PDO::FETCH_OBJ);
            
            $uneLigne = $result->fetch();
            $uneCommande = new Commande();
            $uneCommande->SetId($id);
            $uneCommande->SetIdModePaiement($uneLigne->idModePaiement);
            $uneCommande->SetIdUser($uneLigne->idUser);

            $uneCommande->SetModePaiement(ModePaiementManager::getModePaiementById($uneLigne->idModePaiement));
            $uneCommande->SetUser(UserManager::getUserById($uneLigne->idUser));
                

            return $uneCommande;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getNbCommandesByIdUser(int $id){
        try{
            self::$cnx = DbManager::getConnection();

            $sql = 'select count(*) as countNbProduit';
            $sql .= ' FROM commande';
            $sql .= ' where idUser = :id;';
            
            $result = self::$cnx->prepare($sql);
            
            $result->bindParam('id', $id, PDO::PARAM_INT);
            $result->execute();
            
            $uneLigne = $result->fetch();

            $result->setFetchMode(PDO::FETCH_OBJ);
            
            return $uneLigne[0];
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
