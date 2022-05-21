<?php
// insérer une catégorie de produit
function insert_cart_product($name_cat_product)
{
    // recup de la connection
    global $connection;
    // insert dans la table products
    $sql = "INSERT INTO categories_products(name_cat_product) 
    VALUES (:name_cat_product)";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':name_cat_product' => $name_cat_product
    ));
}
// mise à jour d'un produit
function update_cat_product($id_cat_product, $name_cat_product)
{
    // recup de la connection
    global  $connection;
    // Modification d'un product
    $sql = "UPDATE categories
    SET name_cat_product = '$name_cat_product'
    WHERE id_cat_product =$id_cat_product";
    $sth = $connection->prepare($sql);
    $sth->execute();
}
// fonction qui va sélectionner toutes les catégories de produits
function liste_cat_products()
{
    // recup de la connection
    global  $connection;
    $sql = "SELECT * FROM categories_products";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// Sélectionner une catégorie de produits
function select_cat_product($id_cat_product)
{
    // recup de la connection
    global $connection;
    $sql =  "SELECT * FROM categories_products
    INNER JOIN products ON products.id_cat_product = categories_products.id_cat_product
    WHERE products.id_cat_product='$id_cat_product' AND products.active = 1";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// recupération d'une catégorie unique demandé par id_product
function cat_product_unique($id_cat_product)
{
    // recup de la connection
    global  $connection;
    $sql =  "SELECT *  FROM categories_products
    WHERE id_cat_product=$id_cat_product";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    return $resultat;
}