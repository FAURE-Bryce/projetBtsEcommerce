<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
    <meta charset="UTF-8">
    <base href="/projetBtsEcommerce/">

    <!-- CSS only -->
    <link rel="stylesheet" href="CSS/bootstrap-5.1.3-dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="CSS/Header_Footer.css">
    <link rel="stylesheet" href="CSS/GestionCompte.css">
</head>
<body>
    <?php NavBarreController::readAll($params); ?>
    <!-- Selection de connexion -->
    <div id = "div_all_Compte">
        <div id="all_connexion">
            <h1>Connexion</h1>
            <form action="" method="post">
                <div>
                    <p>Email : </p>
                    <input type="email" name="email">
                </div>

                <div>
                    <p>Mot de passe : </p>
                    <input type="password" name="mdp">
                </div>
                <input type="submit" name="formConnexion" id="bt_connexion" value="Continuer">
            </form>
            <p><a href="gestionCompte/inscription/">Créer votre compte ici.</a></p>
            <?php
                if (isset($params['erreur'])) {
                    echo '<p id="erreur_mdp">'.$params['erreur'].'</p>';
                }
            ?>
        </div>
    </div>
    <?php FooterController::readAll($params); ?>
</body>
</html>