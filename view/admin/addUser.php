<!DOCTYPE html>
<html>
    <head>
        <title>Admin-Detail-User</title>
        <meta charset="UTF-8">
        <base href="/projetBtsEcommerce/">
        
        <!-- CSS only -->
        <link rel="stylesheet" href="CSS/Admin/Index_CSS.css">
        <link rel="stylesheet" href="CSS/Admin/Header_Footer.css">
        <link rel="stylesheet" href="CSS/bootstrap-5.1.3-dist/css/bootstrap-grid.css">  <!-- à refaire sans Bootstrap -->
    </head>
    <body>
        <?php NavBarreController::readAdminAll($params); ?>
        <div id="all_admin_page">
            <?php
                if (isset($params['add']) && !empty($params['add']) && $params['add'] == 2) {
                    echo '<div id="erreur">';
                    echo '<p>Un problème est survenu pendant la création de l\'utilisateur</p>';
                    echo '</div>';
                }
            ?>
            <form id="idForm" action="admin/addUser/" method="post">
                <div>
                    <p>Nom client : </p>
                    <input type="text" name="nom" <?php if (isset($params['nom']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['nom'].'"';}?>>
                </div>
                <div>
                    <p>Prenom client : </p>
                    <input type="text" name="prenom" <?php if (isset($params['prenom']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['prenom'].'"';}?>>
                </div>
                <div>
                    <p>DateDeNaissance client : </p>
                    <input type="date" name="dateDeNaissance" <?php if (isset($params['dateDeNaissance']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['dateDeNaissance'].'"';}?>>
                </div>
                <div>
                    <p>Numero de telephone du client : </p>
                    <input type="text" name="numeroTelephone" <?php if (isset($params['numeroTelephone']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['numeroTelephone'].'"';}?>>
                </div>
                <div>
                    <p>Adresse client : </p>
                    <input type="text" name="adresse" <?php if (isset($params['adresse']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['adresse'].'"';}?>>
                </div>
                <div>
                    <p>Ville client : </p>
                    <input type="text" name="ville" <?php if (isset($params['ville']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['ville'].'"';}?>>
                </div>
                <div>
                    <p>CodePostal client : </p>
                    <input type="text" name="codePostal" <?php if (isset($params['codePostal']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['codePostal'].'"';}?>>
                </div>
                <div>
                    <p>Email client : </p>
                    <input type="mail" name="email" <?php if (isset($params['email']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['email'].'"';}?>>
                </div>
                <div>
                    <p>Email confirmation client : </p>
                    <input type="mail" name="emailConfirmation" <?php if (isset($params['emailConfirmation']) && isset($params['add']) && $params['add'] == 2) {echo 'value ="'.$params['emailConfirmation'].'"';}?>>
                </div>
                <div>
                    <p>Mot de passe client : </p>
                    <input type="password" name="mdp">
                </div>
                <div>
                    <p>Mot de passe confirmation client : </p>
                    <input type="password" name="mdpConfirmation">
                </div>
                <div>
                    <p>Role client : </p>
                    <select name="idRole" id="idRole">
                    <?php
                        if (isset($params['idRole']) && isset($params['add']) && $params['add'] == 2) {
                            foreach ($params['listeRole'] as $role) {
                                if ($role->getId() == $params['idRole']) {
                                    echo '<option value="'.$role->getId().'" selected>'.$role->getLibelle().'</option>';
                                }
                                else{
                                    echo '<option value="'.$role->getId().'">'.$role->getLibelle().'</option>';
                                }
                            }
                        }
                        else {
                            foreach ($params['listeRole'] as $role) {
                                echo '<option value="'.$role->getId().'">'.$role->getLibelle().'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <input id="btSubmit" type="submit" name="formUser" value="Modifier">
                </div>
            </form>
        </div>
        <?php FooterController::readAll($params); ?>
    </body>
</html>