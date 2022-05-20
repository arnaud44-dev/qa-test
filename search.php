<?php
// appel de fichiers
include "header.php";
?>
<div class="container search">
    <div class="row">
        <div class="col-12">
            <?php
            // creation de variables pour la recherche d'un mot dans la barre de recherche  
            @$rechercher = htmlspecialchars($_POST["rechercher"]);
            @$mot = recherche($rechercher);
            @$searchKO = count(@$mot);
            if (!empty(@$rechercher) && @$searchKO != 0) { ?>
            <div class="search">
                <h1>VOTRE RECHERCHE</h1>
            </div>
            <div class="result_search">
                <?php
                    foreach ($mot as $row) { ?>
                <div class="title_search">
                    <!-- titre de l'article retrouvé avec le mot recherché -->
                    <strong><?php echo $row->title_article; ?></strong>
                </div>
                <!-- article retrouvé avec le mot recherché -->
                <div class="article_search">
                    <?php echo $row->article; ?>
                </div>
                <?php } ?>
            </div>
            <div class="result_search">
                <?php } else { ?>
                <div class="searchKO">
                    <h2>AUCUN ARTICLE NE CORRESPOND A VOTRE RECHERCHE</h2>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
<?php
include "footer.php"
?>
<!-- script pour mettre en surbrillance le texte recherché -->
<script>
$(document).ready(function() {
    $(".result_search").mark("<?php echo @$rechercher; ?>");
});
</script>