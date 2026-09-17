<?php 

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function crear(array $data)
    {
        $order = Order::create($data);

        return $order;
    }

    public function confirmar(Order $order)
    {
        //if

        //if

        //if
        if($order->total > 500) {
            throw new \App\Exceptions\Regla500Exception();
        }
   

        $order->status = 'confirmed';
        $order->save();

    }
}