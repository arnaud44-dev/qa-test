<?php
//insérer un commentaire
function insert_com($comment)
{
    // récupération de la connection
    global $connection;
    @$name = $_SESSION["name"];
    @$firstname = $_SESSION["firstname"];
    // insertion dans la table articles
    $sql_ins = "INSERT INTO comments(comment,author) VALUES (:comment,:author)";
    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':comment' => "$comment",
        ':author' => "$name $firstname"
    ));
}
// sélection de l'ensemble des commentaires
function liste_com()
{
    // récupération de la connection
    global $connection;
    $sql = "SELECT * FROM comments
    WHERE active=1 ORDER BY date_creat DESC";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// selection des commentaires en attente de validation par le moderateur
function liste_com_complete()
{
    // récupération de la connection
    global $connection;
    $sql = "SELECT *,comments.comment AS com FROM comments
    WHERE comments.active = 0
    ORDER BY comments.date_creat DESC";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// fonction date qui mermet de recuperer le timelaps de phpmyadmin et de le convertir en version francaise
function frdate($date1)
{
    setlocale(LC_TIME, "fr_FR.UTF-8");
    $date1 = strftime("%A %d %b %Y", strtotime($date1));
    return $date1;
}
// validation commentaire par le moderateur
function valid_com($id_comment)
{
    // récupération de la connection
    global $connection;
    $sql = "UPDATE comments
    SET active = 1
    WHERE id_comment =$id_comment";
    $sth = $connection->prepare($sql);
    $sth->execute();
}
// suppression commentaire par le moderateur
function supprimer_com($id_comment)
{
    // récupération de la connection
    global $connection;
    $sql = "DELETE FROM comments
    WHERE id_comment = $id_comment";
    $sth = $connection->prepare($sql);
    $sth->execute();
}