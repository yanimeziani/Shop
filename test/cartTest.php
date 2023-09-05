<?php

use PHPUnit\Framework\TestCase;
require_once 'class\cart.class.php';  // Replace with the actual path to your Cart class

class CartTest extends TestCase {
    
    // Test adding items to the cart
    public function testAddCartItem() {
        // Create a Cart instance
        $cart = new Cart([]);
        
        // Create a mock Product object
        $mockProduct = $this->getMockBuilder('Product') // Replace with your actual Product class
                            ->disableOriginalConstructor()
                            ->getMock();
        
        // Add the mock Product to the cart
        $cartItem = new CartItem($mockProduct, 2); // Replace with your actual CartItem class
        $cart->addCartItem($cartItem);
        
        // Perform assertions to check if the item was added correctly
        $this->assertCount(1, $cart->getCartItems());
        // Add more assertions as needed
    }

    // Test removing items from the cart
    public function testRemoveCartItem() {
        // Create a Cart instance
        $cart = new Cart([]);
        
        // Create a mock Product object
        $mockProduct = $this->getMockBuilder('Product') // Replace with your actual Product class
                            ->disableOriginalConstructor()
                            ->getMock();
        
        // Add a mock Product to the cart
        $cartItem = new CartItem($mockProduct, 2); // Replace with your actual CartItem class
        $cart->addCartItem($cartItem);
        
        // Remove the mock Product from the cart
        $cart->removeCartItemBySku($mockProduct->getSKU());
        
        // Perform assertions to check if the item was removed correctly
        $this->assertCount(0, $cart->getCartItems());
        // Add more assertions as needed
    }

    // Add more test methods for other Cart class methods as needed

}
