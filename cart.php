<?php

require_once 'db/db.php';
require_once 'class/cart.class.php';
require_once 'class/userDAO.class.php';
require_once 'class/productDAO.class.php';
require_once 'includes/session.php';
// Create cart if not created
if (!isset($_SESSION["cart"])) {
    $cart = new Cart([]);
    $_SESSION["cart"] = serialize($cart);
}
// Add item to cart
if (isset($_POST['quantity']) && isset($_POST['sku'])) {
    $quantity = $_POST['quantity'];
    $sku = $_POST['sku'];
    $productDAO = new ProductDAO($conn);
    $product = $productDAO->getProductBySKU(intval($sku));
    $cartItem = new CartItem($product, intval($quantity));
    $cart = unserialize($_SESSION["cart"]);
    $cart->addCartItem($cartItem);
    $_SESSION["cart"] = serialize($cart);
}
// Remove item from cart
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $sku = intval($_GET['delete']);
    $cart = unserialize($_SESSION["cart"]);
    $cart->removeCartItemBySku($sku);
    $_SESSION["cart"] = serialize($cart);
}

include 'includes/head.php';
include 'includes/header.php';


?>
<div class="container-fluid mb-5">
    <div class="row">
        <div class="col-md-12 gradient-1 text-light pt-1 mb-2">
            <h1 class="text-center">Panier</h1>
        </div>
        <div class="col-md-8 mx-auto mt-3">
            <form action="cart.php" method="POST">
                <table class="table rounded-1">
                    <tbody>
                        <?php
                        $cart = unserialize($_SESSION["cart"]);
                        if (isset($cart) && !empty($cart)) {
                            foreach ($cart->getCartItems() as $cartItem) {
                                $product = $cartItem->getProduct();
                                $sku = $product->getSKU();
                                $stock = $product->getStock();
                                $name = $product->getName();
                                $price = $product->getPrice();
                                $description = $product->getDescription();
                                $img = "img/" . $sku . ".jpeg";
                                $quantity = $cartItem->getQuantity();
                        ?>
                                <tr class="align-middle">
                                    <div class="row">
                                        <th scope="row"><img src="<?= $img; ?>" alt="" class="img-thumbnail" width="200px"></th>
                                        <td>
                                            <?= $name; ?>
                                        </td>
                                        <td>
                                            Quantité: <input class="rounded ms-2" type="number" name="quantity" id="quantity" value="<?= $quantity; ?>" style="width: 50px;" min="1" max="<?= $stock; ?>">
                                        </td>
                                        <td>
                                            Disponible : <span class="badge bg-primary"><?= $stock; ?></span>
                                        </td>
                                        <td>
                                            <a href="product.php?sku=<?= $sku; ?>" class="btn btn-light float-end me-2">Voir l'item</a>
                                            <a href="cart.php?delete=<?= $sku ?>" class="btn btn-danger float-end me-2">Supprimer</a>
                                        </td>
                                    </div>

                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <input style="position: fixed; bottom: 50px;right:30px;" class="btn btn-primary btn-lg float-end" type="submit" value="Acheter ">
            </form>
        </div>
    </div>
</div>

</div>

<?php
include 'includes/footer.php';
include 'includes/foot.php';
?>