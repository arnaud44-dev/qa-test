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
    @$ajouter_cat = htmlspecialchars($_POST["ajouter_cat"]);
    // insertion d'une catégorie de chien
    if ($ajouter_cat) {
        insert_cat_article(addslashes($name_cat_article));
    }
    // recuperation de l'article par ID en le selectionnant (select sql)
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
            <form action="admin_cat_article.php" method="post" id="target" enctype="multipart/form-data" class="product1">
                <h2>CREER UNE CATEGORIE D'ARTICLE</h2>
                <!-- permet d'afficher l'id_user connecté (en mode caché) à la selection du produit -->
                <input type="hidden" name="id_user" value="<?php echo @$_SESSION["id_user"]; ?>" required>
                <!-- titre de la catégorie -->
                <div class="title_category">
                    <label for="">Entrer une catégorie*</label>
                    <input type="text" value="" name="name_cat_article" required>
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