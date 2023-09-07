<?php

use PHPUnit\Framework\TestCase;

require_once '../class/cart.class.php';
require_once '../class/cartItem.class.php';
require_once '../class/product.class.php';
require_once '../class/user.class.php';
require_once '../class/userDAO.class.php';

class CartTest extends TestCase
{

    public function testAddCartItem()
    {
        $cart = new Cart([]);

        $product  = new Product("1", "Product", "Description", 10.00, 1);
        $cartItem = new CartItem($product, 1);
        $cart->addCartItem($cartItem);
        $this->assertCount(1, $cart->getCartItems());
    }

    public function testRemoveCartItem()
    {
        $cart = new Cart([]);

        $product  = new Product("1", "Product", "Description", 10.00, 2);
        $cartItem = new CartItem($product, 2);
        $cart->addCartItem($cartItem);

        $cart->deleteCartItemBySku($product->getSKU());

        $this->assertCount(0, $cart->getCartItems());
    }
}
