<?php
class OrderItem
{
    private $id;
    private $orderId;
    private $productSku;
    private $quantity;

    public function __construct($id, $orderId, $productSku, $quantity)
    {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->productSku = $productSku;
        $this->quantity = $quantity;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getProductSku()
    {
        return $this->productSku;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    public function setProductSku($productSku)
    {
        $this->productSku = $productSku;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
}
