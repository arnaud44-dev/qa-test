<?php
// fonction qui permet de créer un article
function insert_article($title_article, $article, $id_cat_article, $id_user)
{
    // recupération de la connection
    global $connection;
    // insertion dans la table articles
    $sql_ins = "INSERT INTO articles(title_article,article) 
    VALUES (:title_article,:article)";
    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':title_article' => $title_article,
        ':article' => $article
    ));
    // recuperation de id_article
    $id_article = $connection->lastInsertId();
    $id_user = $_SESSION["id_user"];
    // appel la fonction pour passer les id
    insert_link($id_article, $id_cat_article, $id_user);
    //recuperation nom de l'image
    $filename = img_load_article($id_article);
    //update nom de l'image
    $sql = "UPDATE articles 
    SET img = '$filename'
    WHERE id_article =$id_article";
    $sth = $connection->prepare($sql);
    $sth->execute();
}
// fonction qui permet d'insérer dans la base liaison
function insert_link($id_article, $id_cat_article, $id_user)
{
    // recupération de la connection
    global $connection;
    $sql_ins = "INSERT INTO  links(id_article, id_user, id_cat_article) 
    VALUES (:id_article, :id_user, :id_cat_article)";
    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':id_article' => $id_article,
        ':id_user' => $id_user,
        ':id_cat_article' => $id_cat_article
    ));
}
// fonction qui permet de récupérer les articles sur la base de liaison
function recup_des_articles()
{
    // recupération de la connection
    global  $connection;
    $sql =  "SELECT * FROM links
    INNER JOIN users ON users.id_user = links.id_user
    INNER JOIN articles ON articles.id_article = links.id_article
    INNER JOIN categories_articles ON categories_articles.id_cat_article = links.id_cat_article
    WHERE articles.active=1";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// fonction qui permet de récupérer les articles actifs et de les trier par titre
function liste_title_articles()
{
    // recupération de la connection
    global  $connection;
    $sql = "SELECT * FROM articles 
    WHERE active=1
    ORDER BY title_article ASC";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// fonction qui permet de clibler un article en particulier
function article_unique($id_article)
{
    // recupération de la connection
    global  $connection;
    $sql =  "SELECT *  FROM links 
    INNER JOIN articles ON articles.id_article = links.id_article
    INNER JOIN categories_articles ON categories_articles.id_cat_article = links.id_cat_article
    INNER JOIN users ON users.id_user = links.id_user
    WHERE links.id_article =$id_article";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    return $resultat;
}
// fonction qui permet de modifier un article
function modif_article($id_article, $id_cat_article, $title_article, $article)
{
    // recupération de la connection
    global  $connection;
    // Modification de l'article
    $sql = "UPDATE articles 
    SET title_article = '$title_article', article = '$article'
    WHERE id_article =$id_article";
    $sth = $connection->prepare($sql);
    $sth->execute();
    // Modification de liaisons
    $sql = "UPDATE links 
    SET id_cat_article = $id_cat_article
    WHERE id_article =$id_article";
    $sth = $connection->prepare($sql);
    $sth->execute();
    // selection de l'image pour comparaison
    $sql =  "SELECT img FROM articles 
    WHERE id_article=$id_article";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    //detruire l'image si differente
    if ($_FILES["img"]["name"] != "") {
        if ($resultat->img != $_FILES["img"]["name"]) {
            unlink("upload/" . $resultat->img);
            // recuperation du nom de l'image
            $filename = img_load_article($id_article);
        }
    }
    //update nom de l'image
    if (isset($filename)) {
        $sql = "UPDATE articles 
    SET img = '$filename'
    WHERE id_article =$id_article";
        $sth = $connection->prepare($sql);
        $sth->execute();
    }
}
//fonction qui permet de désactiver un article
function supprimer_article($id_article)
{
    // recupération de la connection
    global  $connection;
    // désactivation de l'article
    $sql = "UPDATE articles 
    SET active = 0
    WHERE id_article =$id_article";
    $sth = $connection->prepare($sql);
    $sth->execute();
    header('location: articles.php');
    exit();
}
// fonction qui permet de créer un tag
function insert_tags($id_article, $name_tag)
{
    // recupération de la connection
    global $connection;
    // insertion des tags de l'article
    $sql_ins = "INSERT INTO tags(name_tag,id_article) VALUES (:name_tag,:id_article)";
    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':name_tag' => $name_tag,
        ':id_article' => (int) $id_article
    ));
}
// fonction qui permet de modifier les tags
function modif_tags($id_article, $name_tag)
{
    // recupération de la connection
    global $connection;
    // modification des tags de l'article
    $sql =  "SELECT * FROM tags 
    WHERE id_article=$id_article";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    if ($resultat) {
        // si resultat vrai
        $sql = "UPDATE tags 
    SET name_tag = '$name_tag'
    WHERE id_article = $id_article";
        $sth = $connection->prepare($sql);
        $sth->execute();
    } else {
        // si resultat faux insertion par la fonction
        insert_tags($id_article, $name_tag);
    }
}
// recherche d'un mot dans la barre de recherche
function recherche($rechercher)
{
    // recupération de la connection
    global $connection;
    $sql =  "SELECT article,title_article  FROM links
    INNER JOIN articles ON articles.id_article = links.id_article
    INNER JOIN categories_articles ON categories_articles.id_cat_article = links.id_cat_article
    LEFT JOIN tags ON tags.id_article = articles.id_article
    WHERE article LIKE '%$rechercher%' OR title_article LIKE '%$rechercher%'";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// télécharger une image d'article
function img_load_article($id_article)
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
            if ($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");
            // Vérifie le type MIME du fichier
            if (in_array($filetype, $allowed)) {
                // Vérifie si le fichier existe avant de le télécharger.
                if (file_exists("upload/" . $_FILES["img"]["name"])) {
                    move_uploaded_file($_FILES["img"]["tmp_name"], "upload/" . $_FILES["img"]["name"]);
                } else {
                    move_uploaded_file($_FILES["img"]["tmp_name"], "upload/" . $_FILES["img"]["name"]);
                }
            } else {
                echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
            }
        } else {
            echo "Error: " . $_FILES["img"]["error"];
        }
        return @$filename;
    }
}