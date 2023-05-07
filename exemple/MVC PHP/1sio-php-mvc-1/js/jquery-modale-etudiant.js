/* 
 * /js/jquery-modale-etudiant.js
 * Code jquery qui gère la modale formulaire étudiant :
 * - ouvrir (afficher) la modale
 * - fermer (cacher) la modale
 * - initialiser les valeurs par défaut (nouvel étudiant par exemple)
 */

/*
 * Initialise les champs de la modale avec leurs valeurs par défaut
 */
function initialiserModaleEtudiant(){
    
    // récupère les éléments du formulaire
    //document.getElementById('idetudiant').value = 0;
    $('#idetudiant').val(0);
    //document.getElementById('nom').value = "Nom étudiant";
    $('#nom').val('Nom étudiant');
    //document.getElementById('prenom').value = "Prénom étudiant";
    $('#prenom').val('Prénom étudiant');
    //document.getElementById('datenaissance').value = "JJ/MM/AAAA";
    $('#datenaissance').val('JJ/MM/AAAA');
    //document.getElementById('email').value = "Email";
    $('#email').val('Email');
    //document.getElementById('telmobile').value = "Tél. mobile";
    $('#telmobile').val('Tél. mobile');
    // sélectionne la bonne option de la liste déroulante
    //document.getElementById('select-section').selectedIndex = 0;
    
}

function ouvrirModalEtudiant(){
    
    // ouvre (rend visible) l'affichage de la pop-up
    //var popup = document.getElementById('modaletudiant');
    //popup.style.display = 'block';
    //  $('#myModal').modal('show');
    $('#modaletudiant').modal('show');
}

function fermerModalEtudiant(){
    
    // ferme l'affichage de la pop-up (invisible)
    //var popup = document.getElementById('modaletudiant');
    //popup.style.display = 'none';
    //$('#myModal').modal('hide');
    $('#modaletudiant').modal('hide');
}