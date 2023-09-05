<?php

require_once 'db/db.php';
require_once 'class/cart.class.php';
require_once 'class/userDAO.class.php';
require_once 'class/productDAO.class.php';
require_once 'class/orderDAO.class.php';
require_once 'includes/session.php';

$cart = null;
if (isset($_SESSION["cart"])) {
    $cart = unserialize($_SESSION["cart"]);
} else {
    $cart = new Cart([]);
    $_SESSION["cart"] = serialize($cart);
    header("Location: cart.php");
    exit();
}

$cart = unserialize($_SESSION["cart"]);

$isCartEmpty = empty($cart->getCartItems());

include 'includes/head.php';
include 'includes/header.php';
?>
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col-md-12 gradient-1 text-light pt-1 mb-2">
            <h1 class="text-center">Facture</h1>
        </div>
        <div class="col-md-8 mx-auto mt-3 bg-body-tertiary p-2">
            <div class="row">
                <?php
                $cart = unserialize($_SESSION["cart"]);
                if (isset($cart) && !empty($cart)) {
                    if (!$isCartEmpty) {
                        foreach ($cart->getCartItems() as $cartItem) {
                            $product = $cartItem->getProduct();
                            $sku = $product->getSKU();
                            $name = $product->getName();
                            $price = $product->getPrice() * $cartItem->getQuantity();
                            $img = "img/" . $sku . ".jpeg";
                            $quantity = $cartItem->getQuantity();
                ?>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="<?= $img; ?>" class="img-fluid" alt="Product image">
                                    </div>
                                    <div class="col-md-10 p-5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2><?= $name; ?></h2>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <p>Quantité : <?= $quantity; ?></p>
                                                <p>Prix : <?= $price; ?>$</p>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>

                                </div>

                            </div>
                <?php
                        }
                    } else {
                        header("Location: cart.php");
                        exit();
                    }
                }
                ?>
                <div class="col-md-12 bg-dark text-light rounded p-1 mt-1">
                    <h2>Sous-Total : <span class="float-end"><?= $cart->getTotal(); ?>$</span></h2>
                    <h2>Total : <span class="float-end"><?= $cart->getTotalWithTax(); ?>$</span></h2>
                </div>

            </div>
            <?php
            if (isset($_SESSION["email"])) {
            ?>
                <a href="checkout.php" style="position: fixed; bottom: 65px;right:30px;" class="btn btn-primary btn-lg">Payer</a>
            <?php
            } else {
            ?>
                <a href="login.php" style="position: fixed; bottom: 65px;right:30px;" class="btn btn-primary btn-lg">Se connecter</a>
            <?php
            }
            ?>
        </div>
    </div>

</div>

<?php
include 'includes/footer.php';
include 'includes/foot.php';
?>