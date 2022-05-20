<?php
ob_start();
// inscription d'un utilisateur
function insert_user($name, $firstname, $email, $adresse, $password_hash)
{
    // recupération de la connection
    global $connection;
    // insertion dans la table articles
    $sql = "INSERT INTO users(name, firstname,email,adresse,password,level,active) 
            VALUES (:name,:firstname,:email,:adresse,:password,:level,:active)";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':name' => $name,
        ':firstname' => $firstname,
        ':email' => $email,
        ':adresse' => $adresse,
        ':password' => $password_hash,
        ':level' => 10,
        ':active' => 1
    ));
    header('Location: login.php');
    exit();
}
// Fonction pour crypter un mot de passe
function decrypt($password)
{
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    return $password_hash;
}
//  Sélectionner un utilisateur
function select_id_user($id_user)
{
    // recupération de la connection
    global $connection;
    $sql =  "SELECT * FROM users 
    WHERE id_user='$id_user' AND active = 1";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    return $resultat;
}
// Sélectionner tous les utilisateurs
function select_all_user()
{
    // recupération de la connection
    global $connection;
    $sql =  "SELECT * FROM users 
    ORDER BY name ASC";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// vérification du login et du rôle
function login_user($email, $password)
{
    // recupération de la connection
    global  $connection;
    $sql = "SELECT * FROM users WHERE email='$email'";
    $sth = $connection->prepare($sql);
    $sth->execute();
    // $compt = $sth->rowCount();
    // if ($compt == 0) {
    //     echo "Votre login n'est pas enregistré sur ce site!";
    //     exit();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    // vérification du mot de passe 
    if ($email == $resultat->email) {
        if (password_verify($password, $resultat->password)) {
            echo "Mot de passe correct";
        } else {
            echo "Mot de passe incorrect";
            header('Location: login.php?message=true');
            exit();
        }
    } else {
        echo "Votre login est faux.";
        header('Location: login.php?message=true');
        exit();
    }
    // redirection sur les pages selon le rôle
    if ($resultat->level == 1) {
        $_SESSION["id_user"] = $resultat->id_user;
        $_SESSION["level"] = $resultat->level;
        $_SESSION["name"] = $resultat->name;
        $_SESSION["firstname"] = $resultat->firstname;
        header('Location: admin_products.php');
        exit();
        ob_end_flush();
    } else {
        $_SESSION["id_user"] = $resultat->id_user;
        $_SESSION["level"] = $resultat->level;
        $_SESSION["name"] = $resultat->name;
        $_SESSION["firstname"] = $resultat->firstname;
        header('Location: index.php');
        exit();
    }
}
// mise à jour d'un user
function update_user($id_user, $name, $firstname, $email, $adresse)
{
    // recupération de la connection
    global  $connection;
    // Modification d'un utilisateur
    $sql = "UPDATE users
    SET name = '$name', firstname = '$firstname', email = '$email', adresse = '$adresse'
    WHERE id_user =$id_user";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        ':name' => $name,
        ':firstname' => $firstname,
        ':email' => $email,
        ':adresse' => $adresse,
        ':active' => 1,
        ':level' => 10
    ));
}
/**
 * Mettre à jour un password
 */
function update_password($old_password, $new_password, $id_user)
{
    // recupération de la connection
    global  $connection;
    $crypt_pass = decrypt($new_password);
    // Modification d'un mot de passe
    $sql = "SELECT password FROM users
    WHERE users.id_user = $id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    if (password_verify($old_password, $resultat->password)) {
        $sql =  "UPDATE users
    SET  password = '$crypt_pass'
    WHERE id_user = $id_user";
        $sth = $connection->prepare($sql);
        $sth->execute();
    } else {
        echo ("mot de passe incorrect");
    }
}
/**
 * desactivation d'un user
 */
function desactive_user($id_user)
{
    // recupération de la connection
    global  $connection;
    $sql = "UPDATE users 
    SET active = 0
    WHERE id_user =$id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();
}
/**
 * desactivation d'un user
 */
function activate_user($id_user)
{
    // recupération de la connection
    global  $connection;
    $sql = "UPDATE users 
    SET active = 1
    WHERE id_user =$id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();
    header('location: users.php');
}
// recupération d'un user unique demandé par id_user
function user_unique($id_user)
{
    // recupération de la connection
    global  $connection;
    $sql =  "SELECT *  FROM users
    WHERE id_user=$id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
// Fonction pour détecter si une adresse mail a déja été insérer dans la base.
function doublon_user($email)
{
    // recupération de la connection
    global $connection;
    $sql = "SELECT * FROM users WHERE email = ?";
    $sth = $connection->prepare($sql);
    $sth->execute(array(
        $email
    ));
    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    return $resultat->email;
}
