<?php
// appel de fichiers
include "admin_header.php";
?>
<?php
// condition si l'utilisateur n'est pas admin est redirigé vers index.php
if ($_SESSION["level"] != 1) {
    header('Location: index.php');
}
// recuperation de la fonction qui permet d'afficher la liste de catégorie de produits
$liste_cat_products = liste_cat_products();
// déclaration des variables en Post
if ($_POST) {
    @$img = $_FILES;
    @$id_user = htmlspecialchars($_POST["id_user"]);
    @$id_product = htmlspecialchars($_POST["id_product"]);
    @$id_cat_product = htmlspecialchars($_POST["id_cat_product"]);
    @$name_cat_product = htmlspecialchars($_POST["name_cat_product"]);
    @$title_product = htmlspecialchars($_POST["title_product"]);
    @$quantity = htmlspecialchars($_POST["quantity"]);
    @$price = htmlspecialchars($_POST["price"]);
    @$descriptive = htmlspecialchars($_POST["descriptive"]);
    @$id_tva = htmlspecialchars($_POST["id_tva"]);
    @$active = htmlspecialchars($_POST["active"]);
    @$desactiver = htmlspecialchars($_POST["desactiver"]);
    @$modifier = htmlspecialchars(@$_POST["modifier"]);
    @$activer = htmlspecialchars($_POST["activer"]);
    // desactivation d'un produit en cliquant sur desactiver
    if ($desactiver) {
        desactive_product($id_product);
    }
    // activation d'un produit en cliquant sur activer
    if ($activer) {
        activate_product($id_product);
    }
    // modifier l'article en cliquant sur modifier et protege les produits 
    if ($modifier) {
        update_product(
            $id_product,
            addslashes($title_product),
            $quantity,
            $price,
            addslashes($descriptive),
            $id_cat_product
        );
    }
    // recuperation de l'article par ID en le selectionnant (select sql)
    if ($id_product) {
        $product_unique = product_unique($id_product);
    }
}
// recuperation de la fonction qui permet d'afficher le titre du produit
$liste_title_product = liste_title_product();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="admin_modif_products.php" method="post" id="target" enctype="multipart/form-data" class="product1">
                <h2>MODIFIER UN PRODUIT</h2>
                <!-- permet d'afficher l'id_user connecté (en mode caché) à la selection du produit -->
                <input type="hidden" name="id_user" value="<?php echo @$_SESSION["id_user"]; ?>" required>
                <!-- selectionner un produit déjà existant dans la base par son titre -->
                <div class="title_product">
                    <select name="id_product" id="id_product" onChange="submit()" class="form-control title_product">
                        <option value="">Liste des produits</option>
                        <?php foreach ($liste_title_product as $row) { ?>
                            <option value="<?php echo @$row->id_product; ?>" <?php if ($row->id_product == @$_POST["id_product"]) {
                                                                                    echo " selected ";
                                                                                } ?>>
                                <?php echo stripslashes($row->title_product); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- entrer un nouveau produit / titre du produit -->
                <div class="title_product">
                    <label for="">Nouveau nom du produit</label>
                    <input type="text" value="" name="title_product">
                </div>
                <!-- sélectionner un produit par sa catégorie -->
                <div class="title_product">
                    <select name="id_cat_product" id="id_cat_product" class="form-control" required>
                        <option value="">Liste des catégories de produits</option>
                        <?php foreach ($liste_cat_products as $row) { ?>
                            <option value="<?php echo $row->id_cat_product; ?>" <?php if ($row->id_cat_product == @$product_unique->id_cat_product) {
                                                                                    echo " selected ";
                                                                                } ?>>
                                <?php echo stripslashes($row->name_cat_product); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- quantité du produit -->
                <div>
                    <label for="">Quantité*</label>
                    <input type="number" name="quantity" value="<?php echo @$product_unique->quantity; ?>" id="quantity" class="form-control">
                </div>
                <!-- prix du produit -->
                <div>
                    <label for="">Prix (Euros)*</label>
                    <input type="number" name="price" value="<?php echo @$product_unique->price; ?>" id="prix" class="form-control">
                </div>
                <!-- description -->
                <div class="descriptive">
                    <label for="">Description*</label>
                    <textarea name="descriptive" value="" class="form-control editor" cols="30" rows="10"><?php echo stripslashes(@$product_unique->descriptive); ?></textarea>
                </div>
                <!-- permet d'upload l'image -->
                <div class="image_article">
                    <label for="">Image*</label>
                    <input type="file" name="img">
                </div>
                <div class="image_article">
                    <img width="100" src="upload/<?php echo @$product_unique->img; ?> " alt="">
                    <?php echo @$product_unique->img; ?>
                </div>
                <!-- si le produit est sélectionné et est vrai alors tu affiches le bouton modifier et supprimer -->
                <?php if (@$id_product) { ?>
                    <input type="submit" class="btn btn-warning" name="modifier" value="Modifier">
                    <?php if (@$product_unique->active == 1) { ?>
                        <input type="submit" class="btn btn-danger" name="desactiver" value="Desactiver">
                    <?php } else { ?>
                        <input type="submit" class="btn btn-primary" name="activer" value="Activer">
                    <?php } ?>
                <?php } ?>
            </form>
        </div>
    </div>
</div>
<!-- footer -->
<?php
include "admin_footer.php"
?>
<!-- script jodit -->
<script>
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var editor = new Jodit('.editor', {
        uploader: {
            url: baseUrl + '/connector/index.php?action=fileUpload'
        },
        filebrowser: {
            ajax: {
                url: baseUrl + '/connector/index.php'
            }
        },
        "buttons": "|,source,bold,strikethrough,underline,italic,|,ul,ol,|,outdent,indent,|,font,fontsize,brush,paragraph,|,image,table,link,|,align,undo,redo,\n,hr,eraser,copyformat,|,symbol"
    });
</script>
