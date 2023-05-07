/* 
 * Code jQuery de démonstration (non fonctionnel) uniquement pour :
 * - ajouter un évènement click à une collection de boutons
 * - l'appel ajax
 * - la récupération du json d'un étudiant
 * Auteur: T. Savary
 * Date: 2020-09
 */

/*
 * Au chargement de la page
 */
$(document).ready(function() {
      console.log("DOM chargé.");
      
      // click sur le btn-close de la modale
      $('#btn-close-modale-etudiant').click(fermerModalEtudiant);
      
      // boucle sur les éléments bouton modifier
      $('.btn-update').each(function(){
          // attache l'évènement clic
          $(this).click(function(){
              //
              console.log('Click OK');
              
              // ouvre la modale et peuple les valeurs de l'étudiant
              initialiserModaleEtudiant();
              ouvrirModalEtudiant();
              
              // indique la valeur de l'id étudiant
              // en récupérant la valeur dans l'élément input
              let tdparent = $(this).parent();
              let elinput = tdparent.children('input');
              let idetudiant = elinput.val();
              console.log('id étudiant = ' + idetudiant);
              $('#idetudiant').val(idetudiant);
          });
      });
      
      // boucle sur les éléments bouton supprimer
      $('.btn-delete').each(function(){
          // attache l'évènement click
          $(this).click(function(){
              
              // indique la valeur de l'id étudiant
              // en récupérant la valeur dans l'élément input
              let tdparent = $(this).parent();
              let elinput = tdparent.children('input');
              let idetudiant = elinput.val();
              
              let isDeleteConfirm = confirm('Etes-vous sûr de vouloir supprimer l\'étudiant n°' + idetudiant);
              console.log('Résultat confirm = ' + isDeleteConfirm);
          });
      });
});