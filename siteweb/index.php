<?php
// appel de fichiers
include "header.php";
?>
<div class="container presentation">
    <h1><img class="img-fluid golden" src="logo/logo.png " alt=""><strong> Dog Land le site dédié aux chiens</strong>
    </h1>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 accueil">
            <img src="images/wallpaper.jpg" class="img-fluid wallpaper" alt="image accueil">
        </div>
    </div>
</div>
<div class="container presentation">
    <h1><img class="img-fluid golden" src="logo/logo.png " alt=""><strong> Présentation de Dog Land</strong>
    </h1>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-6">
            <p>
                Nous vous souhaitons la bienvenue sur ces pages consacrées à notre site web DogLand.
                Nous espérons que vous y passerez un moment agréable et que vous y trouverez les renseignements
                que vous recherchez sur nos races de chiens.
                Dog Land place le bien-être animal au cœur de ses préoccupations.
                Notre conviction : un animal heureux rend son maître heureux !
                <br><br>
                Dog Land propose le meilleur à nos amis les chiens avec son site web :
                - Une nourriture pour animaux élaborée en collaboration avec les meilleurs experts vétérinaires, qu’il
                s’agisse de croquettes pour chien,
                - Des soins et produits d’hygiène répondant aux normes de qualité les plus exigeantes, pour protéger la
                santé des animaux, mais aussi de leurs maîtres,
                - Des couchages pour chien douillets et spacieux pour offrir un maximum de confort à vos compagnons de
                tous les jours,
                - Des jouets pour animaux pour tous les budgets : peluches chien, balles…
                - Ainsi que divers accessoires destinés à améliorer votre quotidien et le leur (laisses, gamelles par
                exemple).
            </p>
        </div>
        <div class="col-xs-12 col-md-12 col-lg-6">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/caroussel1.jpg" class="img-fluid d-block w-100" alt="..." width="500" height="1000">
                        <div class="carousel-caption d-none d-md-block">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/caroussel2.jpg" class="img-fluid d-block w-100" alt="..." width="500" height="1000">
                        <div class="carousel-caption d-none d-md-block">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/caroussel3.jpg" class="img-fluid d-block w-100" alt="..." width="500" height="1000">
                        <div class="carousel-caption d-none d-md-block">
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container rubrique">
    <h1><img class="img-fluid golden" src="logo/logo.png " alt=""><strong> Nos rubriques</strong>
    </h1>
</div>
<div class="container-fluid carte">
    <div class="row">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card" style="width: 22rem;">
                <img class="card-img-top" src="images/card1.jpg" alt="Card image cap">
                <div class="card-body">
                    <p>Nous vous proposons nos meilleurs produits.</p>
                    <a href="shop.php" class="btn btn-success">Boutique</a>
                </div>
            </div>
        </div>
        <div class="col-9 col-md-6 col-xl-3">
            <div class="card" style="width: 22rem;">
                <img class="card-img-top" src="images/card2.jpg" alt="Card image cap">
                <div class="card-body">
                    <p>Vous souhaitez nous écrire un commentaire.</p>
                    <a href="book.php" class="btn btn-success">Notre livre d'or</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card" style="width: 22rem;">
                <img class="card-img-top" src="images/card3.jpg" alt="Card image cap">
                <div class="card-body">
                    <p>Vous souhaitez nous contacter.</p>
                    <a href="contact.php" class="btn btn-success">Nous contacter</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card" style="width: 22rem;">
                <img class="card-img-top" src="images/card4.jpg" alt="Card image cap">
                <div class="card-body">
                    <p>Vous souhaitez vous inscrire.</p>
                    <a href="inscription.php" class="btn btn-success">Vous inscrire</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
<?php
include "footer.php"
?>