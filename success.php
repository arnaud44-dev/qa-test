<?php
// appel de fichiers
include "header.php";
?>
<?php
// recuperation du GET
@$id_user = $_GET['id'];
// validation du paiement
if (@$id_user) {
    insert_payment($id_user);
}
?>
<!-- footer -->
<?php
include "footer.php"
?>