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
            throw new \RuntimeException('Error no pueden haber ordenes mayores a 500');
        }
   

        $order->status = 'confirmed';
        $order->save();

    }
}