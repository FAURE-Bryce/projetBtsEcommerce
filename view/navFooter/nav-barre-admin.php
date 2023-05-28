<header>
    <!-- Logo de l'entreprise -->
    <div id="all_nav_bar_admin">
        <a href="admin/listProduit/" class="col-2"><img src="img/logo_bryce.png" alt="logo"></a>
        <a href="admin/listUser/"><p>Users</p></a>
        <a href="admin/listCommande/"><p>Commandes</p></a>
        <a href="admin/listCommande/"><p>Mode de paiement</p></a>
        <a href="admin/listProduit/"><p>Produit</p></a>
        <a href="admin/listRole/"><p>Role</p></a>
        <a href="admin/listModel/"><p>Model</p></a>
        <a href="admin/listMarque/"><p>Marque</p></a>
        <a href="admin/listTaille/"><p>Taille</p></a>
        <a href="admin/listTypeEcran/"><p>Type</p></a>
        <a href="gestionCompte/deconnexion/"><p>Déconnexion</p></a>
    </div>
    <div id='div_bonjour'>
        <?php echo"<p>"."Bonjour ".$_SESSION['prenom']." ".$_SESSION['nom']."</p>"; ?>
    </div>
</header>