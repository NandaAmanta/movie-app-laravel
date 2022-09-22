<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponser;

    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;        
    }

    public function create(CreateOrderRequest $request)
    {
        $result = $this->orderService->create($request);
        return $this->successResponse($result , "Success create order");
    }
}
