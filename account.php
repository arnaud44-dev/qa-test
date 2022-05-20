<?php
// appel de fichiers
include "header.php";
?>
<?php
// recuperation du GET
@$id_user = @$_SESSION['id_user'];
@$modifier = htmlspecialchars($_POST["modifier"]);
@$modifierPass = htmlspecialchars($_POST["modifierPass"]);
@$old_password = htmlspecialchars($_POST["old_password"]);
@$new_password = htmlspecialchars($_POST["new_password"]);
@$name = htmlspecialchars($_POST["name"]);
@$firstname = htmlspecialchars($_POST["firstname"]);
@$email = htmlspecialchars($_POST["email"]);
@$adresse = htmlspecialchars($_POST["adresse"]);
// crypt du mot de passe
$crypt_pass = decrypt($new_password);
if ($_POST) {
    @$id_user = @$_SESSION['id_user'];
    @$modifier = htmlspecialchars($_POST["modifier"]);
    @$modifierPass = htmlspecialchars($_POST["modifierPass"]);
    @$old_password = htmlspecialchars($_POST["old_password"]);
    @$new_password = htmlspecialchars($_POST["new_password"]);
    @$name = htmlspecialchars($_POST["name"]);
    @$firstname = htmlspecialchars($_POST["firstname"]);
    @$email = htmlspecialchars($_POST["email"]);
    @$adresse = htmlspecialchars($_POST["adresse"]);
    $crypt_pass = decrypt($new_password);
    // modification des coordonnées de l'utilisateur
    if ($modifier) {
        update_user(
            ($id_user),
            addslashes($name),
            addslashes($firstname),
            addslashes($email),
            addslashes($adresse)
        );
    }
    // modification du mot de passe de l'utilisateur
    if ($modifierPass) {
        update_password(
            addslashes($old_password),
            addslashes($new_password),
            ($id_user)
        );
    }
}
// selection de l'utilisateur
$select_user = select_id_user($id_user);
// affichage des transactions
$select_payment = select_id_payment($id_user);
?>
<!-- page compte de l'user connecté -->
<div class="container-fluid account">
    <h1>Vos informations de compte</h1>
    <div class="row">
        <div class="col-md-3 offset-1">
            <form method="post" action="" class="compte1">
                <h2 class="card-title text-center">Vos informations personnelles</h2>
                <div class="form-label-group">
                    <label for="inputName">Nom</label>
                    <a class="form-control"><?php echo $select_user->name; ?></a>
                </div>
                <div class="form-label-group">
                    <label for="inputFirstName">Prénom</label>
                    <a class="form-control"><?php echo $select_user->firstname; ?></a>
                </div>
                <div class="form-label-group">
                    <label for="inputEmail">Email</label>
                    <a class="form-control"><?php echo $select_user->email; ?></a>
                </div>
                <div class="form-label-group">
                    <label for="inputAdresse">Adresse</label>
                    <a class="form-control"><?php echo $select_user->adresse; ?></a>
                </div>
            </form>
        </div>
        <div class="col-md-3 offset-1">
            <form method="post" action="" class="compte2">
                <h2 class="card-title text-center">Modifier vos informations</h2>
                <div class="form-label-group">
                    <label for="inputName">Nom</label>
                    <input type="text" id="inputName" class="form-control" name="name" value="<?php echo $select_user->name; ?>"></input>
                </div>
                <div class="form-label-group">
                    <label for="inputFirstName">Prénom</label>
                    <input type="text" id="inputFirstName" class="form-control" name="firstname" value="<?php echo $select_user->firstname; ?>"></input>
                </div>
                <div class="form-label-group">
                    <label for="inputEmail">Email</label>
                    <input type="text" id="inputEmail" class="form-control" name="email" value="<?php echo $select_user->email; ?>"></input>
                </div>
                <div class="form-label-group">
                    <label for="inputAdresse">Adresse</label>
                    <input type="text" id="inputAdresse" class="form-control" name="adresse" value="<?php echo $select_user->adresse; ?>"></input>
                </div>
                <?php if (@$id_user) { ?>
                    <button name="modifier" value="modifier" class="btn btn-primary modifier" type="submit">Modifier</button>
                <?php } ?>
            </form>
        </div>
        <div class="col-md-3 offset-1">
            <form method="post" action="" class="compte3">
                <h2 class="card-title text-center">Modifier votre mot de passe</h2>
                <div class="form-label-group">
                    <label for="inputPassword">Ancien mot de passe</label>
                    <input type="password" id="inputPassword" class="form-control" name="old_password" value=""></input>
                </div>
                <div class="form-label-group">
                    <label for="inputPassword">Nouveau mot de passe</label>
                    <input type="password" id="modifierPass" class="form-control" name="new_password" value=""></input>
                </div>
                <button name="modifierPass" value="modifierPass" class="btn btn-primary modifierPass" type="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>
<!-- liste des factures -->
<div class="container-fluid account">
    <h1>Vos factures</h1>
    <table cellspacing="0" cellpadding="0" class="table_bill">
        <thead>
            <tr>
                <th>Numéro de facture</th>
                <th>Détail</th>
                <th>Date</th>
            </tr>
            <?php foreach ($select_payment as $row) { ?>
                <tr>
                    <th class="unit"><?php echo $row->id_payment ?></th>
                    <th> <a class="btn btn-primary" href="bill.php?id_payment=<?php echo $row->id_payment ?>&id_user=<?php echo $row->id_user ?>" value="">edition</th>


                    <th><?php echo $row->date_creat; ?></th>
                </tr>
            <?php } ?>
        </thead>
    </table>
</div>
<!-- footer -->
<?php
include "footer.php"
?>