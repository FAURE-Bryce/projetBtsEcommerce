<?php

/**
 * /view/produit/compte.php
 * 
 * Affiche le compte de l'user connecté 
 *
 * @author B.FAURE
 * @date 02/2023
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte</title>
    <base href="/projetBtsEcommerce/">
        
    <!-- CSS only -->
    <link rel="stylesheet" href="CSS/GestionCompte.css">
    <link rel="stylesheet" href="CSS/Header_Footer.css">
    <link rel="stylesheet" href="CSS/bootstrap-5.1.3-dist/css/bootstrap-grid.css">  <!-- à refaire sans Bootstrap -->
</head>
<body>
    
    <?php NavBarreController::readAll($params); ?>

    <div id="all_mon_compte">
        <!-- Selection d'inscription ou de connexion -->
        <?php
            echo "<p id='bonjourClient'>Bonjour ".$_SESSION['prenom']." ".$_SESSION['nom'];            
        ?>
        <div id="divInfoModif">
            <h4>Info et modification de compte</h4>
            <?php
                if (isset($params['updated']) == "isOk") {
                    echo "Mise à jour de compte fait.";
                }
            ?>
            <form action="" method="post">
                <div>
                    <p>Nom : </p>
                    <input type="text" name = "nom" id = "nom" value =<?php echo $params['user']->GetNom(); ?>>
                </div>

                <div>
                    <p>Prenom : </p>
                    <input type="text" name ="prenom" id ="prenom" value =<?php echo $params['user']->GetPrenom(); ?>>
                </div>

                <div>
                    <p>Adresse : </p>
                    <input type="text" name ="adresse" id ="adresse" value =<?php echo $params['user']->GetAdresse(); ?>>
                </div>

                <div>
                    <p>Ville : </p>
                    <input type="text" name ="ville" id ="ville" value =<?php echo $params['user']->GetVille(); ?>>
                </div>

                <div> 
                    <p>Code Postal : </p>
                    <input type="number" name ="cp" id ="cp" value =<?php echo $params['user']->GetCodePostal(); ?>>
                </div>
                <input type="submit" value = "Valider" name="formUpdateCompte" id="submit">
            </form>
        </div>
        <div id="divlien">
            <a href="gestionCompte/deconnexion/">Déconnexion</a>
            <a href="gestionCompte/historique/">Voir mon historique de commande</a>
        </div>
    </div>  
    <?php FooterController::readAll($params); ?>
</body>
</html>
