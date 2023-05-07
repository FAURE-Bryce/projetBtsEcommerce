/* 
 * Code jQuery de démonstration uniquement pour :
 * - ajouter un évènement click à un bouton
 * - définir la fonction anonyme
 * Auteur: T. Savary
 * Date: 2020-09
 */

/*
 * Au chargement de la page
 */
$(document).ready(function() {
      console.log("DOM chargé.");
      $("#btn-hello").click(function (){
          alert("Hello world avec jQuery !");
      });
});

