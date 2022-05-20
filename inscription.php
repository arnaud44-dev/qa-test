<?php
// appel de fichiers
include "header.php";
?>
<?php
// recuperation des POST
@$enregistrer = htmlspecialchars($_POST["enregistrer"]);
@$name = htmlspecialchars($_POST["name"]);
@$firstname = htmlspecialchars($_POST["firstname"]);
@$adresse = htmlspecialchars($_POST["adresse"]);
@$email = htmlspecialchars($_POST["email"]);
@$password = htmlspecialchars($_POST["password"]);
@$active = 1;
@$password_hash = decrypt($password);
@$doublon = doublon_user($email);
// si clic sur s'enregistrer : insertion de l'user
if ($enregistrer) {
    if ($email == $doublon) {
        echo "<h2>Utilisateur déjà existant !</h2>";
    } else {
        insert_user(addslashes($name), addslashes($firstname), addslashes($email), addslashes($adresse), $password_hash, $active);
        echo "Utilisateur enregistré !";
        header('Location: index.php');
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <div class="title_inscription">
                        <h1 class="card-title text-center">S'inscrire</h1>
                    </div>
                    <form class="form-signin" method="post" action="inscription.php">
                        <div class="form-label-group">
                            <input type="text" id="name" name="name" class="form-control title_inscription"
                                placeholder="Nom" required autofocus>
                        </div>
                        <div class="form-label-group">
                            <input type="text" id="inputFirstName" name="firstname"
                                class="form-control title_inscription" placeholder="Prénom" required autofocus>
                        </div>
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" name="email" class="form-control title_inscription"
                                placeholder="Email" required autofocus>
                        </div>
                        <div class="form-label-group">
                            <input type="text" id="inputAdresse" name="adresse" class="form-control title_inscription"
                                placeholder="Adresse" required autofocus>
                        </div>
                        <div class="form-label-group">
                            <input type="password" id="inputPassword" name="password"
                                class="form-control title_inscription" placeholder="Mot de passe" required>
                        </div>
                        <div class="checkbox"> <label for="NWSL_RGPD"> <input type="checkbox" id="NWSL_RGPD"
                                    name="NWSL_RGPD" value="" required=""> Je
                                reconnais avoir consulté et accepte la <u><a
                                        href="rgpd.php"
                                        target="_blank">politique de confidentialité</a></u> des données de Dog Land*
                         </div>
                        <button id="btn-inscription" name="enregistrer" value="en" class="btn btn-lg btn-primary"
                            type="submit">S'enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
<?php
include "footer.php"
?>
