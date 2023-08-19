<?php
include 'includes/head.php';
include 'includes/header.php';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 gradient-1 text-light pt-1 mb-2">
            <h1 class="text-center">Se connecter.</h1>
        </div>

        <form class="col-md-4 mx-auto mt-4" method="POST" action="connexion.php">
            <div class="form-group">
                <label for="email">Courriel</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Adresse courriel">
            </div>
            <div class="form-group mb-2">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
            </div>
            <button type="submit" class="btn btn-primary float-end">Se connecter</button>
        </form>
    </div>
</div>

</div>

<?php
include 'includes/footer.php';
include 'includes/foot.php';
?>