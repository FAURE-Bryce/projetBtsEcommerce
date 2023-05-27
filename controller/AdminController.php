<?php

/**
 * /controller/TypeEcranController.php
 * 
 * Contrôleur pour l'entité TypeEcran
 *
 * @author B.Faure
 * @date 03/2023
 */
                    /* affichafge a faire user, commande, produit */
    class AdminController {

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
    
                /**
                * récupère les produits de la bdd
                */
                $params['listProduits'] = ProduitManager::getLesProduitsByPagination($nbElementParPage, $numPage);
    
                // appelle la vue
                require_once ROOT.'/view/admin/listProduit.php';
            }
            
        }

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

                if(isset($_POST['formModification']) && !empty($_POST['formModification']) && isset($_POST['idModel']) && !empty($_POST['idModel']) && isset($_POST['libelle']) && !empty($_POST['libelle']) && isset($_POST['resume']) && !empty($_POST['resume']) && isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['patchPhoto']) && !empty($_POST['patchPhoto']) && isset($_POST['qteEnStock']) && !empty($_POST['qteEnStock']) && isset($_POST['prixVenteUht']) && !empty($_POST['prixVenteUht']) && isset($_POST['idMarque']) && !empty($_POST['idMarque']) && isset($_POST['idTaille']) && !empty($_POST['idTaille']) && isset($_POST['idType']) && !empty($_POST['idType'])){
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
                    $updated = true;
                }

                if (isset($updated) && $updated == true) {
                    $params['updated'] = $updated;
                    AdminController::listProduit(array_splice($params, 0));
                }
                else {
                    // appelle la vue
                    require_once ROOT.'/view/admin/updateProduit.php';
                }
                
            }
            
        }

        public static function addProduit($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {

                $params['listeModel'] = ModelManager::getLesModels();
                $params['listeMarque'] = MarqueManager::getLesMarques();
                $params['listeType'] = TypeEcranManager::getLesTypesEcrans();
                $params['listeTaille'] = TailleManager::getLesTailles();

                if(isset($_POST['formAdd']) && !empty($_POST['formAdd']) && isset($_POST['idModel']) && !empty($_POST['idModel']) && isset($_POST['libelle']) && !empty($_POST['libelle']) && isset($_POST['resume']) && !empty($_POST['resume']) && isset($_POST['description']) && !empty($_POST['description']) && isset($_POST['patchPhoto']) && !empty($_POST['patchPhoto']) && isset($_POST['qteEnStock']) && !empty($_POST['qteEnStock']) && isset($_POST['prixVenteUht']) && !empty($_POST['prixVenteUht']) && isset($_POST['idMarque']) && !empty($_POST['idMarque']) && isset($_POST['idTaille']) && !empty($_POST['idTaille']) && isset($_POST['idType']) && !empty($_POST['idType'])){
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
                    $add = true;
                }
                

                if (isset($add) && $add == true) {
                    $params['add'] = $add;
                    
                    AdminController::listProduit(array_splice($params, 0));
                }
                else {
                    // appelle la vue
                    require_once ROOT.'/view/admin/addProduit.php';
                }
                
            }
            
        }

        /* User */

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
    
                /**
                * récupère les produits de la bdd
                */
                $params['listUsers'] = UserManager::getLesUsersByPagination($nbElementParPage, $numPage);
    
                // appelle la vue
                require_once ROOT.'/view/admin/listUser.php';
            }
            
        }

        public static function updateUser($params){

            if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] = true) {
             
                if(isset($_GET['idUser'])){
                    $idUser = filter_input(INPUT_GET, 'idUser', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                }

                $params['user'] = UserManager::getUserById($idUser);
                $params['listeRole'] = RoleManager::getLesRoles();

                if(isset($_POST['formUser']) && !empty($_POST['formUser']) && isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prenom']) && !empty($_POST['prenom']) && isset($_POST['dateDeNaissance']) && !empty($_POST['dateDeNaissance']) && isset($_POST['numeroTelephone']) && !empty($_POST['numeroTelephone']) && isset($_POST['adresse']) && !empty($_POST['adresse']) && isset($_POST['ville']) && !empty($_POST['ville']) && isset($_POST['codePostal']) && !empty($_POST['codePostal']) && isset($_POST['idRole']) && !empty($_POST['idRole'])){
                    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $dateDeNaissance = filter_input(INPUT_POST, 'dateDeNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $numeroTelephone = filter_input(INPUT_POST, 'numeroTelephone', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $adresse = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $codePostal = filter_input(INPUT_POST, 'codePostal', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    $idRole = filter_input(INPUT_POST, 'idRole', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                    
                    $updated = false;

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
                                                    $updated = true;        
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if (isset($updated) && $updated == true) {
                    $params['updated'] = $updated;
                    AdminController::listUser(array_splice($params, 0));
                }
                else if (isset($updated) && $updated == false) {
                    $params['updated'] = $updated;
                    // appelle la vue
                    require_once ROOT.'/view/admin/updateUser.php';
                }
                else {
                    // appelle la vue
                    require_once ROOT.'/view/admin/updateUser.php';
                }
             
            }
         
        }

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
                                                        if ($email == $emailComfirmation) {
                                                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                                                $listeEmailsUsers = UserManager::getLesEmailsUsersByIdRole(RoleManager::getRoleByLibelle('Client')->getId());
                                                                if (in_array($email, $listeEmailsUsers) == false) {
                                                                    if (UtilitaireController::check_password($mdp)) {
                                                                        $mot_de_passe_hache = password_hash($mdp, PASSWORD_DEFAULT);
                                                                        if (password_verify($mdpComfirmation, $mot_de_passe_hache)) {
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
                                                                            $user->setMdp($mdp);

                                                                            UserManager::addUserWithObjet($user);
                                                                            $add = 3; 

                                                                        } else {
                                                                            $params['erreur'] = "Vos mots de passes ne correspondent pas !";
                                                                        }
                                                                    }
                                                                    else {
                                                                        $params['erreur'] = "Le mot de passe n'est pas valide, le mot de passe doit contenir une majuscule, une minuscule, un chiffre, un caractère spécial et au moins 12 caractères";
                                                                    }
                                                                }
                                                                else {
                                                                    $params['erreur'] = "Adresse email déjà utilisée !";
                                                                }
                                                            }
                                                            else {
                                                                $params['erreur'] = "Votre adresse email n'est pas valide !";
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

                    // appelle la vue
                    require_once ROOT.'/view/admin/addUser.php';
                }
                elseif ($add == 1) {
                    // appelle la vue
                    require_once ROOT.'/view/admin/addUser.php';
                }
             
            }
         
        }
    }

?>