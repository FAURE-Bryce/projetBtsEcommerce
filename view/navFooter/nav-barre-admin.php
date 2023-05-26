<header>
    <!-- Logo de l'entreprise -->
    <div id="all_nav_bar_admin">
        <a href="admin/listProduit/" class="col-2"><img src="img/logo_bryce.png" alt="logo"></a>
        <a href="admin/listUser/"><p>Users</p></a>
        <a href="admin/listCommande/"><p>Commandes</p></a>
        <a href="admin/listProduit/"><p>Produit</p></a>
    </div>
    <div id='div_bonjour'>
        <?php echo"<p>"."Bonjour ".$_SESSION['prenom']." ".$_SESSION['nom']."</p>"; ?>
    </div>
</header>