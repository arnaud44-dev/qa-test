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
    @$ajouter_cat = htmlspecialchars($_POST["ajouter_cat"]);
    // insertion d'une catégorie de produit
    if ($ajouter_cat) {
        insert_cart_product(addslashes($name_cat_product));
    }
    // recuperation de l'article par ID en le selectionnant (select sql)
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
            <form action="admin_cat_product.php" method="post" id="target" enctype="multipart/form-data" class="product1">
                <h2>CREER UNE CATEGORIE DE PRODUIT</h2>
                <!-- permet d'afficher l'id_user connecté (en mode caché) à la selection du produit -->
                <input type="hidden" name="id_user" value="<?php echo @$_SESSION["id_user"]; ?>" required>
                <!-- titre de la catégorie -->
                <div class="title_category">
                    <label for="">Entrer une catégorie*</label>
                    <input type="text" value="" name="name_cat_product" required>
                </div>
                <!-- ajouter la catégorie -->
                <input type="submit" class="btn btn-primary" name="ajouter_cat" value="Ajouter">
            </form>
        </div>
    </div>
</div>
<!-- footer -->
<?php
include "admin_footer.php"
?>