<?php

/**
 * /controller/GestionCompteController.php
 * 
 * Contrôleur GestionCompteController
 *
 * @author B.Faure
 * @date 03/2023
 */

class GestionCompteController
{

    public static function authentification($params)
    {
        if (isset($_SESSION['id'])) {
            ProduitController::list(array_splice($params, 0));
        }
        else{
            if (isset($_POST['formConnexion'])) {
                $listeUsers = UserManager::getLesUsersByIdRole(RoleManager::getRoleByLibelle('Client')->getId());
    
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
                $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
    
                $erreur = "";
    
                if (!empty($email) && !empty($mdp)) {
                    $i = 0;
    
                    while ($i < count($listeUsers) - 1 && $listeUsers[$i]->GetEmail() != $email) {
                        $i++;
                    }
                    if ($listeUsers[$i]->GetEmail() == $email) {
                        if (password_verify($mdp, $listeUsers[$i]->GetMdp())) {
                            $_SESSION['id'] = $listeUsers[$i]->GetId();
                            $_SESSION['nom'] = $listeUsers[$i]->GetNom();
                            $_SESSION['prenom'] = $listeUsers[$i]->GetPrenom();
                            $_SESSION['role'] = $listeUsers[$i]->GetRole();
                            if ($listeUsers[$i]->GetRole()->GetLibelle() == "Admin") {
                                $_SESSION['isAdmin'] = true;
                            }
                            else {
                                $_SESSION['isAdmin'] = false;
                                $_SESSION['panier'] = array();
                            }
                            $erreur = "ok";
                        } else {
                            $erreur = "Mots de passe ou Email incorrect !";
                        }
                    } else {
                        $erreur = "Mots de passe ou Email incorrect !";
                    }
                } else {
                    $erreur = "Tous les champs doivent être complétés !";
                }
                if ($erreur == "ok") {
                    $vueAAppeller = "/view/gestionCompte/connexion.php";
                }
                else {
                    $params['erreur'] = $erreur;
                    $vueAAppeller = "/view/gestionCompte/connexion.php";
                }
            }
    
            if (!empty($erreur) && $erreur == "ok") {
                ProduitController::list(array_splice($params, 0));
            }
            else {
                // appelle la vue
                require_once ROOT . '/view/gestionCompte/connexion.php';
            }
        }
    }

