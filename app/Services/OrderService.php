<?php

namespace App\Services;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\MovieScheduleRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class OrderService
{

    private OrderRepository $orderRepository;
    private OrderItemRepository $orderItemRepository;
    private MovieScheduleRepository $movieScheduleRepo;

    public function __construct(OrderRepository $orderRepo, MovieScheduleRepository $movieScheduleRepo, OrderItemRepository $orderItemRepository)
    {
        $this->orderRepository = $orderRepo;
        $this->orderItemRepository = $orderItemRepository;
        $this->movieScheduleRepo = $movieScheduleRepo;
    }

    public function getByAuth()
    {
        $order = $this->orderRepository->findAllByUserIdAndPaginate(Auth::user()->id);
        return $order;
    }

    public function create(CreateOrderRequest $request)
    {

        $dataReq = $request->only(["items", "payment_method"]);
        $userId = Auth::user()->id;

        $orderReq = [
            "user_id" => $userId,
            "payment_method" => $dataReq["payment_method"],
        ];

        $order = $this->orderRepository->save($orderReq);

        $orderItemReq = [];
        $totalPrice = 0;
        for ($i = 0; $i < count($dataReq['items']); $i++) {
            $movieSchedule = $this->movieScheduleRepo->findById($dataReq['items'][$i]["movie_schedule_id"]);
            if ($movieSchedule == null) {
                throw new NotFoundResourceException();
            }

            array_push($orderItemReq, [
                "order_id" => $order['id'],
                "qty" => $dataReq['items'][$i]["qty"],
                "movie_schedule_id" => $movieSchedule['id'],
                "price" => $movieSchedule['price'],
                "sub_total_price" => 0,
                "created_at" =>  Carbon::now(),
                "updated_at" => Carbon::now()
            ]);

            $totalPrice += $dataReq['items'][$i]["qty"] * ($movieSchedule->price + $movieSchedule['sub_total_price']);
        }
        $this->orderItemRepository->save($orderItemReq);
        $this->orderRepository->update($order["id"], ["total_item_price" => $totalPrice]);
        $order["order_items"] = $order->orderItems;
      

        return $order;
    }
}
