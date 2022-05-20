<?php
// appel de fichiers
include "header.php";
?>
<?php
// recuperation des POST
@$ajouter = $_POST["ajouter"];
@$comment = $_POST["comment"];
// si clic sur ajouter insertion du commentaire 
if ($ajouter) {
    insert_com(addslashes($comment));
}
// recuperation de l'ensemble des commentaires
$recup_com = liste_com();
?>
<!-- déclaration d'un commentaire -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-6">
            <form action="book.php" method="post" class="comments">
                <div>
                    <h1>Livre d'or</h1>
                </div>
                <label for="com">Ajouter votre commentaire</label>
                <textarea name="comment" id="" class="form-control" cols="30" rows="5"></textarea>
                <input type="submit" class="btn btn-primary" name="ajouter" value="Ajouter">
            </form>
        </div>
        <!-- commentaires validés  -->
        <div class="col-12 col-lg-6">
            <form action="" method="post" class="comments">
                    <h1>Vos commentaires</h1>
                <?php foreach ($recup_com as $row) { ?>
                    <p>Le <?php echo frdate($row->date_creat); ?></p>
                    <p><?php echo stripslashes($row->comment); ?></p>
                    <p><?php echo stripslashes($row->author); ?></p>
                <?php } ?>
            </form>
        </div>
    </div>
</div>
<!-- footer -->
<?php
include "footer.php"
?>