<?php

require_once 'db/db.php';
require_once 'class/userDAO.class.php';
require_once "includes/session.php";

include 'includes/head.php';
include 'includes/header.php';

$error = "";
if (isset($_POST["email"]) && isset($_POST["password"])) {
    if (!empty(trim($_POST["email"])) && !empty($_POST["password"])) {
        $userDAO = new UserDAO($conn);
        $user = $userDAO->getUserByEmail($_POST["email"]);
        if ($user) {
            if (password_verify($_POST["password"], $user->getPassword())) {
                $_SESSION["user"] = $user;
                header("Location: index.php");
                $_SESSION["email"] = $user->getEmail();
            } else {
                $error = "Le mot de passe est incorrect.";
            }
        } else {
            $error = "L'adresse courriel n'existe pas.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 gradient-1 text-light pt-1">
            <h1 class="text-center">Se connecter</h1>
        </div>

        <?php if (strlen($error) > 0) { ?>
            <div class='col-md-12 alert alert-danger text-center'><?php echo $error; ?></div>
        <?php } ?>

        <form class="col-md-4 mx-auto mt-4" method="POST" action="login.php">
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

<?php
include 'includes/footer.php';
include 'includes/foot.php';
?>