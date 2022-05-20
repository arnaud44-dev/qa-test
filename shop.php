<?php
include "header.php";
?>
<h1>Notre catalogue de produits</h1>
<hr>
<?php
@$id_product = htmlspecialchars($_POST["id_product"]);
$recup_products = select_all_products();
?>
<div class="container-fluid">
    <div class="row">
        <?php foreach ($recup_products as $row) { ?>
            <div class="col-xs-12 col-md-4 col-lg-2">
                <form action="panier.php" method="post" class="products">
                    <!-- id_product -->
                    <input type="hidden" name="id_product" value="<?php echo $row->id_product; ?>" required>
                    <!-- titre du produit -->
                    <h5><?php echo $row->title_product ?></h5>
                    <!-- nom de la catégorie -->
                    <h5><?php echo $row->name_cat_product ?></h5>
                    <!-- id_category -->
                    <input type="hidden" name="id_category" value="<?php echo $row->id_cat_product; ?>" required>
                    <!-- id_user -->
                    <input type="hidden" name="id_user" value="<?php echo @$_SESSION['id_user']; ?>" required>
                    <!-- image -->
                    <img src="upload/<?php echo $row->img; ?>" class="img_product" width="100" height="100" alt="image">
                    <!-- prix du produit-->
                    <div class="product_price">
                        <h6>Prix (hors taxe) : <?php echo $row->price; ?> Euros</h6>
                        <input type="hidden" name="price" value="<?php echo $row->price; ?>">
                    </div>
                    <a href="products.php?id=<?php echo $row->id_product; ?>" target=""> <input type="button" value="Détail produit" class="btn btn-primary detail"></a>
                </form>
            </div>
        <?php } ?>
    </div>
</div>
<!-- footer -->
<?php
include "footer.php"
?>