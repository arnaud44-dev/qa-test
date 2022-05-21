<?php
// appel de fichiers
include "header.php";
?>
<?php
// recuperation du GET
@$id_cat_article = $_GET["id"];
// récupération des catégories d'articles
$recup_des_articles = select_cat_article($id_cat_article);
?>
<!-- titre de la catégorie de l'article-->
<div class="elevage_title">
    <h1><img class="img-fluid" src="logo/logo.png" alt="">
        <?php echo @$recup_des_articles[0]->name_cat_article; ?></h1>
</div>
<hr>
<div class="container-fluid">
    <!-- fonction qui permet de récupérer les articles -->
    <?php foreach ($recup_des_articles as $row) { ?>
        <form action="" method="post" class="dogs">
            <!-- permet d'afficher l'id_article (en mode caché) -->
            <input type="hidden" name="id_article" value="<?php echo $row->id_article; ?>" required>
            <!-- permet d'afficher l'id_cat_article (en mode caché) -->
            <input type="hidden" name="id_cat_dog" value="<?php echo $row->id_cat_article; ?>" required>
            <!-- titre de l'article -->
            <div class="article_title">
                <h3><?php echo stripslashes($row->title_article); ?></h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- image de l'article -->
                    <img class="img-fluid" src="images/<?php echo $row->img; ?>" alt="image">
                </div>
                <!-- article long -->
                <div class="col-md-6">
                    <p><?php echo stripslashes($row->article); ?></p>
                </div>
            </div>
        </form>
    <?php } ?>
</div>
<hr>
<!-- footer -->
<?php
include "footer.php"
?>