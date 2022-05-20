<?php
// appel de fichiers
include "admin_header.php";
?>
<?php
// condition si l'utilisateur n'est pas admin est redirigé vers index.php
if ($_SESSION["level"] != 1) {
    header('Location: index.php');
}
// recuperation de la fonction des listes des categories d'articles
@$liste_cat_articles = liste_cat_articles();
// declaration des posts
if ($_POST) {
    @$img = $_FILES;
    @$id_user = htmlspecialchars($_POST["id_user"]);
    @$id_article = htmlspecialchars($_POST["id_article"]);
    @$id_cat_article = htmlspecialchars($_POST["id_cat_article"]);
    @$name_cat_article = htmlspecialchars($_POST["name_cat_article"]);
    @$title_article = htmlspecialchars($_POST["title_article"]);
    @$article = htmlspecialchars($_POST["article"]);
    @$name_tag = htmlspecialchars($_POST["name_tag"]);
    @$comment = htmlspecialchars($_POST["comment"]);
    @$active = htmlspecialchars($_POST["active"]);
    @$ajouter_article = htmlspecialchars($_POST["ajouter_article"]);
    // ajouter un article en cliquant sur ajouter et protege l'entrée d'un article
    if (@$ajouter_article) {
        insert_article(
            addslashes($title_article),
            addslashes($article),
            $id_cat_article,
            $id_user,
            addslashes($comment)
        );
        // insertion d'un tag à l'ajout d'article
        insert_tags(
            $id_article,
            addslashes($name_tag)
        );
    }
    // recuperation de l'article par ID en le selectionnant (select sql)
    if (@$id_article) {
        $article_unique = article_unique($id_article);
    }
}
// recuperation de la fonction qui permet d'afficher le titre de l'article
$liste_title_articles = liste_title_articles();
?>
<!-- page admin pour entrer un article -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Formulaire permettant de créer un article par son titre, sa catégorie -->
            <form action="admin_articles.php" method="post" id="target" enctype="multipart/form-data" class="product1">
                <h2>CREER UN ARTICLE</h2>
                <!-- permet d'afficher l'id_user connecté (en mode caché) à la selection de l'article -->
                <input type="hidden" name="id_user" class="form-control" value="<?php echo @$_SESSION["id_user"]; ?>">
                <!-- entrer un nouvel article / affichage du titre de l'article -->
                <div class="title_article">
                    <label for="">Titre de l'article*</label>
                    <input type="text" value="" name="title_article" required>
                </div>
                <!-- selectionner une categorie pour l'article-->
                <div>
                    <select name="id_cat_article" id="id_cat_article" class="form-control title_article" required>
                        <option value="">Liste des catégories</option>
                        <?php foreach ($liste_cat_articles as $row) { ?>
                            <option value="<?php echo $row->id_cat_article; ?>">
                                <?php echo stripslashes($row->name_cat_article); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- affichage de l'article -->
                <div class="article">
                    <label for="">Article*</label>
                    <textarea name=" article" id="article" class="form-control editor" cols="30" rows="10"></textarea>
                </div>
                <!-- affichage des tags à la selection de l'article -->
                <div class="tags">
                    <label for="">Tags</label>
                    <input type=" text" class="form-control" value="" name="tags">
                </div>
                <!-- permet d'upload l'image -->
                <div class="image_article">
                    <label for="">Image*</label>
                    <input type="file" name="img">
                </div>
                <div class="image_article">
                    <img width="100" src="upload/" alt="">
                </div>
                <!-- si l'article est sélectionné et est vrai alors tu affiches le bouton modifier et supprimer -->
                <input type="submit" class="btn btn-primary" name="ajouter_article" value="Ajouter">
            </form>
        </div>
    </div>
</div>
<!-- footer -->
<?php
include "admin_footer.php";
?>
<!-- script jodit -->
<script>
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var editor = new Jodit('.editor2', {
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
<!-- script qui permet d'afficher une pop-up de suppression du commentaire -->
<script>
    $(document).ready(function() {
        $("#supprimer").on("click", function() {

            if (confirm("voulez-vous vraiment supprimer le commentaire ?")) {
                exit();
            } else {
                e.preventDefault();
                exit();
            }
        });
    });
</script>