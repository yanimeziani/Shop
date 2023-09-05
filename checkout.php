<?php
require_once 'db/db.php';
require_once 'includes/session.php';
require_once 'class/cart.class.php';
require_once 'class/userDAO.class.php';
require_once 'class/productDAO.class.php';
require_once 'class/orderDAO.class.php';
require_once 'class/orderItemDAO.class.php';

if (isset($_SESSION["cart"])) {
    $cart = unserialize($_SESSION["cart"]);
    $isCartEmpty = empty($cart->getCartItems());
    if (!$isCartEmpty) {
        // Create order items array
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
        // Create order
        $orderDAO = new OrderDAO($conn);
        $userDAO = new UserDAO($conn);
        $userID = $userDAO->getUserByEmail($_SESSION['email'])->getId();
        $orderID = $orderDAO->createOrder($userID);
        // Reduce stock in products
        $productDAO = new ProductDAO($conn);
        foreach ($items as $item) {
            $product = $productDAO->getProductBySKU($item['sku']);
            $product->setStock($product->getStock() - $item['quantity']);
            $productDAO->updateProduct($product);
        }
        //Create order items in db
        $orderItemDAO = new OrderItemDAO($conn);
        foreach ($items as $item) {
            $orderItem = new OrderItem(null, $orderID, $item['sku'], $item['quantity']);
            $orderItemDAO->create($orderItem);
        }
        // Empty cart
        unset($_SESSION["cart"]);
        // Redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
}
