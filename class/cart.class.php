<?php

require_once "class/cartItem.class.php";


class Cart
{
    private $cartItems;

    public function __construct($cartItems)
    {
        $this->cartItems = $cartItems;
    }

    public function getCartItems()
    {
        return $this->cartItems;
    }

    public function getTotal()
    {
        return null;
    }

    public function getTotalQuantity()
    {
        $totalQuantity = 0;
        foreach ($this->cartItems as $cartItem) {
            $totalQuantity += $cartItem->getQuantity();
        }
        return $totalQuantity;
    }

    public function removeCartItemBySku($sku)
    {
        $updatedCartItems = array_filter($this->cartItems, function ($cartItem) use ($sku) {
            return $cartItem->getProduct()->getSKU() !== $sku;
        });

        $this->cartItems = $updatedCartItems;
    }

    public function addCartItem($cartItem)
    {
        $existingItemIndex = $this->findCartItemIndexBySku($cartItem->getProduct()->getSKU());

        if ($existingItemIndex !== -1) {
            $existingQuantity = $this->cartItems[$existingItemIndex]->getQuantity();
            $newQuantity = $existingQuantity + $cartItem->getQuantity();
            $this->cartItems[$existingItemIndex]->setQuantity($newQuantity);
        } else {

            $this->cartItems[] = $cartItem;
        }
    }

    private function findCartItemIndexBySku($sku)
    {
        foreach ($this->cartItems as $index => $cartItem) {
            if ($cartItem->getProduct()->getSKU() === $sku) {
                return $index;
            }
        }
        return -1;
    }
}
