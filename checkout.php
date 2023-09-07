<?php
require_once 'db/db.php';
require_once 'includes/session.php';
require_once 'class/cart.class.php';
require_once 'class/userDAO.class.php';
require_once 'class/productDAO.class.php';
require_once 'class/orderDAO.class.php';
require_once 'class/orderItemDAO.class.php';
if (isset($_SESSION["email"])) {
    if (isset($_SESSION["cart"])) {
        $cart = unserialize($_SESSION["cart"]);
        $isCartEmpty = empty($cart->getCartItems());
        if (!$isCartEmpty) {
            $items = [];
            foreach ($cart->getCartItems() as $cartItem) {
                $product = $cartItem->getProduct();
                $sku = $product->getSKU();
                $quantity = $cartItem->getQuantity();
                $items[] = [
                    'sku' => $sku,
                    'quantity' => $quantity
                ];
            }
            $orderDAO = new OrderDAO($conn);
            $userDAO = new UserDAO($conn);
            $userID = $userDAO->getUserByEmail($_SESSION['email'])->getId();
            $orderID = $orderDAO->createOrder($userID);
            $productDAO = new ProductDAO($conn);
            foreach ($items as $item) {
                $product = $productDAO->getProductBySKU($item['sku']);
                $product->setStock($product->getStock() - $item['quantity']);
                $productDAO->updateProduct($product);
            }
            $orderItemDAO = new OrderItemDAO($conn);
            foreach ($items as $item) {
                $orderItem = new OrderItem(null, $orderID, $item['sku'], $item['quantity']);
                $orderItemDAO->create($orderItem);
            }
            unset($_SESSION["cart"]);
            header("Location: index.php?message=Votre commande a été passée avec succès!");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    }
} else {
    header("Location: index.php?message=Veuillez vous connecter pour passer une commande!");
    exit();
}
