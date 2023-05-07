/* 
 * /js/js-modale-etudiant.js
 * Code javascript qui gère la modale formulaire étudiant :
 * - ouvrir (afficher) la modale
 * - fermer (cacher) la modale
 * - initialiser les valeurs par défaut (nouvel étudiant par exemple)
 */

/*
 * Initialise les champs de la modale avec leurs valeurs par défaut
 */
function initialiserModaleEtudiant(){
    
    // récupère les éléments du formulaire
    document.getElementById('idetudiant').value = 0;
    document.getElementById('nom').value = "Nom étudiant";
    document.getElementById('prenom').value = "Prénom étudiant";
    document.getElementById('datenaissance').value = "JJ/MM/AAAA";
    document.getElementById('email').value = "Email";
    document.getElementById('telmobile').value = "Tél. mobile";
    // sélectionne la bonne option de la liste déroulante
    document.getElementById('select-section').selectedIndex = 0;
}

function ouvrirModalEtudiant(){
    
    // ouvre (rend visible) l'affichage de la pop-up
    var popup = document.getElementById('modaletudiant');
    popup.style.display = 'block';
}

function fermerModalEtudiant(){
    
    // ferme l'affichage de la pop-up (invisible)
    var popup = document.getElementById('modaletudiant');
    popup.style.display = 'none';
}
