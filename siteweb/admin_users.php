<?php
// appel de fichiers
include "admin_header.php";
?>
<?php
// condition si l'utilisateur n'est pas admin est redirigé vers index.php
if ($_SESSION["level"] != 1) {
    header('Location: index.php');
}
// declaration des posts
if ($_POST) {
    @$id_user = htmlspecialchars($_POST["id_user"]);
    @$desactiver = htmlspecialchars($_POST["desactiver_user"]);
    @$activer = htmlspecialchars($_POST["activer_user"]);
    // desactivation d'un user en cliquant sur desactiver
    if ($desactiver) {
        desactive_user($id_user);
    }
    // activation d'un user en cliquant sur activer
    if ($activer) {
        activate_user($id_user);
    }
    //  Sélectionner un utilisateur
    if ($id_user) {
        $user_unique = user_unique($id_user);
    }
}
// Sélectionner tous les utilisateurs
$select_all_user = select_all_user();
?>
<div class="container user">
    <div class="row">
        <div class="col-12">
            <form action="admin_users.php" method="post" id="target" enctype="multipart/form-data" class="product1">
                <div><h2>GESTION DES UTILISATEURS</h2></div>
                <!-- selectionner un utilisateur par son nom -->
                <div>
                    <select name="id_user" id="id_user" onChange="submit()" class="form-control choice_user">
                        <option value="">Choisir un utilisateur</option>
                        <?php foreach ($select_all_user as $row) { ?>
                            <option value="<?php echo @$row->id_user; ?>" <?php if ($row->id_user == @$_POST["id_user"]) {
                                                                                echo " selected ";
                                                                            } ?>>
                                <?php echo stripslashes($row->firstname); ?> <?php echo stripslashes($row->name); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <?php if (@$id_user) { ?>
                    <!-- si l'user est sélectionné et est vrai alors tu affiches le bouton désactiver et activer -->
                    <?php if (@$user_unique->active == 1) { ?>
                        <input type="submit" class="btn btn-danger" name="desactiver_user" value="desactiver">
                    <?php } else { ?>
                        <input type="submit" class="btn btn-success" name="activer_user" value="activer">
                    <?php } ?>
                <?php } ?>
            </form>
        </div>
    </div>
</div>
<!-- footer -->
<?php
include "admin_footer.php"
?>
<!-- script de confirmation de désactivation de l'utilisateur -->
<script>
    $(document).ready(function() {
        $("#desactiver").on("click", function() {
            if (confirm("voulez-vous vraiment désactiver cet utilisateur ?")) {
                exit();
            } else {
                e.preventDefault();
                exit();
            }
        });
    });
</script>