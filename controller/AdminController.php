<?php

/**
 * /controller/AdminController.php
 * 
 * Contrôleur pour tout le pannel Admin
 *
 * @author B.Faure
 * @date 04/2023
 */

    class AdminController {

        /* Produit Début */

        /**
         * List des produits
         */
        public static function listProduit($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
                
                if(empty($_GET['numPage'])){
                    $numPage = 1;
                }else{
                    $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }
    
                $nbElementParPage = 10;
    
                $nbProduit = ProduitManager::getNbProduits();
    
                $params['nbPage'] = ceil($nbProduit / $nbElementParPage);
    
                $params['numPage'] = $numPage;

                $params['listProduits'] = ProduitManager::getLesProduitsByPagination($nbElementParPage, $numPage);
    
                require_once ROOT.'/view/admin/listProduit.php';
            }
            
        }

        /**
         * Page de mise à jour d'un produit
         */
        public static function updateProduit($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
                
                if(isset($_GET['idProduit'])){
                    $idProduit = filter_input(INPUT_GET, 'idProduit', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }

                $params['produit'] = ProduitManager::getLeProduitById($idProduit);
                $params['listeModel'] = ModelManager::getLesModels();
                $params['listeMarque'] = MarqueManager::getLesMarques();
                $params['listeType'] = TypeEcranManager::getLesTypesEcrans();
                $params['listeTaille'] = TailleManager::getLesTailles();

                $updated = 1;

                if (isset($_POST['formModification']) && !empty($_POST['formModification'])) {
                    
                    $updated = 2;

                    if(isset($_POST['idModel']) && !empty($_POST['idModel']) && isset($_POST['libelle']) && !empty($_POST['libelle']) && isset($_POST['resume']) && !empty($_POST['resume']) && isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['patchPhoto']) && !empty($_POST['patchPhoto']) && isset($_POST['qteEnStock']) && !empty($_POST['qteEnStock']) && isset($_POST['prixVenteUht']) && !empty($_POST['prixVenteUht']) && isset($_POST['idMarque']) && !empty($_POST['idMarque']) && isset($_POST['idTaille']) && !empty($_POST['idTaille']) && isset($_POST['idType']) && !empty($_POST['idType'])){
                    
                    
                        $idModel = filter_input(INPUT_POST, 'idModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $resume = filter_input(INPUT_POST, 'resume', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $patchPhoto = filter_input(INPUT_POST, 'patchPhoto', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $qteEnStock = filter_input(INPUT_POST, 'qteEnStock', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $prixVenteUht = filter_input(INPUT_POST, 'prixVenteUht', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $idMarque = filter_input(INPUT_POST, 'idMarque', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $idTaille = filter_input(INPUT_POST, 'idTaille', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $idType = filter_input(INPUT_POST, 'idType', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        
                        if (ctype_digit($qteEnStock)) {
                            if (ctype_digit($idModel)) {
                                if (ctype_digit($idMarque)) {
                                    if (ctype_digit($idTaille)) {
                                        if (ctype_digit($idType)) {
                                            if (strlen($libelle) <= 128){
                                                if (strlen($resume) <= 100){
                                                    if (strlen($description) <= 500){
                                                        if (strlen($patchPhoto) <= 100){
                                                            $prixVenteUht_en_float = floatval($prixVenteUht);
                                                            if (is_float($prixVenteUht_en_float) && preg_match('/^\d+(\.\d{1,2})?$/', $prixVenteUht_en_float)) {
                                                                $produit = new Produit;
                                                                $produit->setLibelle($libelle);
                                                                $produit->setIdModel($idModel);
                                                                $produit->setResume($resume);
                                                                $produit->setDescription($description);
                                                                $produit->SetPathPhoto($patchPhoto);
                                                                $produit->setQteEnStock($qteEnStock);
                                                                $produit->setPrixVenteUHT($prixVenteUht);
                                                                $produit->setIdMarque($idMarque);
                                                                $produit->setIdTaille($idTaille);
                                                                $produit->setIdType($idType);
    
                                                                ProduitManager::updateProduitById($idProduit, $produit);
                                                                $updated = 3;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }                

                if (isset($updated) && $updated == 3) {
                    $params['updated'] = $updated;
                    AdminController::listProduit(array_splice($params, 0));
                }
                else if (isset($updated) && $updated == 2) {
                    $params['updated'] = $updated;

                    require_once ROOT.'/view/admin/updateProduit.php';
                }
                elseif ($updated == 1){
                    require_once ROOT.'/view/admin/updateProduit.php';
                }
            }
            
        }

        /**
         * Page d'ajout d'un nouveau produit
         */
        public static function addProduit($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {

                $params['listeModel'] = ModelManager::getLesModels();
                $params['listeMarque'] = MarqueManager::getLesMarques();
                $params['listeType'] = TypeEcranManager::getLesTypesEcrans();
                $params['listeTaille'] = TailleManager::getLesTailles();

                $add = 1;

                if (isset($_POST['formAdd']) && !empty($_POST['formAdd'])) {
                    $add = 2;
                    if(isset($_POST['idModel']) && !empty($_POST['idModel']) && isset($_POST['libelle']) && !empty($_POST['libelle']) && isset($_POST['resume']) && !empty($_POST['resume']) && isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['patchPhoto']) && !empty($_POST['patchPhoto']) && isset($_POST['qteEnStock']) && !empty($_POST['qteEnStock']) && isset($_POST['prixVenteUht']) && !empty($_POST['prixVenteUht']) && isset($_POST['idMarque']) && !empty($_POST['idMarque']) && isset($_POST['idTaille']) && !empty($_POST['idTaille']) && isset($_POST['idType']) && !empty($_POST['idType'])){
                        $idModel = filter_input(INPUT_POST, 'idModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $resume = filter_input(INPUT_POST, 'resume', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $patchPhoto = filter_input(INPUT_POST, 'patchPhoto', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $qteEnStock = filter_input(INPUT_POST, 'qteEnStock', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $prixVenteUht = filter_input(INPUT_POST, 'prixVenteUht', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $idMarque = filter_input(INPUT_POST, 'idMarque', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $idTaille = filter_input(INPUT_POST, 'idTaille', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $idType = filter_input(INPUT_POST, 'idType', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    

                        if (ctype_digit($qteEnStock)) {
                            if (ctype_digit($idModel)) {
                                if (ctype_digit($idMarque)) {
                                    if (ctype_digit($idTaille)) {
                                        if (ctype_digit($idType)) {
                                            if (strlen($libelle) <= 128){
                                                if (strlen($resume) <= 100){
                                                    if (strlen($description) <= 500){
                                                        if (strlen($patchPhoto) <= 100){
                                                            $prixVenteUht_en_float = floatval($prixVenteUht);
                                                            if (is_float($prixVenteUht_en_float) && preg_match('/^\d+(\.\d{1,2})?$/', $prixVenteUht_en_float)) {
                                                                $produit = new Produit;
                                                                $produit->setLibelle($libelle);
                                                                $produit->setIdModel($idModel);
                                                                $produit->setResume($resume);
                                                                $produit->setDescription($description);
                                                                $produit->SetPathPhoto($patchPhoto);
                                                                $produit->setQteEnStock($qteEnStock);
                                                                $produit->setPrixVenteUHT($prixVenteUht);
                                                                $produit->setIdMarque($idMarque);
                                                                $produit->setIdTaille($idTaille);
                                                                $produit->setIdType($idType);

                                                                ProduitManager::addProduit($produit);
                                                                $add = 3;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if (isset($add) && $add == 3) {
                    $params['add'] = $add;
                    AdminController::listProduit(array_splice($params, 0));
                }
                else if (isset($add) && $add == 2) {
                    $params['add'] = $add;

                    $params['idModel'] = filter_input(INPUT_POST, 'idModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['libelle'] = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['resume'] = filter_input(INPUT_POST, 'resume', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['description'] = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['patchPhoto'] = filter_input(INPUT_POST, 'patchPhoto', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['qteEnStock'] = filter_input(INPUT_POST, 'qteEnStock', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['prixVenteUht'] = filter_input(INPUT_POST, 'prixVenteUht', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['idMarque'] = filter_input(INPUT_POST, 'idMarque', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['idTaille'] = filter_input(INPUT_POST, 'idTaille', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['idType'] = filter_input(INPUT_POST, 'idType', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);    

                    require_once ROOT.'/view/admin/addProduit.php';
                }
                elseif ($add == 1){
                    require_once ROOT.'/view/admin/addProduit.php';
                }
            }
            
        }

        /* -- Produit Fin -- */
        
        /* -- User Début -- */

        /**
         * List des utilisateurs
         */
        public static function listUser($params){   
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
                
                if(empty($_GET['numPage'])){
                    $numPage = 1;
                }else{
                    $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }
    
                $nbElementParPage = 10;
    
                $nbUser = UserManager::getNbUsers();
    
                $params['nbPage'] = ceil($nbUser / $nbElementParPage);
    
                $params['numPage'] = $numPage;
    
                $params['listUsers'] = UserManager::getLesUsersByPagination($nbElementParPage, $numPage);
    
                require_once ROOT.'/view/admin/listUser.php';
            }
            
        }

        /**
         * Page mise à jour d'un utilisateur
         */
        public static function updateUser($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
             
                if(isset($_GET['idUser'])){
                    $idUser = filter_input(INPUT_GET, 'idUser', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }

                $params['user'] = UserManager::getUserById($idUser);
                $params['listeRole'] = RoleManager::getLesRoles();
                
                $updated = 1;

                if(isset($_POST['formUser']) && !empty($_POST['formUser']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['dateDeNaissance']) && !empty($_POST['dateDeNaissance']) && isset($_POST['numeroTelephone']) && !empty($_POST['numeroTelephone']) && isset($_POST['adresse']) && !empty($_POST['adresse']) && isset($_POST['ville']) && !empty($_POST['ville']) && isset($_POST['codePostal']) && !empty($_POST['codePostal']) && isset($_POST['idRole']) && !empty($_POST['idRole'])){
                    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $dateDeNaissance = filter_input(INPUT_POST, 'dateDeNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $numeroTelephone = filter_input(INPUT_POST, 'numeroTelephone', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $adresse = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $codePostal = filter_input(INPUT_POST, 'codePostal', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $idRole = filter_input(INPUT_POST, 'idRole', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    
                    $updated = 2;

                    if (strlen($nom) < 40) {
                        if (strlen($prenom) < 40) {
                            $date = DateTime::createFromFormat('Y-m-d', $dateDeNaissance);
                            $today = new DateTime();
    
                            if ($dateDeNaissance < $today) {
                                if (strlen($numeroTelephone) == 10 && ctype_digit($numeroTelephone)) {
                                    if (strlen($adresse) < 50) {
                                        if (strlen($ville) < 50) {
                                            if (strlen($codePostal) == 5 && ctype_digit($codePostal)) {
                                                if (is_numeric($idRole)) {
                                                    $user = new User;
                                                    $user->setNom($nom);
                                                    $user->setPrenom($prenom);
                                                    $user->setDateDeNaissance($dateDeNaissance);
                                                    $user->setNumeroTelephone($numeroTelephone);
                                                    $user->SetAdresse($adresse);
                                                    $user->setVille($ville);
                                                    $user->setCodePostal($codePostal);
                                                    $user->setIdRole($idRole);

                                                    UserManager::updateUserById($idUser, $user);
                                                    $updated = 3;        
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if (isset($updated) && $updated == 3) {
                    $params['updated'] = $updated;
                    AdminController::listUser(array_splice($params, 0));
                }
                else if (isset($updated) && $updated == 2) {
                    $params['updated'] = $updated;

                    require_once ROOT.'/view/admin/updateUser.php';
                }
                elseif ($updated == 1){
                    
                    require_once ROOT.'/view/admin/updateUser.php';
                }
             
            }
         
        }

        /**
         * Page d'ajout d'une nouvel utilisateur
         */
        public static function addUser($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {

                $params['listeRole'] = RoleManager::getLesRoles();

                $add = 1;
                
                if(isset($_POST['formUser']) && !empty($_POST['formUser'])){
                    
                    $add = 2;
                    
                    if (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['dateDeNaissance']) && !empty($_POST['dateDeNaissance']) && isset($_POST['numeroTelephone']) && !empty($_POST['numeroTelephone']) && isset($_POST['adresse']) && !empty($_POST['adresse']) && isset($_POST['ville']) && !empty($_POST['ville']) && isset($_POST['codePostal']) && !empty($_POST['codePostal']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['mdp']) && !empty($_POST['mdp']) && isset($_POST['emailConfirmation']) && !empty($_POST['emailConfirmation']) && isset($_POST['mdpConfirmation']) && !empty($_POST['mdpConfirmation']) && isset($_POST['idRole']) && !empty($_POST['idRole'])) {
                        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $dateDeNaissance = filter_input(INPUT_POST, 'dateDeNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $numeroTelephone = filter_input(INPUT_POST, 'numeroTelephone', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $adresse = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $codePostal = filter_input(INPUT_POST, 'codePostal', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $idRole = filter_input(INPUT_POST, 'idRole', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $emailConfirmation = filter_input(INPUT_POST, 'emailConfirmation', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $mdpConfirmation = filter_input(INPUT_POST, 'mdpConfirmation', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);

                        if (strlen($nom) < 40) {
                            if (strlen($prenom) < 40) {
                                $date = DateTime::createFromFormat('Y-m-d', $dateDeNaissance);
                                $today = new DateTime();
                            
                                if ($dateDeNaissance < $today) {
                                    if (strlen($numeroTelephone) == 10 && ctype_digit($numeroTelephone)) {
                                        if (strlen($adresse) < 50) {
                                            if (strlen($ville) < 50) {
                                                if (strlen($codePostal) == 5 && ctype_digit($codePostal)) {
                                                    if (is_numeric($idRole)) {
                                                        if ($email == $emailConfirmation) {
                                                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                                                $listeEmailsUsers = UserManager::getLesEmailsUsersByIdRole(RoleManager::getRoleByLibelle('Client')->getId());
                                                                if (in_array($email, $listeEmailsUsers) == false) {
                                                                    if (UtilitaireController::check_password($mdp)) {
                                                                        $mot_de_passe_hache = password_hash($mdp, PASSWORD_DEFAULT);
                                                                        if (password_verify($mdpConfirmation, $mot_de_passe_hache)) {
                                                                            $user = new User;
                                                                            $user->setNom($nom);
                                                                            $user->setPrenom($prenom);
                                                                            $user->setDateDeNaissance($dateDeNaissance);
                                                                            $user->setNumeroTelephone($numeroTelephone);
                                                                            $user->SetAdresse($adresse);
                                                                            $user->setVille($ville);
                                                                            $user->setCodePostal($codePostal);
                                                                            $user->setIdRole($idRole);
                                                                            $user->setEmail($email);
                                                                            $user->setMdp($mot_de_passe_hache);

                                                                            UserManager::addUserWithObjet($user);
                                                                            $add = 3; 

                                                                        } 
                                                                    }
                                                                }
                                                            }
                                                        }      
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    
                }
             
                if (isset($add) && $add == 3) {
                    $params['add'] = $add;
                    AdminController::listUser(array_splice($params, 0));
                }
                else if (isset($add) && $add == 2) {
                    $params['add'] = $add;

                    $params['nom'] = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['prenom'] = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['dateDeNaissance'] = filter_input(INPUT_POST, 'dateDeNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['numeroTelephone'] = filter_input(INPUT_POST, 'numeroTelephone', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['adresse'] = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['ville'] = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['codePostal'] = filter_input(INPUT_POST, 'codePostal', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['idRole'] = filter_input(INPUT_POST, 'idRole', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $params['emailConfirmation'] = filter_input(INPUT_POST, 'emailConfirmation', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);

                    require_once ROOT.'/view/admin/addUser.php';
                }
                elseif ($add == 1) {
                    require_once ROOT.'/view/admin/addUser.php';
                }
             
            }
         
        }
        
        /* -- User Fin -- */
        
        /* -- Commande Début -- */

        /**
         * List des Commandes
         */
        public static function listCommande($params){   
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
                
                if(empty($_GET['numPage'])){
                    $numPage = 1;
                }else{
                    $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }
    
                $nbElementParPage = 10;
    
                $nbCommande = CommandeManager::getNbCommandes();
    
                $params['nbPage'] = ceil($nbCommande / $nbElementParPage);
    
                $params['numPage'] = $numPage;

                $params['listCommandes'] = CommandeManager::getLesCommandesByPaginationAndIdRoleUser($nbElementParPage, $numPage, RoleManager::getRoleByLibelle('Client')->getId());
    
                require_once ROOT.'/view/admin/listCommande.php';
            }
            
        }

        /**
         * Page de mise à jour d'une Commande, affiche également le detail de cette commande
         */
        public static function updateCommande($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
             
                if(isset($_GET['idCommande'])){
                    $idCommande = filter_input(INPUT_GET, 'idCommande', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }

                $params['commande'] = CommandeManager::getLaCommandeById($idCommande);
                
                $params['listeUserClient'] = UserManager::getLesUsersByIdRole(RoleManager::getRoleByLibelle('Client')->getId());
                $params['listeModePaiement'] = ModePaiementManager::getModePaiement();
                $updated = 1;

                if (isset($_POST['formCommande']) && !empty($_POST['formCommande'])) {
                    $updated = 2;

                    if(isset($_POST['idModePaiement']) && !empty($_POST['idModePaiement']) && isset($_POST['idUser']) && !empty($_POST['idUser'])){
                        $idModePaiement = filter_input(INPUT_POST, 'idModePaiement', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        $idUser = filter_input(INPUT_POST, 'idUser', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
    
                        if (ctype_digit($idModePaiement)) {
                            if (ctype_digit($idModePaiement)) {
                                $commande = new Commande;
                                $commande->setId($idCommande);
                                $commande->setIdModePaiement($idModePaiement);
                                $commande->setIdUser($idUser);

                                CommandeManager::updateCommandeById($idCommande, $commande);

                                $updated = 3;
                            }
                        }
                    }
                }

                if (isset($updated) && $updated == 3) {
                    $params['updated'] = $updated;
                    AdminController::listCommande(array_splice($params, 0));
                }
                else if (isset($updated) && $updated == 2) {
                    $params['updated'] = $updated;
                    require_once ROOT.'/view/admin/updateCommande.php';
                }
                elseif ($updated == 1){
                    require_once ROOT.'/view/admin/updateCommande.php';
                }
             
            }
         
        }
        
        /* -- Commande Fin -- */

        /* -- Detail commande Début -- */

        /**
         * Page de mise à jour d'un détail d'une commande
         */
        public static function updateDetailCommande($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
             
                if(isset($_GET['idCommande']) && isset($_GET['idProduit'])){
                    $idCommande = filter_input(INPUT_GET, 'idCommande', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $idProduit = filter_input(INPUT_GET, 'idProduit', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }

                $params['detailCommande'] = DetailCommandeManager::getLesDetailCommandesByIdCommandeAndByIdProduit($idCommande, $idProduit);
                
                $updated = 1;
                if (isset($_POST['formDetailCommande']) && !empty($_POST['formDetailCommande'])) {
                    $updated = 2;

                    if(isset($_POST['qte']) && !empty($_POST['qte'])){
                        $qte = filter_input(INPUT_POST, 'qte', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        
                        if (ctype_digit($qte)) {

                            DetailCommandeManager::updateDetailCommandeByIdCOmmandeAndByIdProduit($idCommande, $idProduit, $qte);

                            $updated = 3;
                        }
                    }
                }

                if (isset($updated) && $updated == 3) {
                    $params['updated'] = $updated;
                    AdminController::listCommande(array_splice($params, 0));
                }
                else if (isset($updated) && $updated == 2) {
                    $params['updated'] = $updated;
                    
                    require_once ROOT.'/view/admin/updateDetailCommande.php';
                }
                elseif ($updated == 1){
                    
                    require_once ROOT.'/view/admin/updateDetailCommande.php';
                }
             
            }
         
        }
        
        /* -- Detail Commande Fin -- */

        /* -- Role Début -- */

        /**
         * List des Roles
         */
        public static function listRole($params){   
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
                
                if(empty($_GET['numPage'])){
                    $numPage = 1;
                }else{
                    $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }
    
                $nbElementParPage = 10;
    
                $nbRole = RoleManager::getNbRoles();
    
                $params['nbPage'] = ceil($nbRole / $nbElementParPage);
    
                $params['numPage'] = $numPage;
    
                $params['listRoles'] = RoleManager::getLesRolesByPagination($nbElementParPage, $numPage);
                
                require_once ROOT.'/view/admin/listRole.php';
            }
            
        }

        /**
         * Page de mise à jour d'un Role
         */
        public static function updateRole($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
             
                if(isset($_GET['idRole'])){
                    $idRole = filter_input(INPUT_GET, 'idRole', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }

                $params['role'] = RoleManager::getRoleById($idRole);

                $updated = 1;

                if (isset($_POST['formRole']) && !empty($_POST['formRole'])) {
                    $updated = 2;

                    if(isset($_POST['libelle']) && !empty($_POST['libelle'])){
                        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        
                        if (strlen($libelle) <= 40) {
                            RoleManager::updateRoleById($idRole, $libelle);

                            $updated = 3;
                        }
                    }
                }

                if (isset($updated) && $updated == 3) {
                    $params['updated'] = $updated;
                    AdminController::listRole(array_splice($params, 0));
                }
                else if (isset($updated) && $updated == 2) {
                    $params['updated'] = $updated;
                    
                    require_once ROOT.'/view/admin/updateRole.php';
                }
                elseif ($updated == 1){
                    
                    require_once ROOT.'/view/admin/updateRole.php';
                }
             
            }
         
        }

        /**
         * Page d'ajout d'un nouveau Role
         */
        public static function addRole($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {

                $add = 1;
                
                if (isset($_POST['formRole']) && !empty($_POST['formRole'])) {
                    $add = 2;

                    if(isset($_POST['libelle']) && !empty($_POST['libelle'])){
                        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        
                        if (strlen($libelle) <= 40) {
                            $role = new Role;
                            $role->setLibelle($libelle);

                            RoleManager::AddRole($role);

                            $add = 3;
                        }
                    }
                }
             
                if (isset($add) && $add == 3) {
                    $params['add'] = $add;
                    AdminController::listRole(array_splice($params, 0));
                }
                else if (isset($add) && $add == 2) {
                    $params['add'] = $add;

                    $params['libelle'] = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);

                    require_once ROOT.'/view/admin/addRole.php';
                }
                elseif ($add == 1) {
                    
                    require_once ROOT.'/view/admin/addRole.php';
                }
             
            }
         
        }
        
        /* -- Role Fin -- */

        
        /* -- Model Début -- */

        /**
         * List des Models
         */
        public static function listModel($params){   
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
                
                if(empty($_GET['numPage'])){
                    $numPage = 1;
                }else{
                    $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }
    
                $nbElementParPage = 10;
    
                $nbModel = ModelManager::getNbModels();
    
                $params['nbPage'] = ceil($nbModel / $nbElementParPage);
    
                $params['numPage'] = $numPage;
    
                $params['listModels'] = ModelManager::getLesModelsByPagination($nbElementParPage, $numPage);
                
                require_once ROOT.'/view/admin/listModel.php';
            }
            
        }

        /**
         * Page de mise à jour d'un Model
         */
        public static function updateModel($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
             
                if(isset($_GET['idModel'])){
                    $idModel = filter_input(INPUT_GET, 'idModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }

                $params['model'] = ModelManager::getModelById($idModel);

                $updated = 1;

                if (isset($_POST['formModel']) && !empty($_POST['formModel'])) {
                    $updated = 2;

                    if(isset($_POST['libelle']) && !empty($_POST['libelle'])){
                        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        
                        if (strlen($libelle) <= 40) {
                            ModelManager::updateModelById($idModel, $libelle);

                            $updated = 3;
                        }
                    }
                }

                if (isset($updated) && $updated == 3) {
                    $params['updated'] = $updated;
                    AdminController::listModel(array_splice($params, 0));
                }
                else if (isset($updated) && $updated == 2) {
                    $params['updated'] = $updated;
                    
                    require_once ROOT.'/view/admin/updateModel.php';
                }
                elseif ($updated == 1){
                    
                    require_once ROOT.'/view/admin/updateModel.php';
                }
             
            }
         
        }

        /**
         * Page d'ajout d'un nouveau Model
         */
        public static function addModel($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {

                $add = 1;
                
                if (isset($_POST['formModel']) && !empty($_POST['formModel'])) {
                    $add = 2;

                    if(isset($_POST['libelle']) && !empty($_POST['libelle'])){
                        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        
                        if (strlen($libelle) <= 40) {
                            $model = new Model;
                            $model->setLibelle($libelle);

                            ModelManager::AddModel($model);

                            $add = 3;
                        }
                    }
                }
             
                if (isset($add) && $add == 3) {
                    $params['add'] = $add;
                    AdminController::listModel(array_splice($params, 0));
                }
                else if (isset($add) && $add == 2) {
                    $params['add'] = $add;

                    $params['libelle'] = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    
                    require_once ROOT.'/view/admin/addModel.php';
                }
                elseif ($add == 1) {
                    
                    require_once ROOT.'/view/admin/addModel.php';
                }
             
            }
         
        }

        /* -- Model Fin -- */
        
        /* -- Marque Début -- */

        /**
         * List des Marques
         */
        public static function listMarque($params){   
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
                
                if(empty($_GET['numPage'])){
                    $numPage = 1;
                }else{
                    $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }
    
                $nbElementParPage = 10;
    
                $nbMarque = MarqueManager::getNbMarques();
    
                $params['nbPage'] = ceil($nbMarque / $nbElementParPage);
    
                $params['numPage'] = $numPage;
    
                $params['listMarques'] = MarqueManager::getLesMarquesByPagination($nbElementParPage, $numPage);
                
                require_once ROOT.'/view/admin/listMarque.php';
            }
            
        }

        /**
         * Page de mise à jour d'une Marque
         */
        public static function updateMarque($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
             
                if(isset($_GET['idMarque'])){
                    $idMarque = filter_input(INPUT_GET, 'idMarque', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }

                $params['marque'] = MarqueManager::getMarqueById($idMarque);

                $updated = 1;

                if (isset($_POST['formMarque']) && !empty($_POST['formMarque'])) {
                    $updated = 2;

                    if(isset($_POST['libelle']) && !empty($_POST['libelle'])){
                        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        
                        if (strlen($libelle) <= 40) {
                            MarqueManager::updateMarqueById($idMarque, $libelle);

                            $updated = 3;
                        }
                    }
                }

                if (isset($updated) && $updated == 3) {
                    $params['updated'] = $updated;
                    AdminController::listMarque(array_splice($params, 0));
                }
                else if (isset($updated) && $updated == 2) {
                    $params['updated'] = $updated;
                    
                    require_once ROOT.'/view/admin/updateMarque.php';
                }
                elseif ($updated == 1){
                    
                    require_once ROOT.'/view/admin/updateMarque.php';
                }
             
            }
         
        }

        /**
         * Page d'ajout d'une nouvel Marque
         */
        public static function addMarque($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {

                $add = 1;
                
                if (isset($_POST['formMarque']) && !empty($_POST['formMarque'])) {
                    $add = 2;

                    if(isset($_POST['libelle']) && !empty($_POST['libelle'])){
                        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        
                        if (strlen($libelle) <= 40) {
                            $marque = new Marque;
                            $marque->setLibelle($libelle);

                            MarqueManager::AddMarque($marque);

                            $add = 3;
                        }
                    }
                }
             
                if (isset($add) && $add == 3) {
                    $params['add'] = $add;
                    AdminController::listMarque(array_splice($params, 0));
                }
                else if (isset($add) && $add == 2) {
                    $params['add'] = $add;

                    $params['libelle'] = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    
                    require_once ROOT.'/view/admin/addMarque.php';
                }
                elseif ($add == 1) {
                    
                    require_once ROOT.'/view/admin/addMarque.php';
                }
             
            }
         
        }

        /* -- Marque Fin -- */
        
        /* -- Taille Début -- */

        /**
         * List des Tailles
         */
        public static function listTaille($params){   
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
                
                if(empty($_GET['numPage'])){
                    $numPage = 1;
                }else{
                    $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }
    
                $nbElementParPage = 10;
    
                $nbTaille = TailleManager::getNbTailles();
    
                $params['nbPage'] = ceil($nbTaille / $nbElementParPage);
    
                $params['numPage'] = $numPage;
    
                $params['listTailles'] = TailleManager::getLesTaillesByPagination($nbElementParPage, $numPage);
                
                require_once ROOT.'/view/admin/listTaille.php';
            }
            
        }

        /**
         * Page de mise à jour d'une Taille
         */
        public static function updateTaille($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
             
                if(isset($_GET['idTaille'])){
                    $idTaille = filter_input(INPUT_GET, 'idTaille', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }

                $params['taille'] = TailleManager::getTailleById($idTaille);

                $updated = 1;

                if (isset($_POST['formTaille']) && !empty($_POST['formTaille'])) {
                    $updated = 2;

                    if(isset($_POST['libelle']) && !empty($_POST['libelle'])){
                        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        
                        if (strlen($libelle) <= 40) {
                            TailleManager::updateTailleById($idTaille, $libelle);

                            $updated = 3;
                        }
                    }
                }

                if (isset($updated) && $updated == 3) {
                    $params['updated'] = $updated;
                    AdminController::listTaille(array_splice($params, 0));
                }
                else if (isset($updated) && $updated == 2) {
                    $params['updated'] = $updated;
                    
                    require_once ROOT.'/view/admin/updateTaille.php';
                }
                elseif ($updated == 1){
                    
                    require_once ROOT.'/view/admin/updateTaille.php';
                }
             
            }
         
        }

        /**
         * Page d'ajout d'une nouvel Taille
         */
        public static function addTaille($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {

                $add = 1;
                
                if (isset($_POST['formTaille']) && !empty($_POST['formTaille'])) {
                    $add = 2;

                    if(isset($_POST['libelle']) && !empty($_POST['libelle'])){
                        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        
                        if (strlen($libelle) <= 40) {
                            $taille = new Taille;
                            $taille->setLibelle($libelle);

                            TailleManager::AddTaille($taille);

                            $add = 3;
                        }
                    }
                }
             
                if (isset($add) && $add == 3) {
                    $params['add'] = $add;
                    AdminController::listTaille(array_splice($params, 0));
                }
                else if (isset($add) && $add == 2) {
                    $params['add'] = $add;

                    $params['libelle'] = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    
                    require_once ROOT.'/view/admin/addTaille.php';
                }
                elseif ($add == 1) {

                    require_once ROOT.'/view/admin/addTaille.php';
                }
             
            }
         
        }

        /* -- Taille Fin -- */
        
        /* -- TypeEcran Début -- */

        /**
         * List des TypeEcrans
         */
        public static function listTypeEcran($params){   
            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
                
                if(empty($_GET['numPage'])){
                    $numPage = 1;
                }else{
                    $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }
    
                $nbElementParPage = 10;
    
                $nbTypeEcran = TypeEcranManager::getNbTypeEcrans();
    
                $params['nbPage'] = ceil($nbTypeEcran / $nbElementParPage);
    
                $params['numPage'] = $numPage;

                $params['listTypeEcrans'] = TypeEcranManager::getLesTypeEcransByPagination($nbElementParPage, $numPage);
                
                require_once ROOT.'/view/admin/listTypeEcran.php';
            }
            
        }

        /**
         * Page de mise à jour d'un TypeEcran
         */
        public static function updateTypeEcran($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
             
                if(isset($_GET['idTypeEcran'])){
                    $idTypeEcran = filter_input(INPUT_GET, 'idTypeEcran', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }

                $params['typeEcran'] = TypeEcranManager::getTypeEcranById($idTypeEcran);

                $updated = 1;

                if (isset($_POST['formTypeEcran']) && !empty($_POST['formTypeEcran'])) {
                    $updated = 2;

                    if(isset($_POST['libelle']) && !empty($_POST['libelle'])){
                        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        
                        if (strlen($libelle) <= 40) {
                            TypeEcranManager::updateTypeEcranById($idTypeEcran, $libelle);

                            $updated = 3;
                        }
                    }
                }

                if (isset($updated) && $updated == 3) {
                    $params['updated'] = $updated;
                    AdminController::listTypeEcran(array_splice($params, 0));
                }
                else if (isset($updated) && $updated == 2) {
                    $params['updated'] = $updated;
                    
                    require_once ROOT.'/view/admin/updateTypeEcran.php';
                }
                elseif ($updated == 1){
                    
                    require_once ROOT.'/view/admin/updateTypeEcran.php';
                }
             
            }
         
        }

        /**
         * Page d'ajout d'un TypeEcran
         */
        public static function addTypeEcran($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {

                $add = 1;
                
                if (isset($_POST['formTypeEcran']) && !empty($_POST['formTypeEcran'])) {
                    $add = 2;

                    if(isset($_POST['libelle']) && !empty($_POST['libelle'])){
                        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                        
                        if (strlen($libelle) <= 40) {
                            $typeEcran = new TypeEcran;
                            $typeEcran->setLibelle($libelle);

                            TypeEcranManager::AddTypeEcran($typeEcran);

                            $add = 3;
                        }
                    }
                }
             
                if (isset($add) && $add == 3) {
                    $params['add'] = $add;
                    AdminController::listTypeEcran(array_splice($params, 0));
                }
                else if (isset($add) && $add == 2) {
                    $params['add'] = $add;

                    $params['libelle'] = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    
                    require_once ROOT.'/view/admin/addTypeEcran.php';
                }
                elseif ($add == 1) {
                    require_once ROOT.'/view/admin/addTypeEcran.php';
                }
             
            }
         
        }

        /* -- TypeEcran Fin -- */
    }

?>