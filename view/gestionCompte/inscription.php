<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Inscription</title>
    <meta charset="UTF-8">
    <base href="/Projet%20Web%20FAURE%20Bryce/">

    <!-- CSS only -->
    <link rel="stylesheet" href="CSS/bootstrap-5.1.3-dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="CSS/Header_Footer.css">
    <link rel="stylesheet" href="CSS/GestionCompte.css">
</head>
<body>
    <?php NavBarreController::readAll($params); ?>
    <div id = "div_all_Compte">
        <div id="all_inscription">
            <h1>Inscription</h1>
            <form action="" method="post">
                <div id = "div_form">
                    <div class="sous_div_form">
                        <div>
                            <p>Nom : </p>
                            <input type="text" name = "nom" id = "nom" value =<?php if(isset($params['nomInscription']) && isset($params['erreur']) && $params['erreur'] != "bon") { echo $params['nomInscription']; } ?>>
                        </div>
                        <div>
                            <p>Prenom : </p>
                            <input type="text" name ="prenom" id ="prenom" value =<?php if(isset($params['prenomInscription']) && isset($params['erreur']) && $params['erreur'] != "bon") { echo $params['prenomInscription']; } ?>>
                        </div>
                        <div>
                            <p>Date de Naissance : </p>
                            <input type="date" name ="dateDeNaissance" id ="dateDeNaissance" value =<?php if(isset($params['dateDeNaissanceInscription']) && isset($params['erreur']) && $params['erreur'] != "bon") { echo $params['dateDeNaissanceInscription']; } ?>>
                        </div>
                        <div>
                            <p>Numéro de téléphone : </p>
                            <input type="number" name ="numeroDeTelephone" id ="numeroDeTelephone" value =<?php if(isset($params['numeroDeTelephoneInscription']) && isset($params['erreur']) && $params['erreur'] != "bon") { echo $params['numeroDeTelephoneInscription']; } ?>>
                        </div>
                        <div>
                            <p>Adresse : </p>
                            <input type="text" name ="adresse" id ="adresse" value =<?php if(isset($params['adresseInscription']) && isset($params['erreur']) && $params['erreur'] != "bon") { echo $params['adresseInscription']; } ?>>
                        </div>
                        <div>
                            <p>Ville : </p>
                            <input type="text" name ="ville" id ="ville" value =<?php if(isset($params['villeInscription']) && isset($params['erreur']) && $params['erreur'] != "bon") { echo $params['villeInscription']; } ?>>
                        </div>
                        <div> 
                            <p>Code Postal : </p>
                            <input type="number" name ="cp" id ="cp" value =<?php if(isset($params['cpInscription']) && isset($params['erreur']) && $params['erreur'] != "bon") { echo $params['cpInscription']; } ?>>
                        </div>
                    </div>
                    <div class="sous_div_form">
                        <div>
                            <p>Email : </p>
                            <input type="email" name ="email" id ="email" value =<?php if(isset($params['emailInscription']) && isset($params['erreur']) && $params['erreur'] != "bon") { echo $params['emailInscription']; } ?>>
                        </div>

                        <div>
                            <p>Confirmer votre Email : </p>
                            <input type="email" name ="emailComfirmation" id ="emailComfirmation" value =<?php if(isset($params['emailComfirmationInscription']) && isset($params['erreur']) && $params['erreur'] != "bon") { echo $params['emailComfirmationInscription']; } ?>>
                        </div>
                        <div>
                            <p>Mot de passe : </p>
                            <input type="password" name ="mdp" id ="mdp">
                        </div>
                        <div>
                            <p>Confirmer votre Mot de passe : </p>
                            <input type="password" name ="mdpComfirmation" id ="mdpComfirmation">
                        </div>
                    </div>
                </div>
                <?php
                    if (isset($params['erreur']) && $params['erreur'] != "bon") {
                        echo '<p id="erreur_ins">'.$params['erreur'].'</p>';
                    }
                ?>

                <a href="gestionCompte/authentification/">J'ai déjà un compte</a>
                <input type="submit" value="Soumettre l'inscription" name="formInscription" id="button_inscription">
            </form>
        </div>
    </div>
    <?php FooterController::readAll($params); ?>
</body>
</html>