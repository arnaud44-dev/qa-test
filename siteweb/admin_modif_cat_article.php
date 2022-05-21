<?php
// appel de fichiers
include "admin_header.php";
?>
<?php
// condition si l'utilisateur n'est pas admin est redirigé vers index.php
if ($_SESSION["level"] != 1) {
    header('Location: index.php');
}
if ($_POST) {
    @$id_cat_article = htmlspecialchars($_POST["id_cat_article"]);
    @$name_cat_article = htmlspecialchars($_POST["name_cat_article"]);
    @$modifier_cat = htmlspecialchars(@$_POST["modifier_cat"]);
    if ($modifier_cat) {
        update_cat_article($id_cat_article, addslashes($name_cat_article));
    }
    // recuperation de l'article par ID en le selectionnant
    if ($id_cat_article) {
        $article_unique = cat_article_unique($id_cat_article);
    }
}
// récupération de la liste des catégories d'articles
$liste_cat_articles = liste_cat_articles();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="admin_modif_cat_article.php" method="post" id="target" enctype="multipart/form-data" class="product1">
                <h2>MODIFIER UNE CATEGORIE D'ARTICLE</h2>
                <!-- permet d'afficher l'id_user connecté (en mode caché) à la selection du produit -->
                <input type="hidden" name="id_user" value="<?php echo @$_SESSION["id_user"]; ?>" required>
                <!-- sélectionner une catégorie -->
                <div class="title_category">
                    <select name="id_cat_article" id="id_cat_article" class="form-control" required>
                        <option value="">Liste des catégories</option>
                        <?php foreach ($liste_cat_articles as $row) { ?>
                            <option value="<?php echo $row->id_cat_article; ?>">
                                <?php echo stripslashes($row->name_cat_article); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- modifier la catégorie -->
                <div class="title_category">
                    <label for="">Nom de la catégorie d'article*</label>
                    <input type="text" value="" name="name_cat_article" required>
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
