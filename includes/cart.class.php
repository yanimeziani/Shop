<?php
class Cart
{
    private $products;
    private $total;

    public function __construct($products, $total)
    {
        $this->products = $products;
        $this->total = $total;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setProducts($products)
    {
        $this->products = $products;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }
}
