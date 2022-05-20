<?php
// appel de fichiers
include "header.php";
?>
<?php
@$envoyer = htmlspecialchars($_POST["envoyer"]);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-6 contact2">
            <div class="adresse">
                <h1 class="mt-4 mb-3">Localisation géographique
                </h1>
            </div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Carte</a>
                </li>
            </ol>
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <!-- adresse Google Map -->
                    <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2715.1019359572115!2d-1.3381963841916522!3d47.11667372968555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4805dfc57abac54d%3A0x33b3d5590a481fd9!2s50%20La%20Huperie%2C%2044690%20Monni%C3%A8res!5e0!3m2!1sfr!2sfr!4v1580661035131!5m2!1sfr!2sfr"></iframe>
                </div>
                <!-- détail contact -->
                <div class="col-lg-4 mb-4">
                    <p>
                        50 La Huperie
                        <br>44690 MONNIERES
                    </p>
                    <p>
                        <abbr title="Phone">Télephone:</br></abbr>
                        02.05.06.07.08
                    </p>
                    <p>
                        <abbr title="Email">Email</abbr>:
                        <a href="mailto:name@example.com">contact@lahuperie.com
                        </a>
                    </p>
                    <p>
                        <abbr title="Hours">Horaires d'ouverture :</abbr></br>Du lundi au samedi: de 9:00 à 18:00
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 offset-lg-1 col-lg-5 contact2">
            <form action="contact_me.php" method="post" name="sentMessage" id="contactForm" novalidate>
                <div>
                    <h1>Contactez-nous</h1>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Nom:</label>
                        <input type="text" class="form-control" id="name" name="name" required data-validation-required-message="Entrez votre nom">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Prénom:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required data-validation-required-message="Entrez votre prénom">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required data-validation-required-message="Entrez votre adresse email">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Téléphone:</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required data-validation-required-message="Entrez votre numéro de téléphone">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Message:</label>
                        <textarea rows="10" cols="100" class="form-control" id="message" name="message" required data-validation-required-message="Entrez votre message" maxlength="999" style="resize:none"></textarea>
                    </div>
                </div>
                <div id="success"></div>
                <!-- message de succès -->
                <button type="submit" name="envoyer" value="envoyer" class="btn btn-primary" id="sendMessageButton">Envoi Message</button>
            </form>
        </div>
    </div>
</div>
<!-- footer -->
<?php
include "footer.php"
?>