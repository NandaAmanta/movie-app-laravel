<?php

namespace App\Repositories;

use App\Models\OrderItem;

class OrderItemRepository
{

    private OrderItem $orderItem;

    public function __construct(OrderItem $orderItem)
    {
        $this->orderItem = $orderItem;
    }

    public function save(array $data)
    {
        $result = $this->orderItem::insert($data);
        return $result;
    }

    public function findAllByOrderId(string $orderId)
    {
        $result = $this->orderItem::where("order_id", $orderId);
        return $result;
    }
}
