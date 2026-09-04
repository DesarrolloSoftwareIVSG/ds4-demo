<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->input('status'); // request('status');
        $q = $request->input('q');

       
        $data = Order::status($status)
                ->when($q, function ($query, $q) {
                    return $query->where('code', 'like', "$q%");
                })
                ->paginate(25);

        return $data;

         // if ($status) {
        //     return Order::where('status', $status)->paginate(25);
        // }

        //return Order::paginate(25);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => ['required','string','max:255','unique:orders,code'],
            'customer_id' => ['required','integer','exists:customers,id'],
            'total' => ['required','numeric','min:0'],
            'status' => ['required','string','in:draft,confirmed,canceled'],  
        ]);

       $order = Order::create($validatedData);

       return $order;
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $order->load('customer');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
         $validatedData = $request->validate([
            'code' => ['required','string','max:255', 
                            Rule::unique('orders','code')->ignore($order->id)],
            'customer_id' => ['required','integer','exists:customers,id'],
            'total' => ['required','numeric','min:0'],
            'status' => ['required','string','in:draft,confirmed,canceled'],  
        ]);

       $order->update($validatedData);

        return $order;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
    }
}
