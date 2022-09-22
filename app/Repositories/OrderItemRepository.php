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

    public function findAllByOrderIdAndPaginate(string $orderId, int $perPage = 15)
    {
        $result = $this->orderItem::where("order_id", $orderId)->paginate($perPage);
        return $result;
    }
}
