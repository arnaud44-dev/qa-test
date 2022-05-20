<?php
// appel de fichiers
include "header.php";
/* 
 * PayPal et database configuration 
 */
// PayPal configuration 
define('PAYPAL_ID', 'sb-6tkmg976754@business.example.com');
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
define('PAYPAL_RETURN_URL', 'https://www.projetbts.avane.fr/success.php?id=' . $_SESSION["id_user"] . '');
define('PAYPAL_CANCEL_URL', 'https://www.projetbts.avane.fr/cancel.php?id=' . $_SESSION["id_user"] . '');
// define('PAYPAL_NOTIFY_URL', 'http://localhost/paypal/ipn.php');
define('PAYPAL_CURRENCY', 'EUR');
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true) ? "https://www.sandbox.paypal.com/cgi-bin/webscr" : "https://www.paypal.com/cgi-bin/webscr");
?>
<?php
// recuperation du GET
@$id_cat_product = $_GET['id'];
@$id_user = htmlspecialchars($_POST["id_user"]);
@$id_product = htmlspecialchars($_POST["id_product"]);
@$id_cart = htmlspecialchars($_POST["id_cart"]);
@$payment_cart = htmlspecialchars($_POST["payment_cart"]);
if ($_POST) {
    @$id_user = $_SESSION["id_user"];
    @$id_product = htmlspecialchars($_POST["id_product"]);
    @$id_cart = htmlspecialchars($_POST["id_cart"]);
    @$quantity = htmlspecialchars($_POST["quantity"]);
    @$price = htmlspecialchars($_POST["price"]);
    @$id_tva = htmlspecialchars($_POST["id_tva"]);
    @$active = htmlspecialchars($_POST["active"]);
    @$id_payment = htmlspecialchars($_POST["id_payment"]);
    @$id_order = htmlspecialchars($_POST["id_order"]);
    @$payment_cart = htmlspecialchars($_POST["payment_cart"]);
    @$ajouter_cart = htmlspecialchars($_POST["ajouter_cart"]);
    @$desactive_product_cart = htmlspecialchars($_POST["desactive_product_cart"]);
    @$desactive_cart = htmlspecialchars($_POST["desactive_cart"]);
    // mise à jour d'un panier (quantité)
    if ($quantity) {
        update_cart($id_cart, $quantity);
    }
    // ajouter un produit en cliquant sur ajouter
    if (@$ajouter_cart) {
        insert_cart($id_cart, $id_product, $id_user, $quantity, $price);
    }
    // desactiver un produit en cliquant sur desactiver
    if (@$desactive_product_cart) {
        desactive_product_cart($id_user, $id_product);
    }
    // desactiver un panier en cliquant sur desactiver
    if (@$desactive_cart) {
        desactive_cart($id_user);
    }
    // paiement
    if (@$payment_cart) {
        insert_payment($id_payment, $id_user);
    }
}
// récupération de tous les produits du panier
@$recup_cart = select_cart_id_user($id_user);
?>
<?php
if (@$recup_cart == NULL) {
?>
<div class="container cart_empty">
    <h1>VOTRE PANIER EST VIDE</h1>
</div>
<?php } else { ?>
<h1>VOTRE PANIER</h1>
<div class="container panier">
    <div class="row">
        <table class="table table-striped">
            <?php foreach ($recup_cart as $row) { ?>
            <div class="col-xs-6 col-md-6 col-lg-12">
                <form action="" method="post">
                    <tr>
                        <!-- <label for="">Id cart*</label> -->
                        <input type="hidden" name="id_cart" value="<?php echo $row->id_cart; ?>">
                        <!-- <label for="">Id product*</label> -->
                        <input type="hidden" name="id_product" value="<?php echo $row->id_product; ?>">
                        <td>
                            <!-- image du produit-->
                            <img src="upload/<?php echo $row->img; ?>" class="img-fluid" width="75" height="75"
                                alt="image">
                        </td>
                        <td>
                            <!-- titre du produit -->
                            <label for="">
                                <h5>Titre du produit*</h5>
                            </label>
                            <div>
                                <h5 class="price"><?php echo stripslashes($row->title_product); ?></h5>
                            </div>
                        </td>
                        <td>
                            <!-- quantité du produit-->
                            <h5><label for="">Quantité*</label></h5>
                            <input onChange="submit()" type="number" name="quantity" min="0" max="10"
                                value="<?php echo $row->quantity; ?>" id="quantity" class="form-control quantity">
                        </td>
                        <td>
                            <!-- prix cumulé et par quantité du produit-->
                            <?php @$prixCumul +=  calcul_price($row->price, $row->quantity, "20") ?>
                            <?php @$prixForQuantity =  calcul_price($row->price, $row->quantity, "20") ?>
                            <label for="">
                                <h5>Prix (taxe comprise)</h5>
                            </label>
                            <h5 class="price"><?php echo $prixForQuantity ?> Euros</h5>
                        </td>
                        <td>
                            <!-- si le panier est sélectionné et est vrai alors tu affiches le bouton annulation et paiement -->
                            <?php if (@$_SESSION['id_user']) { ?>
                            <!-- annulation panier -->
                            <button type="submit" name="desactive_product_cart" value="desactive_product_cart"
                                class="trash"><i class="fas fa-trash"></i></button>
                            <?php } ?>
                        </td>
                    </tr>
                </form>
            </div>
            <?php } ?>
            <div class="col-xs-6 col-md-6 col-lg-12">
                <tr>
                    <td>
                    </td>
                    <td>
                        <!-- prix total du panier -->
                        <h5><label for="">Prix total du panier*</label></h5>
                    </td>
                    <td>
                    </td>
                    <td>
                        <h5 class="price"><?php echo @$prixCumul; ?> Euros</h5>
                    </td>
                    <td colspan="1">
                        <!-- Paiement PayPal -->
                        <form action="<?php echo PAYPAL_URL; ?>" method="post">
                            <!-- Identify your business so that you can collect the payments. -->
                            <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
                            <!-- Specify a Buy Now button. -->
                            <input type="hidden" name="cmd" value="_xclick">
                            <!-- Specify details le nom de la personne. -->
                            <input type="hidden" name="item_name" value="<?php echo @$_SESSION['firstname']; ?>">
                            <!-- Si IPN retour id_user -->
                            <input type="hidden" name="item_number" value="<?php echo @$_SESSION['id_user']; ?>">
                            <!-- Somme a envoyer a Paypal -->
                            <input type="hidden" name="amount" value="<?php echo @$prixCumul; ?>">
                            <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
                            <!-- Specify URLs -->
                            <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                            <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                            <!-- <input type="hidden" name="notify_url" value="<?php // echo PAYPAL_NOTIFY_URL; 
                                                                                    ?>"> -->
                            <?php if (@$_SESSION['id_user']) { ?>
                            <!-- Display the payment button. -->
                            <div class="checkbox"> <label for="NWSL_RGPD"> <input type="checkbox" id="NWSL_RGPD"
                                    name="NWSL_RGPD" value="" required=""> 
                            <span>Oui j’accepte les <a class="popup" href="cgv.php" target="_blank">CGV</a>
                                Retrouvez la <a class="popup" href="rgpd.php" target="_blank">politique de
                                    gestion de mes données personnelles</a> de zooplus.</span>
                            </div>
                            <button type="submit" name="payment_cart" value="" class="btn btn-primary">PayPal</button>
                            <?php } ?>
                        </form>
                    </td>
                </tr>
            </div>
        </table>
    </div>
</div>
<?php } ?>
<!-- footer -->
<?php
include "footer.php"
?>