<?php
// insertion payment
function insert_payment($id_user)
{
    // récupération de la connection
    global $connection;
    @$bill_number = uniqid();
    // insertion dans la table payment
    $sql = "INSERT INTO payments(id_user)
    VALUES (:id_user)";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':id_user' => $id_user
    ));
    $id_payment = $connection->lastInsertId();
    // mise à jour payment
    update_payment($id_user, $id_payment);
    header('Location: thanks.php');
    exit();
}
// mise à jour payment
function update_payment($id_user, $id_payment)
{
    // récupération de la connection
    global  $connection;
    // mise à jour de l'id_payment dans la base wallet
    $sql = "UPDATE carts
    SET id_payment =$id_payment
    WHERE id_user =$id_user AND id_payment=0 AND active=1";
    $sth = $connection->prepare($sql);
    $sth->execute();
}
function select_id_payment($id_user)
{
    // récupération de la connection
    global $connection;
    // selection des paiements de l'utilisateur
    $sql =  "SELECT * FROM payments 
    WHERE id_user='$id_user'";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
function select_id_payment_bill($id_user, $id_payment)
{
    // récupération de la connection
    global $connection;
    $sql = "SELECT * FROM carts
    INNER JOIN products ON products.id_product = carts.id_product
    WHERE id_user = '$id_user' AND id_payment = '$id_payment'";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    //var_dump($resultat);
    return $resultat;
}