<?php

require_once 'db/db.php';
require_once 'class/cart.class.php';
require_once 'class/userDAO.class.php';
require_once 'class/productDAO.class.php';
require_once 'includes/session.php';

if (!isset($_SESSION["cart"])) {
    $cart = new Cart([]);
    $_SESSION["cart"] = serialize($cart);
}

if (isset($_POST['sku']) && !empty($_POST['sku'])) {
    $sku = intval($_POST['sku']);
    $cart = unserialize($_SESSION["cart"]);
    $productDAO = new ProductDAO($conn);
    $product = $productDAO->getProductBySKU($sku);
    $item = new CartItem($product, intval($_POST['quantity']));
    $cart->addCartItem($item);
    $_SESSION["cart"] = serialize($cart);
}

if (isset($_GET['add']) && !empty($_GET['add'])) {
    $sku = intval($_GET['add']);
    $cart = unserialize($_SESSION["cart"]);
    $productDAO = new ProductDAO($conn);
    $product = $productDAO->getProductBySKU($sku);
    $item = new CartItem($product, 1);
    $cart->addCartItem($item);
    $_SESSION["cart"] = serialize($cart);
}

if (isset($_GET['remove']) && !empty($_GET['remove'])) {
    $sku = intval($_GET['remove']);
    $cart = unserialize($_SESSION["cart"]);
    $cart->removeCartItemBySku($sku);
    $_SESSION["cart"] = serialize($cart);
}

if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $sku = intval($_GET['delete']);
    $cart = unserialize($_SESSION["cart"]);
    $cart->deleteCartItemBySku($sku);
    $_SESSION["cart"] = serialize($cart);
}

$cart = unserialize($_SESSION["cart"]);

$isCartEmpty = empty($cart->getCartItems());

include 'includes/head.php';
include 'includes/header.php';


?>
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col-md-12 gradient-1 text-light pt-1 mb-2">
            <h1 class="text-center">Panier</h1>
        </div>
        <div class="col-md-8 mx-auto mt-3">
            <table class="table rounded-1">
                <tbody>
                    <?php
                    $cart = unserialize($_SESSION["cart"]);
                    if (isset($cart) && !empty($cart)) {
                        if (!$isCartEmpty) {
                            foreach ($cart->getCartItems() as $cartItem) {
                                $product = $cartItem->getProduct();
                                $sku = $product->getSKU();
                                $stock = $product->getStock();
                                $name = $product->getName();
                                $price = $product->getPrice() * $cartItem->getQuantity();
                                $description = $product->getDescription();
                                $img = "img/" . $sku . ".jpeg";
                                $quantity = $cartItem->getQuantity();
                    ?>
                                <tr class="align-middle">
                                    <div class="row">
                                        <th scope="row align-middle"><a href="product.php?sku=<?= $sku; ?>"><img src="<?= $img; ?>" alt="" class="img-thumbnail" width="100px"></a></th>
                                        <td>
                                            <?= $name; ?>
                                        </td>
                                        <td>
                                            <?= $price; ?> $
                                        </td>
                                        <td>
                                            <a href="cart.php?remove=<?= $sku ?>"><span class="badge  bg-primary">-</span></a> <?= $quantity; ?> <a href="cart.php?add=<?= $sku ?>"><span class="badge bg-primary">+</span></a>
                                        </td>
                                        <td>
                                            <a href="cart.php?delete=<?= $sku ?>" class="btn btn-danger float-end me-2">Supprimer</a>
                                        </td>
                                    </div>

                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="col-md-12 alert alert-info text-center">
                                Le panier est vide.
                            </div>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php
            if (isset($_SESSION["email"]) && !$isCartEmpty) { // Si panier non vide et connecté
            ?>
                <a href="bill.php" style="position: fixed; bottom: 65px;right:30px;" class="btn btn-primary btn-lg">Facture</a>
            <?php
            } else if (!$isCartEmpty) { // Si panier non vide et non connecté
            ?>
                <a href="login.php" style="position: fixed; bottom: 65px;right:30px;" class="btn btn-primary btn-lg">Se connecter</a>
            <?php
            } else { // Si panier vide et non connecté
            ?>
                <a href="index.php" style="position: fixed; bottom: 65px;right:30px;" class="btn btn-primary btn-lg">Acheter</a>
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