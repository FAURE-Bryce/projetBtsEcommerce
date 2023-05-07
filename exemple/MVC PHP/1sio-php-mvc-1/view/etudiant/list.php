<?php

/**
 * /view/etudiant/list.php
 * 
 * Affiche la table des étudiants
 *
 * @author 1sio-slam
 * @date 05/2021
 */

?>
<!DOCTYPE html>
<html>
    <head>
        <title>1sio-jquery</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Font awesome -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
        
    </head>
    <body class="container">

        <div id="content">

            <h1 class="text-primary">Architecture MVC (1)</h1>
        
            <h1 class="text-primary">Liste des étudiants par section</h1>
            
            <!-------------------------------------->
            <!-- Formulaire de filtre par section -->
            <!-------------------------------------->
            <?php
                $form = '<form method="GET" action="#">';
                if($filtre == 'tous')
                {
                    $form .= '<label for="section" class="radio-inline control-label col-1"><input type="radio" id="tous" name="filtre_section" value="tous" checked>
                Tous</label>';
                }else{
                    $form .= '<label for="section" class="radio-inline control-label col-1"><input type="radio" id="tous" name="filtre_section" value="tous">
                Tous</label>';
                }
                if($filtre == 'sisr')
                {
                    $form .= '<label for="section" class="radio-inline control-label col-1"><input type="radio" id="sisr" name="filtre_section" value="sisr" checked>
                SISR</label>';
                }else{
                    $form .= '<label for="section" class="radio-inline control-label col-1"><input type="radio" id="sisr" name="filtre_section" value="sisr">
                SISR</label>';
                }
                if($filtre == 'slam')
                {
                    $form .= '<label for="section" class="radio-inline control-label col-1"><input type="radio" id="slam" name="filtre_section" value="slam" checked>
                SLAM</label>';
                }else{
                    $form .= '<label for="section" class="radio-inline control-label col-1"><input type="radio" id="slam" name="filtre_section" value="slam">
                SLAM</label>';
                }
                $form .= '<input type="submit" value="Filtrer">';
                $form .= '</form>';
                echo $form;
            ?>
            
            <!------------------------->
            <!-- Table des étudiants -->
            <!------------------------->
            <table class="table table-striped table-bordered">
                <caption>
                    <h4>Liste des étudiants de SIO</h4>
                </caption>
                <thead class="table-info">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="thead-light">
                    <?php
                        $html = '';
                        foreach($lesEtudiants as $unEtudiant)
                        {
                            $html .= '<tr>';
                            $html .= '<td>'.$unEtudiant->getNom().'</td>';
                            $html .= '<td>'.$unEtudiant->getPrenom().'</td>';
                            $html .= '<td>'.$unEtudiant->getDateNaissance()->format('d-m-Y').'</td>';
                            $html .= '<td>'.$unEtudiant->getEmail().'</td>';
                            /*
                             * La colonne "Actions"
                             * - un champ input pour l'id de l'étudiant (au début visible pour le debug, puis hidden)
                             * - un bouton "Editer"
                             * - un bouton "Supprimer"
                             */
                            
                            $html .= '<td>';
                            $html .= '<input type="text" id="etudiant_id" name="etudiant_id" size="3" value="'.$unEtudiant->getIdEtudiant().'">';
                            $html .= '<button type="button" class="btn btn-warning mx-1 fa fa-pencil btn-update"></button>';
                            $html .= '<button type="button" class="btn btn-danger mx-1 fa fa-trash btn-delete"></button>';
                            $html .= '</td>';
                            $html .= '</tr>';
                        }
                        echo $html;
                    ?>
                </tbody>
            </table>
            
            <!-- Bouton Ajouter -->
            <button type="button" id="btn-ajouter" class="btn btn-success"><span class="fa fa-plus"></span>&nbsp;Ajouter</button>
            
        </div><!-- fin content -->
        
        <!-- Fenêtre modale -->
        
        <div class="modal" id="modaletudiant" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Fiche étudiant</h4>
                        <button type="button" class="close" id="btn-close-modale-etudiant"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form class="col">
                            <div class="form-group row">
                                <label for="idetudiant" class="col-form-label col-form-label-sm col-sm-4">Id étudiant</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control-sm" name ="idetudiant" id="idetudiant" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nom" class="col-form-label col-form-label-sm col-sm-4">Nom</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control-sm" name ="nom" id="nom" placeholder="Nom étudiant">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prenom" class="col-form-label col-form-label-sm col-sm-4">Prénom</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control-sm" name="prenom" id="prenom" placeholder="Prénom étudiant">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="datenaissance" class="col-form-label col-form-label-sm col-sm-4">Date de naissance</label>
                                <div class="col">
                                    <input type="text" class="form-control form-control-sm" name="datenaissance" id="datenaissance" placeholder="JJ/MM/AAAA">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-form-label-sm col-sm-4">Email</label>
                                <div class="row">
                                    <input type="email" class="form-control form-control-sm" name="email" id="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="telmobile" class="col-form-label col-form-label-sm col-sm-4">Tél. mobile</label>
                                <div class="row">
                                    <input type="text" class="form-control form-control-sm" name="telmobile" id="telmobile" placeholder="Tél. mobile">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="section" class="col-form-label col-form-label-sm col-sm-4">Section</label>
                                <div class="row">
                                    <select class="form-control form-control-sm" id="select-section" name="idsection">
                                        <?php
                                            $html = '';
                                            $i = 1;
                                            $lesSections = SectionManager::getLesSections();
                                            foreach($lesSections as $uneSection){
                                                if($i == 1){
                                                   $html .= '<option value="'.$uneSection->getIdSection().'" selected>'; 
                                                } else {
                                                    $html .= '<option value="'.$uneSection->getIdSection().'">';
                                                }
                                                $html .= $uneSection->getLibelleSection();
                                                $html .= '</option>';
                                                $i++;
                                            }
                                            echo $html;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <button type="button" id="EnvoyerEtudiantModalForm" class="btn btn-primary pull-right">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Fin fenêtre modale -->
        
        <!-- Chargement JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
        <!-- CRUD en javascript -->
        <!-- <script src="./js/js-modale-etudiant.js"></script> -->
        <!-- <script src="./js/js-crud-etudiant.js"></script> -->
        
        <!-- CRUD en javascript -->
        <script src="./js/jquery-modale-etudiant.js"></script>
        <script src="./js/jquery-crud-etudiant.js"></script>
 
    </body>
</html>