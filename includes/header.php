<nav class="navbar navbar-expand-md navbar-light bg-light px-5">
    <a class="navbar-brand" href="index.php"><img src="img/logo.svg" alt="Logo" style="width: 200px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                        <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                    </svg> Produits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    Panier
                    <span class="badge bg-danger rounded-circle">
                        <?php
                        include_once "includes/session.php";
                        require_once "db/db.php";
                        require_once "class/cart.class.php";
                        if (isset($_SESSION["cart"])) {
                            $cart = unserialize($_SESSION["cart"]);
                            echo $cart->getTotalQuantity();
                        } else {
                            echo "0";
                        }
                        ?>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <div class="dropdown nav-link">
                    <a class="btn btn-md btn-dark dropdown-toggle border-0" href="#" role="button" id="accountMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                        </svg>
                        <?php
                        require_once "class/userDAO.class.php";
                        if (isset($_SESSION["email"])) {
                            $userDAO = new UserDAO($conn);
                            $user = $userDAO->getUserByEmail($_SESSION["email"]);
                            echo $user->getFirstName();
                        } else {
                            echo "Compte";
                        }
                        ?>
                    </a>
                    <?php
                    if (isset($_SESSION["email"])) {
                    ?>
                        <ul class="dropdown-menu" aria-labelledby="accountMenu">
                            <li><a class="dropdown-item" href="disconnect.php">Déconnecter</a></li>
                        </ul>
                    <?php
                    } else {
                    ?>
                        <ul class="dropdown-menu" aria-labelledby="accountMenu">
                            <li><a class="dropdown-item" href="login.php">Se connecter</a></li>
                            <li><a class="dropdown-item" href="signup.php">S'inscrire</a></li>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </li>

        </ul>
    </div>

</nav>