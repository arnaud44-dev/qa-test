<?php
// vérification des champs
// if (
//    empty($_POST['name'])      ||
//    empty($_POST['firstname'])      ||
//    empty($_POST['email'])     ||
//    empty($_POST['phone'])     ||
//    empty($_POST['message'])   ||
//    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
// ) {
//    echo "Données manquantes";
//    return false;
// }
$name = strip_tags(htmlspecialchars($_POST['name']));
$firstname = strip_tags(htmlspecialchars($_POST['firstname']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$to = 'arnaud.vnd@gmail.com';
$email_subject = "avane.fr:  $name";
$email_body = "Vous avez reçu un nouveau message de votre site avane.fr.\n\n". 
"Voici le détail de votre message:
\n\n Nom: $name
\n\n Prénom: $firstname
\n\n Email: $email
\n\n Téléphone: $phone
\n\n Message: $message";
$headers = "From: noreply@avane.fr\n"; 
$headers .= "Répondre à: $email";
mail($to, $email_subject, $email_body, $headers);
return  header('location: contact.php');