<?php

use App\Models\Order;
use App\Services\OrderService;

it('tira una excepcion si la orden tiene un total mayor a 500 y laa orden no se confirma', function () {
    $order = Order::factory()->create([
        'status' => 'draft',
        'total' => 600,
    ]);

    
    expect(fn () => app(OrderService::class)->confirmar($order))
        ->toThrow(RuntimeException::class);


    expect($order->fresh()->status)->toBe('draft');
  
});

it('Al confirmar una orden la base de datos aumenta en 1 el total de ordenes confirmadas',function(){
    $order = Order::factory()->create([
        'status' => 'confirmed',
        'total' => 400,
    ]);
     $orderPendiente = Order::factory()->create([
        'status' => 'draft',
        'total' => 400,
    ]);

    $totalConfirmadasAntes = Order::where('status','confirmed')->count();
   
    expect($totalConfirmadasAntes)->toBe(1);

    app(OrderService::class)->confirmar($orderPendiente);

    $totalConfirmadasDespues = Order::where('status','confirmed')->count();


    expect($totalConfirmadasDespues)->toBe(2);



});


