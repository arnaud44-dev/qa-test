<?php
// appel de fichiers
include "admin_header.php";
?>
<?php
// condition si l'utilisateur n'est pas admin est redirigé vers index.php
if ($_SESSION["level"] != 1) {
    header('Location: index.php');
}
// Pour moderer les commentaires
@$id_comment = $_POST["comment"];
@$valider = $_POST["valider"];
@$supprimer = $_POST["supprimer"];
// valider un commentaire
if ($valider) {
    valid_com($id_comment);
}
// supprimer un commentaire
if ($supprimer) {
    supprimer_com($id_comment);
}
// selection des commentaires en attente de validation par le moderateur
$liste_com = liste_com_complete();
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php
            foreach ($liste_com as $row) { ?>
                <form action="admin_com.php" method="post" class="comment">
                    <h2>COMMENTAIRES EN COURS DE MODERATION</h2>
                    <!-- permet d'afficher l'id_comment en mode caché -->
                    <input type="hidden" name="comment" value="<?php echo $row->id_comment; ?>">
                    <div>
                        <p>Le <?php echo frdate($row->date_creat); ?></p>
                    </div>
                    <div>
                        <p><?php echo stripslashes($row->comment); ?></p>
                    </div>
                    <div>
                        <p><?php echo stripslashes($row->author); ?></p>
                    </div>
                    <input type="submit" class="btn btn-success" name="valider" value="Valider">
                    <input type="submit" class="btn btn-danger" name="supprimer" value="Supprimer">
                </form>
            <?php } ?>
        </div>
    </div>
</div>
<!-- footer -->
<?php
include "admin_footer.php"
?>