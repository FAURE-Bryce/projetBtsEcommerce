/**
 * /js/user-form.js
 * Code jQuery du formulaire interactif
 * 
 * @author 1sio-slam
 * @date 05-2021
 */

/*
 * Au chargement de la page
 */
$(document).ready(function() {
      console.log("DOM chargé.");
      
    // récupère les éléments dans des variables
    var userpseudo = $('#user-pseudo'),
        userpassword = $('#user-password'),
        userconfirmpassword = $('#user-confirm-password'),
        useremail = $('#user-email'),
        btnsubmit = $('#btn-submit'),
        btnreset = $('#btn-reset'),
        erreur = $('#erreur'),
        champs = $('.champ');
        
    /*
     * initialisation
     */ 
    
    // par défaut le <p> erreur est non visible
    $('#erreur').css('display', 'none');
    
    // de même tous les messages d'erreur
    $('.msg-erreur').css('display', 'none');
        
    // évènement keyup
    $('.champ').keyup(function(){
        console.log('OK keyup');
        console.log(userpassword.val());
        let lngsaisie = $(this).val().length;
        console.log('LngSaisie = ' + lngsaisie);
        
        if(lngsaisie < 5){
            $(this).css({
                'border-color': 'red',
                'color': 'red'
            });
        } else {
            $(this).css({
                borderColor: 'green',
                color: 'green'
            });
        }
    });
    
    // teste la confirmation du mot de passe
    userconfirmpassword.keyup(function(){
        if($(this).val() != userpassword.val()){
           $(this).css({
                borderColor: 'red',
                color: 'red'
            });
            // affiche le message d'erreur
            $('#confirm-erreur').css('display', 'block');
        } else {
            $(this).css({
                borderColor: 'green',
                color: 'green'
            }); 
            // rend invisible le message d'erreur
        }
    });
    
    // bouton submit
    btnsubmit.click(function(e){
        // on annule la fonction par défaut du bouton d'envoi du formulaire
       e.preventDefault(); 
    });
    
    /*
     * Verifier(champ)
     * Fonction de vérification d'un champ de formulaire
     */
    function verifier(champ){
        
    }

});