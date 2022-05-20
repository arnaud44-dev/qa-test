<?php
// appel de fichiers
include "header.php";
?>
<?php
@$connecter = $_POST["connecter"];
@$email = htmlspecialchars($_POST["email"]);
@$password = htmlspecialchars($_POST["password"]);
// si clic sur se connecter : connexion de l'utilisateur
if ($connecter) {
    // On vérifie que la méthode POST est utilisée
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On vérifie si le champ "recaptcha-response" contient une valeur
    if(empty($_POST['recaptcha-response'])){
        header('Location: login.php');
    }else{
        // On prépare l'URL
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=6LdLAu8UAAAAAMBITxVV-HFJL_NM7pAmJNn3InpC&response={$_POST['recaptcha-response']}";

        // On vérifie si curl est installé
        if(function_exists('curl_version')){
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);
        }else{
            // On utilisera file_get_contents
            $response = file_get_contents($url);
        }

        // On vérifie qu'on a une réponse
        if(empty($response) || is_null($response)){
            header('Location: login.php');
        }else{
            $data = json_decode($response);
            if($data->success){
                if(
                    isset($_POST['email']) && !empty($_POST['email']) &&
                    isset($_POST['password']) && !empty($_POST['password'])
                ){
                    // On nettoie le contenu
                    $email = strip_tags($_POST['email']);
                    $password = strip_tags($_POST['password']);                

                    // Ici vous traitez vos données

                    echo "Message de {$email} envoyé";
                }
            }else{
                header('Location: index.php');
            }
        }
    }
}else{
    http_response_code(405);
    echo 'Méthode non autorisée';
}
    login_user(addslashes($email), addslashes($password));
}
?>
<div class="container connexion">
    <div class="row">
        <div class="col-sm-8 col-md-6 col-lg-4 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <div class="title_login">
                        <h1 class="card-title text-center">Identifiez-vous</h1>
                    </div>
                    
                    <form class="form-signin" method="POST">
                        <div class="form-label-group">
                            <input type="email" name="email" id="inputEmail" class="form-control title_login"
                                placeholder="Adresse Email" required autofocus>
                        </div>
                        <div class="form-label-group">
                            <input type="password" name="password" id="inputPassword" class="form-control title_login"
                                placeholder="Mot de passe" required>
                        </div>
                        <input type="hidden" id="recaptchaResponse" name="recaptcha-response">
                        <button id="connexion" name="connecter" value="fr" class="btn btn-lg btn-primary" type="submit">Se
                            connecter</button>
                        <?php if (isset($_GET["message"])) { ?>
                        <div>Vos identifiants ne sont pas valides</div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
<?php
include "footer.php"
?>
<script src="https://www.google.com/recaptcha/api.js?render=6LdLAu8UAAAAAMBITxVV-HFJL_NM7pAmJNn3InpC"></script>
<script>
grecaptcha.ready(function() {
    grecaptcha.execute('6LdLAu8UAAAAAMBITxVV-HFJL_NM7pAmJNn3InpC', {action: 'homepage'}).then(function(token) {
      document.getElementById("recaptchaResponse").value = token
    });
});
</script>