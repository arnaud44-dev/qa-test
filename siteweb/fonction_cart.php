<?php
// ajouter un panier
function insert_cart($id_cart, $id_product, $id_user, $quantity, $price)
{
    // recup de la connection
    global $connection;
    $sql = "SELECT id_product FROM carts 
    WHERE carts.id_user=$id_user AND id_product=$id_product AND active=1 AND id_payment=0";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    if ($resultat) {
        update_quantity($id_product, $quantity);
    } else {
        // insert dans la table carts
        $sql = "INSERT INTO carts(id_product, id_user, quantity, price, id_tva, active, id_payment) 
    VALUES (:id_product, :id_user, :quantity, :price, :id_tva, :active, :id_payment)";
        $sth = $connection->prepare($sql);
        $sth->execute(array(
            ':id_product' => (int) $id_product,
            ':id_user' => (int) $id_user,
            ':quantity' => 1,
            ':price' => (float) $price,
            ':id_tva' => 20,
            ':active' => 1,
            ':id_payment' => 0
        ));
    }
}
// mise à jour du panier
function update_cart($id_cart, $quantity)
{
    // recup de la connection
    global $connection;
    $sql = "UPDATE carts SET quantity = $quantity 
    WHERE id_cart=$id_cart AND active=1 AND id_payment=0";
    $sth = $connection->prepare($sql);
    $sth->execute();
}
// mise à jour de la quantité
function update_quantity($id_product, $quantity)
{
    // recup de la connection
    global $connection;
    $sql = "UPDATE carts SET quantity=quantity+$quantity
    WHERE id_product = $id_product AND active=1 AND id_payment=0";
    $sth = $connection->prepare($sql);
    $sth->execute();
}
// calcul du prix avec TVA
function calcul_price($price, $quantity, $id_tva)
{
    $tva= $id_tva / 100;
    return $price * $quantity + ($price * $quantity * $tva);
}
// calcul du prix sans TVA
function calcul_priceNoTVA($price, $quantity)
{
    return $price * $quantity;
}
// Affichage d'un panier non payé
function select_cart_id_user()
{
    // recup de la connection
    global $connection;
    $id_user = $_SESSION["id_user"];
    $sql =  "SELECT * FROM products
    INNER JOIN carts ON carts.id_product = products.id_product
    WHERE carts.id_user='$id_user' AND carts.active = 1 AND carts.id_payment=0";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// desactivation d'un panier
function desactive_cart($id_user)
{
    // var_dump($id_user);
    // die;
    // recup de la connection
    global $connection;
    // mise à jour de l'activité du panier
    $sql = "DELETE carts
    SET active = 0
    WHERE id_user=$id_user AND id_payment=0";
    $sth = $connection->prepare($sql);
    $sth->execute();
}
// desactivation d'un produit d'un panier
function desactive_product_cart($id_user, $id_product)
{
    // recup de la connection
    global $connection;
    // mise à jour de l'activité du panier
    $sql = "UPDATE carts
    SET active=0
    WHERE id_product=$id_product AND id_user=$id_user AND id_payment=0";
    $sth = $connection->prepare($sql);
    $sth->execute();
}
// recupération d'un produit unique demandé par id_product
function cart_unique($id_cart)
{
    // recup de la connection
    global  $connection;
    $sql =  "SELECT *  FROM carts
    WHERE id_cart=$id_cart";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    return $resultat;
}
function paiement_cart($id_cart)
{
    // recup de la connection
    global $connection;
    $sql = "UPDATE carts
    SET id_payment=1
    WHERE id_cart =$id_cart AND id_payment=0";
    $sth = $connection->prepare($sql);
    $sth->execute();
    // header('location: paiement.php');
}