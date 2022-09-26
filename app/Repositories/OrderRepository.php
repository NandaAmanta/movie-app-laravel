<?php

namespace App\Repositories;

use App\Models\Order;
use Ramsey\Uuid\Type\Integer;

class OrderRepository
{

    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function save(array $data)
    {
        $result = $this->order::create($data);
        return $result;
    }

    public function update(int $id, array $data)
    {
        $result = $this->order::where("id", $id)->update($data);
        return $result;
    }

    public function findAllByUserIdAndPaginate(string $userId, int $perPage = 15)
    {
        $result = $this->order::with("orderItems")-where("user_id", $userId)->paginate($perPage);
        return $result;
    }
}
