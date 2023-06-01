<!DOCTYPE html>
<html>
    <head>
        <title>Admin-Commande</title>
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
                if (isset($params['updated']) && !empty($params['updated']) && $params['updated'] == true) {
                    echo '<div id="commandeOk">';
                    echo '<p>Modification effectuée</p>';
                    echo '</div>';
                }

                foreach ($params['listCommandes'] as $commande) {
                    ?>
                        <form action="" method="GET">
                            <table>
                                <tr>
                                    <th>id</th>
                                    <th>mode de paiment</th>
                                    <th>id client</th>
                                    <th>modifier</th>
                                </tr>
                                <tr>
                                    <td><p><?php echo $commande->getId(); ?></p></td>
                                    <td><p><?php echo $commande->getModePaiement()->getLibelle(); ?></p></td>
                                    <td><p><?php echo $commande->GetIdUser(); ?></p></td>
                                    <td><a href="admin/updateCommande/<?php echo $commande->getId(); ?>/"><input type="button" value="modifier" id="submit_bt"></a></td>
                                </tr>
                            </table>
                        </form>
                    <?php
                }
            ?>
            <?php
                $nbPage = $params['nbPage'];

                $numPage = $params['numPage'];

                if ($nbPage != 1) {
                    $lienpagination = '<a href="admin/listCommande/';

                    echo '<div id="paginationCadre">';
                    echo '<div class="pagination">';

                    if ($numPage-1 == 0) {
                        echo '<p><</p>';
                    }
                    else{
                        echo $lienpagination.($numPage-1).'/"><</a>';
                    }

                    if (1 < ($numPage-1)) {
                        echo $lienpagination.'1/">1</a>';
                        echo '<p>...</p>';
                        // echo $lienpagination.($numPage-1).'/">'.($numPage-1).'</a>';
                    }
                    elseif (1 >= ($numPage-2)) {
                        for ($i=1; ($numPage - $i) == 1; $i++) { 
                            echo $lienpagination.($numPage-$i).'/">'.($numPage-$i).'</a>';
                        }
                    }

                    echo '<p class="pageActuel">'.$numPage.'</p>';

                    if ($nbPage > ($numPage+1)) {
                        // echo $lienpagination.($numPage+1).'/">'.($numPage+1).'</a>';
                        echo '<p>...</p>';
                        echo $lienpagination.$nbPage.'/">'.$nbPage.'</a>';
                    }
                    elseif ($nbPage <= ($numPage+2)) {
                        for ($i=1; ($numPage+$i) == $nbPage; $i++) { 
                            echo $lienpagination.($numPage+$i).'/">'.($numPage+$i).'</a>';
                        }
                    }

                    if ($numPage+1 > $nbPage) {
                        echo '<p>></p>';
                    }
                    else{
                        echo $lienpagination.($numPage+1).'/">></a>';
                    }

                    echo '</div>';
                    echo '</div>';
                } 
            ?>
        </div>
        <?php FooterController::readAll($params); ?>
    </body>
</html>