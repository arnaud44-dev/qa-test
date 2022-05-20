<?php
// appel de fichiers
include "header.php";
?>
<div>
<h1>Votre facture</h1>
</div>
<div>
    <form>
        <input id="impression" name="impression" type="button" onclick="imprimer_page()" value="Imprimer cette page" />
    </form>
</div>
<?php
// recuperation du GET
$id_user = $_GET["id_user"];
$id_payment = $_GET["id_payment"];
$select_id_user = user_unique($id_user);
$select_id_payment = select_id_payment_bill($id_user, $id_payment);
if (isset($select_id_payment)) {
    foreach ($select_id_payment as $row) {
        @$prixForQuantity += $row->price;
    }
}
$prixttc = ($prixForQuantity * (1.2));
?>
<div class="container invoice">
    <?php foreach ($select_id_user as $row) { ?>

        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">Facture au nom de :</div>
                <div class="name">Nom : <?php echo $row->name; ?></div>
                <div class="address">Adresse : <?php echo $row->adresse; ?></div>
                <div class="email">Email : <a href=""><?php echo $row->email; ?></a></div>
            </div>
        </div>
    <?php } ?>
    <?php foreach ($select_id_payment as $row) { ?>
        <div id="invoice">
            <div class="date">Date de facture :<?php echo $row->date_creat; ?></div>
        </div>
        <table cellspacing="0" cellpadding="0" class="table_bill">
            <thead>
                <tr>
                    <th>PRODUIT</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>PRIX</th>
                    <th>QUANTITE</th>
                </tr>
                <tr>
                    <th class="unit"><?php echo $row->title_product; ?></th>
                    <th class="unit"></th>
                    <th></th>
                    <th></th>
                    <th class="price"><?php echo $row->price; ?></th>
                    <th class="qty"><?php echo $row->quantity; ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="2">TOTAL(sans TVA)</td>
                    <td></td>
                    <td></td>
                    <!-- prix cumulé et par quantité du produit sans TVA-->
                    <td><?php echo $prixForQuantity ?> Euros</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">TOTAL(TVA)</td>
                    <td></td>
                    <td></td>
                    <!-- prix cumulé et par quantité du produit avec TVA-->
                    <td><?php echo $prixttc ?> Euros</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
</div>
<?php } ?>
<!-- footer -->
<?php
include "footer.php"
?>
<script type="text/javascript">
    function imprimer_page() {
        window.print();
    }
</script>