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
    @$id_cat_product = htmlspecialchars($_POST["id_cat_product"]);
    @$name_cat_product = htmlspecialchars($_POST["name_cat_product"]);
    @$modifier_cat = htmlspecialchars($_POST["modifier_cat"]);
    // modifier une catégorie de produit
    if ($modifier_cat) {
        update_cat_product($id_cat_product, addslashes($name_cat_product));
    }
    // recuperation du produit par ID en le selectionnant
    if ($id_cat_product) {
        $cat_product_unique = cat_product_unique($id_cat_product);
    }
}
// recuperation de la fonction des listes des categories de produits
$liste_cat_products = liste_cat_products();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="admin_modif_cat_product.php" method="post" id="target" enctype="multipart/form-data" class="product1">
                <h2>MODIFIER UNE CATEGORIE DE PRODUIT</h2>
                <!-- permet d'afficher l'id_user connecté (en mode caché) à la selection du produit -->
                <input type="hidden" name="id_user" value="<?php echo @$_SESSION["id_user"]; ?>" required>
                <!-- sélectionner une catégorie -->
                <div class="title_category">
                    <select name="id_cat_product" id="id_cat_product" class="form-control" required>
                        <option value="">Liste des catégories</option>
                        <?php foreach ($liste_cat_products as $row) { ?>
                            <option value="<?php echo $row->id_cat_product; ?>">
                                <?php echo stripslashes($row->name_cat_product); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- modifier la catégorie -->
                <div class="title_category">
                    <label for="">Nom de la catégorie*</label>
                    <input type="text" value="" name="name_cat_product" required>
                </div>
                <input type="submit" class="btn btn-warning" name="modifier_cat" value="Modifier">
            </form>
        </div>
    </div>
</div>
<!-- footer -->
<?php
include "admin_footer.php"
?>