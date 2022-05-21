<?php
// appel de fichiers
include "header.php";
?>
<?php
// recuperation du GET
@$id_cat_product = $_GET['id'];
@$id_product = htmlspecialchars($_POST["id_product"]);
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
// récupération de la catégorie de produits
$recup = select_cat_product($id_cat_product);
?>
<div class="title_products animated wobble">
    <h1>Nos <?php echo @$recup[0]->name_cat_product; ?></h1>
</div>
<div class="container-fluid">
    <div class="row">
        <?php foreach ($recup as $row) { ?>
            <div class="col-xs-12 col-md-4 col-lg-2">
                <form action="" method="post" class="products text-center">
                    <!-- id_product -->
                    <input type="hidden" name="id_product" value="<?php echo $row->id_product; ?>" required>
                    <!-- id_cat_product -->
                    <input type="hidden" name="id_cat_product" value="<?php echo $row->id_cat_product; ?>" required>
                    <!-- id_user -->
                    <input type="hidden" name="id_user" value="<?php echo @$_SESSION['id_user']; ?>" required>
                    <!-- quantité -->
                    <input type="hidden" name="quantity" value="<?php echo $row->quantity; ?>" id="quantity" class="form-control">
                    <!-- titre du produit -->
                    <div class="product_titer">
                        <h5><?php echo stripslashes($row->title_product); ?></h5>
                    </div>
                    <!-- image du produit-->
                    <div>
                        <img src="upload/<?php echo $row->img; ?>" class="img_product" width="100" height="100" alt="image">
                    </div>
                    <!-- prix du produit-->
                    <div class="product_price">
                        <h6>Prix (hors taxe) : </br><?php echo $row->price; ?> Euros</h6>
                        <input type="hidden" name="price" value="<?php echo $row->price; ?>">
                    </div>
                        <a href="products.php?id=<?php echo $row->id_product; ?>" target=""> <input type="button" value="Détail produit" class="btn btn-primary"></a>
                </form>
            </div>
        <?php } ?>
    </div>
</div>
<!-- footer -->
<?php
include "footer.php"
?>
