<header>
    <!-- Logo de l'entreprise -->
    <a href="" class="col-2"><img src="img/logo_bryce.png" alt="logo"></a>

    <!-- Barre de recherche -->
    <form action="produit/recherche/" method="POST" class="col-4 offset-2">
        <?php echo"<p id='etat_connexion'>".$params['etatConnexion']."</p>"; ?>
        <input type="search" name="barreRecherche" id="barreRecherche" placeholder="Recherche">
    </form>

    <div  class="col-4">
        <!-- Logo de connexion au compte -->
        <a href="<?php echo $params['lienConnexion']; ?>"><?php echo $params['libelleConnexion'];?></a>

        <!-- Logo de pannier -->
        <a href="<?php echo $params['lienPanier']; ?>">Panier</a>
    </div>
</header>

<!-- Nav Barre -->
<nav>
    <ul>
        <?php
            foreach ($params['listTypesEcrans'] as $typesEcran) {
                echo '<li><a href="typeEcran/'. $typesEcran->getLibelle() .'/">'.$typesEcran->GetLibelle().'</a></li>';
            }
        ?>
    </ul>
</nav>