<?php
include 'db/db.php';
include 'includes/head.php';
include 'includes/header.php';
include 'includes/userDAO.class.php';
$error = "";
// Inscription
if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password2"]) && isset($_POST["address"])) {
    $userDAO = new UserDAO($conn);
    if (!$userDAO->userExists($_POST["email"])) {
        if ($_POST["password"] == $_POST["password2"]) {
            $userDAO = new UserDAO($conn);
            $user = new User(null, $_POST["email"], $_POST["password"], $_POST["firstname"], $_POST["lastname"], $_POST["address"]);
            $userDAO->createUser($user);
            header("Location: connexion.php");
        } else {
            $error = "Les mots de passe ne correspondent pas.";
        }
    } else {
        $error = "L'adresse courriel existe déjà.";
    }
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 gradient-1 text-light pt-1">
            <h1 class="text-center">S'inscrire.</h1>
        </div>
        <?php if (strlen($error) > 0) { ?>
            <div class='col-md-12 alert alert-danger text-center'><?php echo $error; ?></div>
        <?php } ?>
        <form class="col-md-4 mx-auto mt-4" method="POST" action="register.php">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input type="firstname" class="form-control" id="firstname" name="firstname" placeholder="Votre prénom" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname">Nom</label>
                        <input type="lastname" class="form-control" id="lastname" name="lastname" placeholder="Votre nom" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Courriel</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Votre adresse courriel" required>
            </div>
            <div class="form-group mb-2">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe" required>
            </div>
            <div class="form-group mb-2">
                <label for="password2">Mot de passe (Confirmation)</label>
                <input type="password" class="form-control" id="password2" name="password2" placeholder="Votre mot de passe" required>
            </div>
            <div class="form-group mb-2">
                <label for="address">Adresse</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Votre adresse" required>
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