<!DOCTYPE html>
<html>
    <head>
        <title>Admin-Produit</title>
        <meta charset="UTF-8">
        <base href="/projetBtsEcommerce/">
        
        <!-- CSS only -->
        <link rel="stylesheet" href="CSS/Admin/Index_CSS.css">
        <link rel="stylesheet" href="CSS/Admin/Header_Footer.css">
        <link rel="stylesheet" href="CSS/bootstrap-5.1.3-dist/css/bootstrap-grid.css">  <!-- à refaire sans Bootstrap -->
    </head>
    <body>
        <div id="all_admin_page">
            <?php
                if (isset($_GET['affichage']) && !empty($_GET['affichage'])) {
                    $affichage = nettoyer($_GET['affichage']);
                }
                else{
                    $affichage = "";
                }
                switch ($affichage) {
                    case 'client':
                        if (isset($_GET['modification'])) {
                            $modification = nettoyer($_GET['modification']);
                            if ($modification) {
                                echo"Modification effectuée";
                            }
                            else {
                                echo"Problème sur la modification effectuée";
                            }
                        }

                        if (isset($_POST['formClient'])) {
                            $idClient = nettoyer($_POST['idClient']);
                            $nomClient = nettoyer($_POST['nomClient']);
                            $prenomClient = nettoyer($_POST['prenomClient']);
                            $dateDeNaissanceClient = nettoyer($_POST['dateDeNaissanceClient']);
                            $numeroDeTelephoneClient = nettoyer($_POST['numeroDeTelephoneClient']);
                            $adresseClient = nettoyer($_POST['adresseClient']);
                            $villeClient = nettoyer($_POST['villeClient']);
                            $codePostalClient = nettoyer($_POST['codePostalClient']);
                            $emailClient = nettoyer($_POST['emailClient']);

                            Client::miseAJourClient($db, new Client($idClient, $nomClient, $prenomClient, $dateDeNaissanceClient, $numeroDeTelephoneClient, $adresseClient, $villeClient, $codePostalClient, $emailClient,"rien"));
                            header("Location: Index.php?affichage=client&modification=true");
                        }
                        if (isset($_GET['idClient'])) {
                            $idClient = nettoyer($_GET['idClient']);
                            $i = 0;
                            while ($i < count($lesClients)-1 && $lesClients[$i]->GetIdClient() != $idClient) {
                                $i++;
                            }
                            if ($lesClients[$i]->GetIdClient() == $idClient) {
                                $client = $lesClients[$i];
                                $idClient = $client->GetIdClient();
                                $nomClient = $client->GetNomClient();
                                $prenomClient = $client->GetPrenomClient();
                                $dateDeNaissanceClient = $client->GetDateDeNaissanceClient();
                                $numeroDeTelephoneClient = $client->GetNumeroDeTelephoneClient();
                                $adresseClient = $client->GetAdresseClient();
                                $villeClient = $client->GetVilleClient();
                                $codePostalClient = $client->GetCodePostalClient();
                                $emailClient = $client->GetEmailClient();
                                ?>
                                    <form id="idForm" action="Index.php?affichage=client" method="post">
                                        <div>
                                            <p>IdClient</p>
                                            <input type="text" name="idClient" value="<?php echo $idClient ?>">
                                        </div>
                                        <div>
                                            <p>NomClient</p>
                                            <input type="text" name="nomClient" value="<?php echo $nomClient ?>">
                                        </div>
                                        <div>
                                            <p>PrenomClient</p>
                                            <input type="text" name="prenomClient" value="<?php echo $prenomClient ?>">
                                        </div>
                                        <div>
                                            <p>DateDeNaissanceClient</p>
                                            <input type="text" name="dateDeNaissanceClient" value="<?php echo $dateDeNaissanceClient ?>">
                                        </div>
                                        <div>
                                            <p>Numero de telephone du client</p>
                                            <input type="text" name="numeroDeTelephoneClient" value="<?php echo $numeroDeTelephoneClient ?>">
                                        </div>
                                        <div>
                                            <p>AdresseClient</p>
                                            <input type="text" name="adresseClient" value="<?php echo $adresseClient ?>">
                                        </div>
                                        <div>
                                            <p>VilleClient</p>
                                            <input type="text" name="villeClient" value="<?php echo $villeClient ?>">
                                        </div>
                                        <div>
                                            <p>codePostalClient</p>
                                            <input type="text" name="codePostalClient" value="<?php echo $codePostalClient ?>">
                                        </div>
                                        <div>
                                            <p>emailClient</p>
                                            <input type="text" name="emailClient" value="<?php echo $emailClient ?>">
                                        </div>
                                        <input type="submit" name="formClient" value="Modifier">
                                    </form>
                                <?php
                            }
                        }
                        else {
                            foreach ($lesClients as $client) {
                                $idClient = $client->GetIdClient();
                                $numeroDeTelephoneClient = $client->GetNumeroDeTelephoneClient();
                                $emailClient = $client->GetEmailClient();
                                ?>
                                <form action="">
                                    <table>
                                        <tr>
                                            <th>id</th>
                                            <th>numero de telephone</th>
                                            <th>email</th>
                                            <th>modifier</th>
                                        </tr>
                                        <tr>
                                            <td><p><?php echo $idClient; ?></p></td>
                                            <td><p><?php echo $numeroDeTelephoneClient; ?></p></td>
                                            <td><p><?php echo $emailClient; ?></p></td>
                                            <td><a href="Index.php?affichage=client&idClient=<?php echo $idClient;?>"><input type="button" value="modifier" id="submit_bt"></a></td>
                                        </tr>
                                    </table>
                                </form>
                                <?php
                            }
                        }
                        break;
                    
                    case 'commande':
                        if (isset($_GET['modification'])) {
                            $modification = nettoyer($_GET['modification']);
                            if ($modification) {
                                echo"Modification effectuée";
                            }
                            else {
                                echo"Problème sur la modification effectuée";
                            }
                        }

                        if (isset($_POST['formCommande'])) {
                            $idCommande = nettoyer($_POST['idCommande']);
                            $modePaimentCommande = nettoyer($_POST['modePaimentCommande']);
                            $idClientCommande = nettoyer($_POST['idClientCommande']);
                            Commande::updateCommande($db, new Commande($idCommande, $modePaimentCommande, $idClientCommande));
                            header("Location: Index.php?affichage=commande&modification=true");
                        }
                        if (isset($_GET['idCommande'])) {
                            $idCommande = nettoyer($_GET['idCommande']);
                            $i = 0;
                            while ($i < count($lesCommandes)-1 && $lesCommandes[$i]->GetIdCommande() != $idCommande) {
                                $i++;
                            }
                            if ($lesCommandes[$i]->GetIdCommande() == $idCommande) {
                                $laCommande = $lesCommandes[$i];
                                $idCommande = $laCommande->GetIdCommande();
                                $modePaimentCommande = $laCommande->GetModePaiment();
                                $idClientCommande = $laCommande->GetIdClient();
                                ?>
                                    <form id="idForm" action="Index.php?affichage=commande" method="post">
                                        <div>
                                            <p>idCommande</p>
                                            <input type="text" name="idCommande" value="<?php echo $idCommande ?>">
                                        </div>
                                        <div>
                                            <p>modePaimentCommande</p>
                                            <input type="text" name="modePaimentCommande" value="<?php echo $modePaimentCommande ?>">
                                        </div>
                                        <div>
                                            <p>idClientCommande</p>
                                            <input type="text" name="idClientCommande" value="<?php echo $idClientCommande ?>">
                                        </div>
                                        <input type="submit" name="formCommande" value="Modifier">
                                    </form>
                                <?php
                            }
                        }
                        else {
                            foreach ($lesCommandes as $commande) {
                                $idCommande = $commande->GetIdCommande();
                                $modePaimentCommande = $commande->GetModePaiment();
                                $idClientCommande = $commande->GetIdClient();
                                ?>
                                <form action="">
                                    <table>
                                        <tr>
                                            <th>id</th>
                                            <th>mode de paiment</th>
                                            <th>id client</th>
                                            <th>modifier</th>
                                        </tr>
                                        <tr>
                                            <td><p><?php echo $idCommande; ?></p></td>
                                            <td><p><?php echo $modePaimentCommande; ?></p></td>
                                            <td><p><?php echo $idClientCommande; ?></p></td>
                                            <td><a href="Index.php?affichage=commande&idCommande=<?php echo $idCommande;?>"><input type="button" value="modifier" id="submit_bt"></a></td>
                                        </tr>
                                    </table>
                                </form>
                                <?php
                            }
                        }
                        break;
                    
                    case 'detailCommande':
                        if (isset($_GET['modification'])) {
                            $modification = nettoyer($_GET['modification']);
                            if ($modification) {
                                echo"Modification effectuée";
                            }
                            else {
                                echo"Problème sur la modification effectuée";
                            }
                        }

                        if (isset($_POST['formDetailCommande'])) {
                            $idProduit = nettoyer($_POST['idProduit']);
                            $refCommande = nettoyer($_POST['refCommande']);
                            $qte = nettoyer($_POST['qte']);

                            DetailCommande::updateDetailCommande($db, new DetailCommande($idProduit, $refCommande, $qte));
                            header("Location: Index.php?affichage=detailCommande&modification=true");
                        }
                        if (isset($_GET['idProduit']) && isset($_GET['idRefCommande'])) {
                            $idProduit = nettoyer($_GET['idProduit']);
                            $idRefCommande = nettoyer($_GET['idRefCommande']);
                            $i = 0;
                            while ($i < count($lesDetailCommandes)-1 && $lesDetailCommandes[$i]->GetIdProduit() != $idProduit && $lesDetailCommandes[$i]->GetRefCommande() != $idRefCommande) {
                                $i++;
                            }
                            if ($lesDetailCommandes[$i]->GetIdProduit() == $idProduit && $lesDetailCommandes[$i]->GetRefCommande() == $idRefCommande) {
                                $detailCommande = $lesDetailCommandes[$i];
                                $idProduit = $detailCommande->GetIdProduit();
                                $refCommande = $detailCommande->GetRefCommande();
                                $qte = $detailCommande->GetQte();
                                ?>
                                    <form id="idForm" action="Index.php?affichage=detailCommande" method="post">
                                        <div>
                                            <p>IdProduit</p>
                                            <input type="text" name="idProduit" value="<?php echo $idProduit ?>">
                                        </div>
                                        <div>
                                            <p>RefCommande</p>
                                            <input type="text" name="refCommande" value="<?php echo $refCommande ?>">
                                        </div>
                                        <div>
                                            <p>Qte</p>
                                            <input type="text" name="qte" value="<?php echo $qte ?>">
                                        </div>
                                        <input type="submit" name="formDetailCommande" value="Modifier">
                                    </form>
                                <?php
                            }
                        }
                        else {
                            foreach ($lesDetailCommandes as $detailCommande) {
                                $idProduit = $detailCommande->GetIdProduit();
                                $refCommande = $detailCommande->GetRefCommande();
                                $qte = $detailCommande->GetQte();
                                ?>
                                <form action="">
                                    <table>
                                        <tr>
                                            <th>id Produit</th>
                                            <th>reference commande</th>
                                            <th>qte</th>
                                            <th>modifier</th>
                                        </tr>
                                        <tr>
                                            <td><p><?php echo $idProduit; ?></p></td>
                                            <td><p><?php echo $refCommande; ?></p></td>
                                            <td><p><?php echo $qte; ?></p></td>
                                            <td><a href="Index.php?affichage=detailCommande&idProduit=<?php echo $idProduit; ?>&idRefCommande=<?php echo $refCommande; ?>"><input type="button" value="modifier" id="submit_bt"></a></td>
                                        </tr>
                                    </table>
                                </form>
                                <?php
                            }
                        }
                        break;
                    
                    
                    case 'produit':
                        if (isset($_POST['formModificationProduit'])) {
                            $idProduit = nettoyer($_POST['idProduit']);
                            $produitModel = nettoyer($_POST['modelProduit']);
                            $libelle = nettoyer($_POST['libelleProduit']);
                            $resume = nettoyer($_POST['resumeProduit']);
                            $description = nettoyer($_POST['descriptionProduit']);
                            $photoProduit = nettoyer($_POST['photoProduit']);
                            $qteEnStock = nettoyer($_POST['qteEnStockProduit']);
                            $prixVenteUHT = nettoyer($_POST['prixVenteUhtProduit']);
                            $numMarque = nettoyer($_POST['numMarqueProduit']);
                            $numTaille = nettoyer($_POST['numTailleProduit']);
                            $numType = nettoyer($_POST['numTypeProduit']);
                            Produit::updateProduit($db, new Produit($idProduit,$produitModel,$libelle,$resume,$description,$photoProduit,$qteEnStock,$prixVenteUHT,$numMarque,$numTaille,$numType));
                            header("Location: Index.php?affichage=produit&modification=true");
                        }
                        if (isset($_GET['modification'])) {
                            $modification = nettoyer($_GET['modification']);
                            if ($modification) {
                                echo"Modification effectuée";
                            }
                            else {
                                echo"Problème sur la modification effectuée";
                            }
                        }
                        if (isset($_GET['idModifier'])) {
                            $idModifier = nettoyer($_GET['idModifier']);
                            $i = 0;
                            while ($i < count($lesProduits)-1 && $lesProduits[$i]->GetIdProduit() != $idModifier) {
                                $i++;
                            }
                            if ($lesProduits[$i]->GetIdProduit() == $idModifier) {
                                $produit = $lesProduits[$i];
                                $idProduit = $produit->GetIdProduit();
                                $modelProduit = $produit->GetModelProduit();
                                $libelleProduit = $produit->GetLibelleProduit();
                                $resumeProduit = $produit->GetResumeProduit();
                                $descriptionProduit = $produit->GetDescriptionProduit();
                                $photoProduit = $produit->GetPhotoProduit();
                                $qteEnStockProduit = $produit->GetQteEnStockProduit();
                                $prixVenteUhtProduit = $produit->GetPrixVenteUhtProduit();
                                $numMarqueProduit = $produit->GetNumMarqueProduit();
                                $numTailleProduit = $produit->GetNumTailleProduit();
                                $numTypeProduit = $produit->GetNumTypeProduit();
                                ?>
                                    <form id="idForm" action="Index.php?affichage=produit" method="post">
                                        <div>
                                            <p>Id</p>
                                            <input type="text" name="idProduit" value="<?php echo $idProduit ?>">
                                        </div>
                                        <div>
                                            <p>Model de produit</p>
                                            <input type="text" name="modelProduit" value="<?php echo $modelProduit ?>">
                                        </div>
                                        <div>
                                            <p>Libelle produit</p>
                                            <input type="text" name="libelleProduit" value="<?php echo $libelleProduit ?>">
                                        </div>
                                        <div>
                                            <p>Resume produit</p>
                                            <input type="text" name="resumeProduit" value="<?php echo $resumeProduit ?>">
                                        </div>
                                        <div>
                                            <p>Description produit</p>
                                            <input type="text" name="descriptionProduit" value="<?php echo $descriptionProduit ?>">
                                        </div>
                                        <div>
                                            <p>Chemin de fichier de la photo du produit</p>
                                            <input type="text" name="photoProduit" value="<?php echo $photoProduit ?>">
                                        </div>
                                        <div>
                                            <p>Qte en stock produit</p>
                                            <input type="text" name="qteEnStockProduit" value="<?php echo $qteEnStockProduit ?>">
                                        </div>
                                        <div>
                                            <p>Prix de vente UHT du produit</p>
                                            <input type="text" name="prixVenteUhtProduit" value="<?php echo $prixVenteUhtProduit ?>">
                                        </div>
                                        <div>
                                            <p>Numémo de marque du produit</p>
                                            <input type="text" name="numMarqueProduit" value="<?php echo $numMarqueProduit ?>">
                                        </div>
                                        <div>
                                            <p>Numémo de taille du produit</p>
                                            <input type="text" name="numTailleProduit" value="<?php echo $numTailleProduit ?>">
                                        </div>
                                        <div>
                                            <p>Numémo de type du produit</p>
                                            <input type="text" name="numTypeProduit" value="<?php echo $numTypeProduit ?>">
                                        </div>
                                        <input type="submit" name="formModificationProduit" value="Modifier">
                                    </form>
                                <?php
                            }
                        }
                        else{
                            foreach ($lesProduits as $produit) {
                                $idProduit = $produit->GetIdProduit();
                                $modelProduit = $produit->GetModelProduit();
                                $prixVenteUhtProduit = $produit->GetPrixVenteUhtProduit();
                                ?>
                                    <form action="">
                                        <table>
                                            <tr>
                                                <th>id</th>
                                                <th>model</th>
                                                <th>prix UHT</th>
                                                <th>modifier</th>
                                            </tr>
                                            <tr>
                                                <td><p><?php echo $idProduit; ?></p></td>
                                                <td><p><?php echo $modelProduit; ?></p></td>
                                                <td><p><?php echo $prixVenteUhtProduit; ?></p></td>
                                                <td><a href="Index.php?affichage=produit&idModifier=<?php echo $idProduit; ?>"><input type="button" value="modifier" id="submit_bt"></a></td>
                                            </tr>
                                        </table>
                                    </form>
                                <?php
                            }
                        }
                        break;
                    
                    default:
                        echo "Bonjour bien venu sur le mode admin";
                        break;
                }
            ?>
        </div>
        <?php require_once('footer.php'); ?>
    </body>
</html>