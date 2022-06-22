<?php
ob_start();

?>
<section>
    <form action="<?=URL?>connexion/validation" method="POST">
        <div class="form-group">
            <label for="mailConnection">Adresse mail</label>
            <input type="email" class="form-control" name="mailConnection" id="mailConnection" aria-describedby="emailHelp" placeholder="Entrer votre adresse mail...">
            <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre adresse mail</small>
        </div>

        <div class="form-group">
            <label for="pwdConnection">Mot de passe</label>
            <input type="password" class="form-control" name="pwdConnection" id="pwdConnection" placeholder="Et maintenant, le mot de passe...">
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" name="rememberCheck" id="rememberCheck">
            <label class="form-check-label" for="rememberCheck">Rester connecté</label>
        </div>

        <button type="submit" name="submitConnection" class="btn btn-primary">Se connecter</button>
    </form>
</section>


<?php $title = "Formulaire de connexion";
$content = ob_get_clean();
require_once "view/template.php";