    public static function inscription($params)
    {
        if (isset($_POST['formInscription'])) {
            $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            $dateDeNaissance = filter_input(INPUT_POST, 'dateDeNaissance', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            $numeroDeTelephone = filter_input(INPUT_POST, 'numeroDeTelephone', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            $adresse = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            $cp = filter_input(INPUT_POST, 'cp', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            $emailComfirmation = filter_input(INPUT_POST, 'emailComfirmation', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            $mdpComfirmation = filter_input(INPUT_POST, 'mdpComfirmation', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            
            $params['nomInscription'] = $nom;
            $params['prenomInscription'] = $prenom;
            $params['dateDeNaissanceInscription'] = $dateDeNaissance;
            $params['numeroDeTelephoneInscription'] = $numeroDeTelephone;
            $params['adresseInscription'] = $adresse;
            $params['villeInscription'] = $ville;
            $params['cpInscription'] = $cp;
            $params['emailInscription'] = $email;
            $params['emailComfirmationInscription'] = $emailComfirmation;
            
            if (!empty($nom) && !empty($prenom) && !empty($dateDeNaissance) && !empty($numeroDeTelephone) && !empty($adresse) && !empty($ville) && !empty($cp) && !empty($email) && !empty($emailComfirmation) && !empty($mdp) && !empty($mdpComfirmation)) {
                if (strlen($nom) < 40) {
                    if (strlen($prenom) < 40) {
                        $date = DateTime::createFromFormat('Y-m-d', $dateDeNaissance);
                        $today = new DateTime();

                        if ($date < $today) {
                            if (strlen($numeroDeTelephone) == 10 && ctype_digit($numeroDeTelephone)) {
                                if (strlen($adresse) < 50) {
                                    if (strlen($ville) < 50) {
                                        if (strlen($cp) == 5 && ctype_digit($cp)) {
                                            if ($email == $emailComfirmation) {
                                                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                                    $listeEmailsUsers = UserManager::getLesEmailsUsersByIdRole(RoleManager::getRoleByLibelle('Client')->getId());
                                                    if (in_array($email, $listeEmailsUsers) == false) {
                                                        if (UtilitaireController::check_password($mdp)) {
                                                            $mot_de_passe_hache = password_hash($mdp, PASSWORD_DEFAULT);
                                                            if (password_verify($mdpComfirmation, $mot_de_passe_hache)) {
                                                                
                                                                UserManager::addUser($nom, $prenom, $dateDeNaissance, $numeroDeTelephone, $adresse, $ville, $cp, $email, $mot_de_passe_hache, RoleManager::getRoleByLibelle('Client')->getId());
                                                                $params['erreur'] = "bon";
                                                                
                                                                $newUser = UserManager::getUserByAdresseMail($email);

                                                                $_SESSION['id'] = $newUser->GetId();
                                                                $_SESSION['nom'] = $newUser->GetNom();
                                                                $_SESSION['prenom'] = $newUser->GetPrenom();
                                                                $_SESSION['role'] = $newUser->GetRole();
                                                                $_SESSION['panier'] = array();

                                                                ProduitController::list(array_splice($params, 0));
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
                                            else {
                                                $params['erreur'] = "Votre adresse email et votre adresse email de confirmation ne sont pas les mêmes !";
                                            }
                                        }
                                        else {
                                            $params['erreur'] = "Code postal incorrecte, ne peut pas faire plus Sou moins de 5 caractères !";
                                        }
                                    }
                                    else {
                                        $params['erreur'] = "La ville ne peut pas faire plus de 50 caractères !";
                                    }
                                }
                                else {
                                    $params['erreur'] = "L'adresse ne peut pas faire plus de 50 caractères !";
                                }
                            }
                            else {
                                $params['erreur'] = "Le numéro de téléphone n'est pas correct !";
                            }
                        }
                        else {
                            $params['erreur'] = "La date de naissance donnée est supérieure à la date d'aujourd'hui !";
                        }
                    }
                    else {
                        $params['erreur'] = "Le prenom ne peut pas faire plus de 40 caractères !";
                    }
                }
                else {
                    $params['erreur'] = "Le nom ne peut pas faire plus de 40 caractères !";
                }
            }
            else {
                $params['erreur'] = "Tous les champs doivent être complétés !";
            }
        }
        // appelle la vue
        require_once ROOT . '/view/gestionCompte/inscription.php';
    }

    public static function compte($params){

        if (isset($_SESSION['id'])) {
            $listeUsers = UserManager::getLesUsersByIdRole(RoleManager::getRoleByLibelle('Client')->getId());
            
            $i = 0;
            while ($i < count($listeUsers) - 1 && $listeUsers[$i]->GetId() != $_SESSION['id']) {
                $i++;
            }
            if ($listeUsers[$i]->GetId() == $_SESSION['id']) {
                $params['user'] = $listeUsers[$i];
                // appelle la vue
                require_once ROOT . '/view/gestionCompte/compte.php';
            }
            
            if (isset($_POST['formUpdateCompte'])) {
                UserManager::updateUser($_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_SESSION['id']);

                header('Location: '.$_SERVER['REQUEST_URI']);
                exit();
            }
        }
        else{
            ProduitController::list(array_splice($params, 0));
        }
    }

    public static function deconnexion($params){
        $_SESSION = array();
        session_destroy();
        ProduitController::list(array_splice($params, 0));
    }

    public static function historique($params){

        if (isset($_SESSION['id'])) {

            if(empty($_GET['numPage'])){
                $numPage = 1;
            }else{
                $numPage = filter_input(INPUT_GET, 'numPage', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
            }

            $nbElementParPage = 4;

            $nbCommande = CommandeManager::getNbCommandesByIdUser($_SESSION['id']);

            $params['nbPage'] = ceil($nbCommande / $nbElementParPage);

            $params['numPage'] = $numPage;

            $params['listeCommande'] = CommandeManager::getLesCommandesByIdUser($_SESSION['id'],$nbElementParPage,$numPage);
            
            require_once ROOT . '/view/gestionCompte/historique.php';

        }
        else{
            ProduitController::list(array_splice($params, 0));
        }
    }
}

?>