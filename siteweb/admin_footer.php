<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
</script>
<!-- script modal -->
<!-- script qui permet d'afficher une pop-up de désactivation du produit -->
<script>
    $(document).ready(function() {
        $("#desactiver").on("click", function() {
            if (confirm("voulez-vous vraiment désactiver ce produit ?")) {
                exit();
            } else {
                e.preventDefault();
                exit();
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        <?php
        if (@$modifier) { ?>
            $('#modif_product').modal('show');
        <?php } ?>
    });
</script>
<div class="modal fade" id="modif_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Modification Produit</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Votre produit a bien été modifié</p>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        <?php
        if (@$ajouter) { ?>
            $('#creer_product').modal('show');
        <?php } ?>
    });
</script>
<div class="modal fade" id="creer_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Création Produit</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Votre produit a bien été créé</p>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        <?php
        if (@$modifier_cat) { ?>
            $('#modif_cat').modal('show');
        <?php } ?>
    });
</script>
<div class="modal fade" id="modif_cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Modification catégorie</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Votre catégorie de produit a bien été modifiée</p>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        <?php
        if (@$ajouter_cat) { ?>
            $('#creer_cat').modal('show');
        <?php } ?>
    });
</script>
<div class="modal fade" id="creer_cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Création catégorie</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Votre catégorie de produit a bien été créée</p>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        <?php
        if (@$modifier_article) { ?>
            $('#modif_article').modal('show');
        <?php } ?>
    });
</script>
<div class="modal fade" id="modif_article" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Modification Article</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Votre article a bien été modifié</p>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        <?php
        if (@$ajouter_article) { ?>
            $('#creer_article').modal('show');
        <?php } ?>
    });
</script>
<div class="modal fade" id="creer_article" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Création Article</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Votre article a bien été créé</p>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        <?php
        if (@$modifier_cat) { ?>
            $('#modif_cat').modal('show');
        <?php } ?>
    });
</script>
<div class="modal fade" id="modif_cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Modification catégorie d'article</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Votre catégorie d'article a bien été modifiée</p>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        <?php
        if (@$ajouter_cat) { ?>
            $('#creer_cat').modal('show');
        <?php } ?>
    });
</script>
<div class="modal fade" id="creer_cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Création catégorie d'article</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Votre catégorie d'article a bien été créée</p>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
<div class="admin_footer">
</div>
<!-- footer -->
</body>

</html>