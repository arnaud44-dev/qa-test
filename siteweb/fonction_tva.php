<?php
// insérer une catégorie
function insert_tva($tva)
{
    // recup de la connection
    global $connection;
    // insert dans la table products
    $sql = "INSERT INTO categories_products(tva) 
    VALUES (:tva)";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':tva' => $tva
    ));
}