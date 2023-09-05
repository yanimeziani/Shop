<?php

declare(strict_types=1);
include_once "db/db.php";
include_once "class/cartItem.class.php";
include_once "class/productDAO.class.php";

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
        $total = 0;
        foreach ($this->cartItems as $cartItem) {
            $total += $cartItem->getTotal();
        }
        return $total;
    }

    public function getTotalWithTax()
    {
        return round($this->getTotal() * 1.15, 2);
    }

    public function getTotalQuantity()
    {
        $totalQuantity = 0;
        foreach ($this->cartItems as $cartItem) {
            $totalQuantity += $cartItem->getQuantity();
        }
        return $totalQuantity;
    }

    public function deleteCartItemBySku(int $sku)
    {
        $updatedCartItems = array_filter($this->cartItems, function ($cartItem) use ($sku) {
            return $cartItem->getProduct()->getSKU() !== $sku;
        });

        $this->cartItems = $updatedCartItems;
    }

    public function removeCartItemBySku(int $sku)
    {
        foreach ($this->cartItems as $cartItem) {
            if ($cartItem->getProduct()->getSKU() === $sku) {
                $quantity = $cartItem->getQuantity();

                if ($quantity > 1) {
                    $cartItem->setQuantity($quantity - 1);
                } else {
                    $this->deleteCartItemBySku($sku);
                }

                return; // Stop the loop after handling one item
            }
        }
    }




    public function addCartItem(CartItem $cartItem)
    {
        $existingItemIndex = $this->findCartItemIndexBySku($cartItem->getProduct()->getSKU());

        $productStock = $cartItem->getProduct()->getStock();
        $requestedQuantity = $cartItem->getQuantity();

        if ($existingItemIndex !== -1) {
            $existingQuantity = $this->cartItems[$existingItemIndex]->getQuantity();
            $newQuantity = $existingQuantity + $requestedQuantity;

            if ($newQuantity <= $productStock) {
                $this->cartItems[$existingItemIndex]->setQuantity($newQuantity);
            }
        } else {
            if ($requestedQuantity <= $productStock) {
                $this->cartItems[] = $cartItem;
            }
        }
    }


    private function findCartItemIndexBySku(int $sku)
    {
        foreach ($this->cartItems as $index => $cartItem) {
            if ($cartItem->getProduct()->getSKU() === $sku) {
                return $index;
            }
        }
        return -1;
    }
}
