<?php

/**
 * /controller/routeur.php
 * 
 * Fichier de routage vers le bon contrôleur et la bonne action
 *
 * @author B.FAURE
 * @date 03/2023
 */

 // inclut le fichier de class du controller
 $controller .= 'Controller'; // la variable controller ne contenait qu'une partie du nom du fichier, on le complète
 require_once ROOT.'/controller/'.$controller.'.php';

 // appelle la méthode correspondant à l'action
 $params = array();
 // si dans l'url, en plus des paramètres controller et action, il y a d'autres paramètres alors ils dovent être passés au contrôleur
 $controller::$action($params);

?>