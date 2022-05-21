<?php
include "conect.php";
include "fonction.php";
$categoryProducts = liste_cat_products();
$categoryArticles = liste_cat_articles();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- titre -->
    <title>DogLand le site pour les chiens</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/print.css" rel="stylesheet" type="text/css" media="print" />
</head>

<body>
    <!-- barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#28a745;">
        <a class="navbar-brand" href="#">
            <img src="logo/logo_navbar.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <!-- page d'accueil -->
                <li class="nav-item active">
                    <a class="nav-link text-light font-weight-bold text-uppercase px-3" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <!-- le blog -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light font-weight-bold text-uppercase px-3" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Nos conseils
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php foreach ($categoryArticles as $row) { ?>
                            <a class="dropdown-item" href="blog.php?id=<?php echo $row->id_cat_article; ?>"><?php echo $row->name_cat_article; ?>
                            </a>
                        <?php } ?>
                    </div>
                </li>
                <!-- boutique -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light font-weight-bold text-uppercase px-3" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Boutique
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php foreach ($categoryProducts as $row) { ?>
                            <a class="dropdown-item" href="product_cat.php?id=<?php echo $row->id_cat_product; ?>"><?php echo $row->name_cat_product; ?>
                            </a>
                        <?php } ?>
                    </div>
                </li>
                <!-- livre d'or -->
                <li class="nav-item">
                    <a class="nav-link text-light font-weight-bold text-uppercase px-3" href="book.php">Livre d'or</a>
                </li>
                <!-- contact -->
                <li class="nav-item">
                    <a class="nav-link text-light font-weight-bold text-uppercase px-3" href="contact.php">Contact</a>
                </li>
            </ul>
            <!-- utilisateur connecté -->
            <?php if (@$_SESSION['id_user']) { ?>
                <ul class="navbar-nav ml-auto">
                    <!-- compte client -->
                    <li class="nav-item compte">
                        <a class="nav-link text-light font-weight-bold text-uppercase px-3" name="compte" value="compte" href="account.php">Compte Client</a>
                    </li>
                    <!-- deconnexion -->
                    <li class="nav-item deconnexion">
                        <a class="nav-link text-light font-weight-bold text-uppercase px-3" name="deconnexion" value="deconnexion" href="deconnexion.php">Déconnexion</a>
                    </li>
                    <!-- panier -->
                    <li class="nav-item">
                        <a class="nav-link text-light font-weight-bold text-uppercase px-3" name="panier" value="panier" href="cart.php"><i class="fas fa-shopping-cart fa-2x"></i></a>
                    </li>
                </ul>
                <!-- utilisateur non connecté -->
            <?php } else { ?>
                <ul class="navbar-nav ml-auto">
                    <!-- utilisateur non connecté -->
                    <li class="nav-item">
                        <a class="nav-link text-light font-weight-bold text-uppercase px-3" name="connexion" value="connexion" href="login.php">Connexion</a>
                    </li>
                    <!-- s'inscrire en tant qu'utilisateur client -->
                    <li class="nav-item">
                        <a class="nav-link text-light font-weight-bold text-uppercase px-3" name="inscription" value="inscription" href="inscription.php">Inscription</a>
                    </li>
                </ul>
            <?php } ?>
            <!-- recherche d'article par mot clé -->
            <form class="form-inline" action="search.php" method="POST">
                <input class="form-control form-search" type="" placeholder="Mot clé" aria-label="Search" name="rechercher">
                <button class="btn btn-warning" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </nav>