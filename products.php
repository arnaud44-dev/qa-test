<?php
// appel de fichiers
include "header.php";
?>
<?php
// recuperation du GET
@$id_product = $_GET['id'];
@$id_cat_product = $_GET["id_cat_product"];
@$quantity = $_GET["quantity"];
@$title_product = $_GET["title_product"];
$img = "img";
$price = "price";
$descriptive = "descriptive";
if ($_POST) {
    @$id_product = htmlspecialchars($_POST["id_product"]);
    @$ajouter_cart = htmlspecialchars($_POST["ajouter_cart"]);
    @$id_user = htmlspecialchars($_POST["id_user"]);
    @$id_cart = htmlspecialchars($_POST["id_cart"]);
    @$quantity = htmlspecialchars($_POST["quantity"]);
    @$id_payment = htmlspecialchars($_POST["id_payment"]);
    @$price = htmlspecialchars($_POST["price"]);
    @$id_tva = htmlspecialchars($_POST["id_tva"]);
    @$active = htmlspecialchars($_POST["active"]);
    // ajouter un produit au panier
    if (@$ajouter_cart) {
        insert_cart($id_cart, $id_product, $id_user, $quantity, $price);
    }
}
// récupération de produit
$recup_product = product_unique($id_product);
?>
<div class="container">
    <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <form action="" method="post" class="products text-center">
                    <!-- id_product -->
                    <input type="hidden" name="id_product" value="<?php echo $recup_product->id_product; ?>" required>
                    <!-- id_cat_product -->
                    <input type="hidden" name="id_cat_product" value="<?php echo $recup_product->id_cat_product; ?>" required>
                    <!-- id_user -->
                    <input type="hidden" name="id_user" value="<?php echo @$_SESSION['id_user']; ?>" required>
                    <!-- quantité -->
                    <input type="hidden" name="quantity" value="<?php echo $recup_product->quantity; ?>" id="quantity" class="form-control">
                    <!-- titre du produit -->
                    <div class="product_titer">
                        <h2><?php echo stripslashes($recup_product->title_product); ?></h2>
                    </div>
                    <!-- image du produit-->
                    <div>
                        <img src="upload/<?php echo $recup_product->img; ?>" class="img_product" width="225" height="225" alt="image">
                    </div>
                    <!-- prix du produit-->
                    <div class="product_price">
                        <h6>Prix (hors taxe) : </br><?php echo $recup_product->price; ?> Euros</h6>
                        <input type="hidden" name="price" value="<?php echo $recup_product->price; ?>">
                    </div>
                    <!-- description du produit-->
                    <div class="product_description">
                        <label for="">Description*</label>
                        <textarea name="descriptive" value="" id="descriptive" class="form-control" cols="30" rows="8"><?php echo stripslashes($recup_product->descriptive); ?></textarea>
                    </div>
                    <!-- si l'utilisateur est connecté il peut ajouter le produit au panier -->
                    <?php if (@$_SESSION['id_user']) { ?>
                        <button type="submit" name="ajouter_cart" value="ajouter_cart" class="btn btn-success">Panier</button>
                    <?php } else { ?>
                        <!-- s'il n'est pas connecté il doit s'inscrire pour ajouter au panier -->
                        <a href="inscription.php" target=""> <input type="button" value="S'inscrire pour payer" class="btn btn-primary"></a>
                    <?php } ?>
                </form>
            </div>
    </div>
</div>
<!-- footer -->
<?php
include "footer.php"
?>
