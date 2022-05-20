<?php
// insérer une catégorie
function insert_cat_article($name_cat_article)
{
    // recup de la connection
    global $connection;
    // insert dans la table products
    $sql = "INSERT INTO categories_articles(name_cat_article) 
    VALUES (:name_cat_article)";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':name_cat_article' => $name_cat_article
    ));
}
// liste des categories d'articles
function liste_cat_articles()
{
    // recup de la connection
    global  $connection;
    $sql = "SELECT * FROM categories_articles";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// Sélectionner une catégorie d'article
function select_cat_article($id_cat_article)
{
    // recup de la connection
    global $connection;
    $sql =  "SELECT *  FROM links
    INNER JOIN articles ON articles.id_article = links.id_article
    INNER JOIN categories_articles ON categories_articles.id_cat_article = links.id_cat_article
    INNER JOIN users ON users.id_user = links.id_user
    WHERE links.id_cat_article ='$id_cat_article'";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// mise à jour d'un produit
function update_cat_article($id_cat_article, $name_cat_article)
{
    // recup de la connection
    global  $connection;
    // Modification d'un product
    $sql = "UPDATE categories_articles
    SET name_cat_article = '$name_cat_article'
    WHERE id_cat_article =$id_cat_article";
    $sth = $connection->prepare($sql);
    $sth->execute();
}
function cat_article_unique($id_cat_article)
{
    // recup de la connection
    global  $connection;
    $sql =  "SELECT *  FROM categories_articles
    WHERE $id_cat_article=$id_cat_article";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    return $resultat;
}
