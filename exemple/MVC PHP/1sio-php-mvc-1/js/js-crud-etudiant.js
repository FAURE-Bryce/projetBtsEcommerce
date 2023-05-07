/* 
 * Gère les interactions de l'IHM
 * pour réaliser le crud étudiant
 * 
 * Auteur: T. Savary
 * Date: 09/2020
 */

/*
* au chargement de la page, ajoute les event listener
* */
window.onload = function(){
    
    // teste le chargement de la page
    console.log('document chargé');
    
    // btn-close-modale-etudiant
    var btnClose = document.getElementById('btn-close-modale-etudiant');
    btnClose.addEventListener('click', function(){
        fermerModalEtudiant();
    });
    console.log('AddEventListener du btn-close : OK');
    
    // btn-ajouter
    var btnAjouter = document.getElementById('btn-ajouter');
    btnAjouter.addEventListener('click', function(){
        initialiserModaleEtudiant();
        ouvrirModalEtudiant();
    });
    console.log('AddEventListener du btn-ajouter : OK');  
    
    /*
     * Ajoute les eventListener aux boutons supprimer
     */
    
    // récupère une collection d'éléments html
    var btnsSupprimer = document.querySelectorAll('.btn-delete');
    
    // boucle sur chaque élément
    Array.prototype.forEach.call(btnsSupprimer, function(btnSupprimer){
        
        // ajoute l'eventListener
        btnSupprimer.addEventListener('click', function(){
            
            // récupère la valeur idetudiant de la ligne dans le champ input
            idEtudiant = btnSupprimer.parentNode.firstChild.value;
            
            // demande de confirmation
            var isdeleteconfirm;
            isdeleteconfirm = confirm('Etes-vous sûr de vouloir supprimer l\'étudiant ' + idEtudiant + ' ?');
            
        });
    });
    console.log('AddEventListener des btn-supprimer : OK');
    
    /*
     * Ajoute les eventListener aux boutons modifier
     */
    var btnsModifier = document.querySelectorAll('.btn-update');
    
    // boucle sur chaque élément
    Array.prototype.forEach.call(btnsModifier, function(btnModifier){
        
        // ajoute l'eventListener
        btnModifier.addEventListener('click', function(){
            // récupère la valeur idetudiant de la ligne dans le champ input
            idEtudiant = btnModifier.parentNode.firstChild.value;
            
            // affiche une alerte avec l'id de l'étudiant sélectionné
            alert('Vous êtes sur le point de modifier l\'étudiant : ' + idEtudiant);
        });
    });
    console.log('AddEventListener des btn-editer : OK');
        
};
    
    
