<?php
// demarrage des sessions
include "conect.php";
include "fonction.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- titre -->
    <title>ADMINISTRATION</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Jodit -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.2.65/jodit.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.2.65/jodit.min.js"></script>
</head>

<body>
    <!-- barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #676aff;">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <!-- produits -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light font-weight-bold text-uppercase px-3" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Boutique
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="admin_products.php">Créer un produit</a>
                        <a class="dropdown-item" href="admin_modif_products.php">Modifier un produit</a>
                        <a class="dropdown-item" href="admin_cat_product.php">Créer une catégorie de produit</a>
                        <a class="dropdown-item" href="admin_modif_cat_product.php">Modifier une catégorie de produit</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light font-weight-bold text-uppercase px-3" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Blog
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="admin_articles.php">Créer un article</a>
                        <a class="dropdown-item" href="admin_modif_articles.php">Modifier un article</a>
                        <a class="dropdown-item" href="admin_cat_article.php">Créer une catégorie d'article</a>
                        <a class="dropdown-item" href="admin_modif_cat_article.php">Modifier une catégorie d'article</a>
                    </div>
                </li>
                <!-- Commentaires -->
                <li class="nav-item">
                    <a class="nav-link text-light font-weight-bold text-uppercase px-3" href="admin_comments.php">Commentaires</span></a>
                </li>
                <!-- Utilisateurs -->
                <li class="nav-item">
                    <a class="nav-link text-light font-weight-bold text-uppercase px-3" href="admin_users.php">Utilisateurs</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Site WEB -->
                <li class="nav-item">
                    <a class="nav-link text-light font-weight-bold text-uppercase px-3" href="index.php">Site
                        WEB</span></a>
                </li>
                <!-- Déconnexion -->
                <li class="nav-item">
                    <a class="nav-link text-light font-weight-bold text-uppercase px-3" href="deconnexion.php">Déconnexion</span></a>
                </li>
            </ul>
        </div>
    </nav>