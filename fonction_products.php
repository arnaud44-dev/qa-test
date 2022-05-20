<?php
// insérer un produit
function insert_product($title_product, $price, $descriptive, $id_cat_product)
{
    // recupération de la connection
    global $connection;
    // insertion dans la table products
    $sql = "INSERT INTO products(title_product,quantity,price,descriptive,id_cat_product,id_tva,active) 
    VALUES (:title_product,:quantity,:price,:descriptive,:id_cat_product,:id_tva,:active)";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':title_product' => $title_product,
        ':quantity' => 1,
        ':price' => $price,
        ':descriptive' => $descriptive,
        ':id_cat_product' => $id_cat_product,
        ':id_tva' => 20,
        ':active' => 0
    ));
    // recuperation de l'id_product
    $id_product = $connection->lastInsertId();
    //recuperation nom de l'image
    $filename = img_load_product($id_product);
    //update nom de l'image
    $sql = "UPDATE products 
    SET img = '$filename'
    WHERE id_product =$id_product";
    $sth = $connection->prepare($sql);
    $sth->execute();
}
// mise à jour d'un produit
function update_product($id_product, $title_product, $quantity, $price, $descriptive, $id_cat_product)
{
    // recupération de la connection
    global  $connection;
    // Modification d'un product
    $sql = "UPDATE products
    SET title_product = '$title_product', quantity = $quantity, price = $price, descriptive = '$descriptive', id_cat_product = $id_cat_product 
    WHERE id_product =$id_product";
    $sth = $connection->prepare($sql);
    $sth->execute();
    // selection de l'image pour comparaison
    $sql =  "SELECT img FROM products 
    WHERE id_product=$id_product";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    //detruire l'image si differente
    if ($_FILES["img"]["name"] != "") {
        if (isset($resultat->img)) {
            if ($resultat->img != $_FILES["img"]["name"]) {
                unlink("upload/" . $resultat->img);
                // recuperation du nom de l'image
                $filename = img_load_product($id_product);
            }
        }
    }
    //update nom de l'image
    if (isset($filename)) {
        $sql = "UPDATE products 
    SET img = '$filename'
    WHERE id_product =$id_product";
        $sth = $connection->prepare($sql);
        $sth->execute();
    }
}
// désactiver un produit
function desactive_product($id_product)
{
    // recupération de la connection
    global  $connection;
    $sql = "UPDATE products 
    SET active = 0 
    WHERE id_product =$id_product";
    $sth = $connection->prepare($sql);
    $sth->execute();
    // effacer les session
}
// activation d'un produit
function activate_product($id_product)
{
    // recupération de la connection
    global  $connection;
    $sql = "UPDATE products 
    SET active = 1 
    WHERE id_product =$id_product";
    $sth = $connection->prepare($sql);
    $sth->execute();
    // effacer les session
}
// selection d'un produit par titre de produit
function liste_title_product()
{
    // recupération de la connection
    global  $connection;
    $sql = "SELECT * FROM products 
    ORDER BY title_product ASC";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// recupération d'un produit unique demandé par id_product
// function product_unique($id_product)
// {
//     // recupération de la connection
//     global  $connection;
//     $sql =  "SELECT *  FROM products
//     WHERE id_product='$id_product'";
//     $sth = $connection->prepare($sql);
//     $sth->execute();
//     $resultat = $sth->fetch(PDO::FETCH_OBJ);
//     return $resultat;
// }
// télécharger une image de produit
function img_load_product($id_product)
{
    // si il y a une nouvelle img
    if ($_FILES) {
        // Vérifie si le fichier a été uploadé sans erreur.
        if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["img"]["name"];
            $temp = explode(".", $filename);
            $filetype = $_FILES["img"]["type"];
            $filesize = $_FILES["img"]["size"];
            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");
            // Vérifie la taille du fichier - 5Mo maximum
            $maxsize = 5 * 1024 * 1024;
            if ($filesize > $maxsize) die("Erreur: La taille du fichier est supérieure à la limite autorisée.");
            // Vérifie le type MIME du fichier
            if (in_array($filetype, $allowed)) {
                // Vérifie si le fichier existe avant de le télécharger.
                if (file_exists("upload/" . $_FILES["img"]["name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], "upload/" . $_FILES["img"]["name"]);
                } else {
                    move_uploaded_file($_FILES["img"]["tmp_name"], "upload/" . $_FILES["img"]["name"]);
                }
            } else {
                echo "Erreur: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
            }
        } else {
            echo "Erreur: " . $_FILES["img"]["error"];
        }
        return @$filename;
    }
}

// selection du produit unique avec un inner join
function product_unique($id_product)
{
    // recupération de la connection
    global $connection;

    $sql =  "SELECT *  FROM categories_products
    INNER JOIN products ON products.id_cat_product = categories_products.id_cat_product
    WHERE products.id_product = $id_product";

    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultatUnique = $sth->fetch(PDO::FETCH_OBJ);
    return $resultatUnique;
}
// Permet le recupération les produits par les id pour afficher sur la page product
function recup_all_products_by_id($id_product)
{
    // recupération de la connection
    global  $connection;

    $sql =  "SELECT *  FROM products
    WHERE products.id_product= '$id_product' AND products.active = 1";

    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// Sélection de tous les produits
function select_all_products()
{
    // recupération de la connection
    global $connection;
    $sql =  "SELECT * FROM categories_products
    INNER JOIN products ON products.id_cat_product = categories_products.id_cat_product";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}