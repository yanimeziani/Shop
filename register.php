<?php
include 'includes/head.php';
include 'includes/header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 gradient-1 text-light pt-1 mb-2">
            <h1 class="text-center">S'inscrire.</h1>
        </div>

        <form class="col-md-4 mx-auto mt-4" method="POST" action="connexion.php">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input type="firstname" class="form-control" id="firstname" name="firstname" placeholder="Votre prénom">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname">Nom</label>
                        <input type="lastname" class="form-control" id="lastname" name="lastname" placeholder="Votre nom">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Courriel</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Votre adresse courriel">
            </div>
            <div class="form-group mb-2">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe">
            </div>
            <div class="form-group mb-2">
                <label for="password2">Mot de passe (Confirmation)</label>
                <input type="password" class="form-control" id="password2" name="password2" placeholder="Votre mot de passe">
            </div>
            <button type="submit" class="btn btn-primary float-end">S'inscrire</button>
        </form>
    </div>
</div>

</div>

<?php
include 'includes/footer.php';
include 'includes/foot.php';
?>