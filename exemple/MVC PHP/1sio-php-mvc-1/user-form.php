<?php

/**
 * /user-form.php
 * Mini formulaire utilisateur du TD jQuery
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
        
    </head>
    <body class="container">
        
        <div id="content">
            <h1 class="text-primary">Formulaire utilisateur</h1>
        
            <!-- Formulaire utilisateur -->
            <div id="user-form" class="offset-2 col-8">
                <div class=""row">
                    <form class="col border border-dark rounded" method="#" action="#">
                            
                            <!-- Input Pseudo -->
                            <div class="form-group row mt-2">
                                <label for="user-pseudo" class="col-form-label col-4">Pseudonyme</label>
                                <div class="col-8">
                                    <input type="text" class="form-control champ" name="user-pseudo" id="user-pseudo" placeholder="<Saisissez votre pseudo>">
                                </div>
                            </div>
                            
                            <!-- Input Mot de passe -->
                            <div class="form-group row">
                                <label for="user-password" class="col-form-label col-4">Mot de passe</label>
                                <div class="col-8">
                                    <input type="password" class="form-control champ" name="user-password" id="user-password" placeholder="<Saisissez votre mot de passe>">
                                </div>
                            </div>
                            
                            <!-- Input Confirmation Mot de passe -->
                            <div class="form-group row">
                                <label for="user-confirm-password" class="col-form-label col-4">Confirmation</label>
                                <div class="col-8">
                                    <input type="password" class="form-control champ" name="user-confirm-password" id="user-confirm-password" placeholder="<Confirmez votre mot de passe>">
                                </div>
                            </div>
                            <span id="confirm-erreur" class="msg-erreur">Erreur</span>
                            
                            <!-- Input Email -->
                            <div class="form-group row">
                                <label for="user-email" class="col-form-label col-4">Email</label>
                                <div class="col-8">
                                    <input type="email" class="form-control champ" name="user-email" id="user-email" placeholder="<Adresse email>">
                                </div>
                            </div>
                        
                        <!-- Boutons annuler | envoyer -->
                        <div class="row">
                            <div class="offset-7">
                                <button type="reset" id="btn-reset" class="btn btn-primary my-2">Reset</button>
                                <button type="submit" id="btn-sumit" class="btn btn-primary my-2">Envoyer</button>
                            </div>
                        </div>
                            
                    </form><!-- Fin du formulaire utilisateur -->
                    
                    <p id="erreur" class="text-danger">Erreur(s) dans le formulaire.</p>
                    
                </div>
                
            </div><!-- fin div user-form -->
            
        </div><!-- fin content -->
        
        
        
        <!-- Chargement JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
        <!-- user-form.js -->
        <script src="./js/user-form.js"></script>
    </body>
</html>

