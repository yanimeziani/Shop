<?php
require_once 'class/orderItem.class.php';
class OrderItemDAO
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(OrderItem $orderItem)
    {
        $sql = "INSERT INTO order_items (order_id, product_sku, quantity) VALUES (:orderId, :productSku, :quantity)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':orderId', $orderItem->getOrderId());
        $stmt->bindParam(':productSku', $orderItem->getProductSku());
        $stmt->bindParam(':quantity', $orderItem->getQuantity());
        $stmt->execute();
    }

    public function update(OrderItem $orderItem)
    {
        $sql = "UPDATE order_items SET order_id = :orderId, product_sku = :productSku, quantity = :quantity WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':orderId', $orderItem->getOrderId());
        $stmt->bindParam(':productSku', $orderItem->getProductSku());
        $stmt->bindParam(':quantity', $orderItem->getQuantity());
        $stmt->bindParam(':id', $orderItem->getId());
        $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM order_items WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM order_items WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new OrderItem($data['id'], $data['order_id'], $data['product_sku'], $data['quantity']);
    }
}
