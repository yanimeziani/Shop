<?php

use PHPUnit\Framework\TestCase;

require_once '../class/cart.class.php';  // Replace with the actual path to your Cart class

class CartTest extends TestCase
{

    // Test adding items to the cart
    public function testAddCartItem()
    {
        $cart = new Cart([]);

        $product  = new Product("1", "Product", "Description", 10.00, 1); // Replace with your actual Product class
        $cartItem = new CartItem($product, 2); // Replace with your actual CartItem class
        $cart->addCartItem($cartItem);

        $this->assertCount(1, $cart->getCartItems());
    }

    // Test removing items from the cart
    public function testRemoveCartItem()
    {
        $cart = new Cart([]);

        $product  = new Product("1", "Product", "Description", 10.00, 1); // Replace with your actual Product class
        $cartItem = new CartItem($product, 2); // Replace with your actual CartItem class
        $cart->addCartItem($cartItem);

        $cart->removeCartItemBySku($product->getSKU());

        $this->assertCount(0, $cart->getCartItems());
    }

    // Add more test methods for other Cart class methods as needed

}
