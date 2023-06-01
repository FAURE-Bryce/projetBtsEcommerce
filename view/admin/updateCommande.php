<!DOCTYPE html>
<html>
    <head>
        <title>Admin-Detail-Commande</title>
        <meta charset="UTF-8">
        <base href="/projetBtsEcommerce/">
        
        <!-- CSS only -->
        <link rel="stylesheet" href="CSS/Admin/Index_CSS.css">
        <link rel="stylesheet" href="CSS/Admin/Header_Footer.css">
        <link rel="stylesheet" href="CSS/bootstrap-5.1.3-dist/css/bootstrap-grid.css">
    </head>
    <body>
        <?php NavBarreController::readAdminAll($params); ?>
        <div id="all_admin_page">
            <?php 
                if (isset($params['updated']) && $params['updated'] == 2) {
                    echo '<div id="erreur">';
                    echo '<p>Un problème est survenu pendant l\'update</p>';
                    echo '</div>';
                }

                echo '<form id="idForm" action="admin/updateCommande/'.$params['commande']->getId().'/" method="post">'; 
            ?>
                <div>
                    <p id="id">Id : <?php echo $params['commande']->getId(); ?></p>
                </div>
                <div>
                    <p>Mode de Paiement de la commande :</p>
                    
                    <select name="idModePaiement" id="idModePaiement">
                    <?php
                        foreach ($params['listeModePaiement'] as $modePaiement) {
                            if ($modePaiement->getId() == $params['commande']->getModePaiement()->getId()) {
                                echo '<option value="'.$modePaiement->getId().'" selected>'.$modePaiement->getLibelle().'</option>';
                            }
                            else{
                                echo '<option value="'.$modePaiement->getId().'">'.$modePaiement->getLibelle().'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <p>IdClient de la commande :</p>
                    
                    <select name="idUser" id="idUser">
                    <?php
                        foreach ($params['listeUserClient'] as $client) {
                            if ($client->getId() == $params['commande']->getUser()->getId()) {
                                echo '<option value="'.$client->getId().'" selected>'.$client->getId().'</option>';
                            }
                            else{
                                echo '<option value="'.$client->getId().'">'.$client->getId().'</option>';
                            }
                        }
                    ?>
                    </select>
                </div>
                <div>
                    <input id="btSubmit" type="submit" name="formCommande" value="Modifier">
                </div>
            </form>
            <div id="detailcommande">
                <h2>Detail de la commande :</h2>
                <?php
                    foreach (DetailCommandeManager::getLesDetailCommandesByIdCommande($params['commande']->getId()) as $unDetailCommande) {

                    $produit = $unDetailCommande->GetProduit();
                    echo '<div class = "produit">';
                        echo '<img src="'.$produit->GetPathPhoto().'" alt="TV '.$produit->GetLibelle().'" class="logo">';
                        echo '<div class="model_libelle">';
                        echo '<h3>'.$produit->GetLibelle().'</h3>';
                        echo '<p>'.$produit->GetModel()->GetLibelle().'</p>';
                        echo '</div>';
                        echo '<div class="prix_qte">';
                        echo '<p> à l\'unité '.$produit->GetPrixVenteUht(). ' €</p>';
                        echo '<p>Qte : '.$unDetailCommande->GetQte().'</p>';
                        echo '</div>';
                        echo '<a href="admin/updateDetailCommande/'.$unDetailCommande->getIdProduit().'/'.$unDetailCommande->getIdCommande().'/"><input type="button" value="modifier"></a>';
                    echo '</div>';
                    }
                ?>
            </div>
        </div>
        <?php FooterController::readAll($params); ?>
    </body>
</html>