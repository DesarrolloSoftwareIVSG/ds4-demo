<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'customer_id',
        'status',
        'total'
    ];

    protected $hidden = [
        'customer_id',
       
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeStatus($query, $status)
    {
        if(!$status){
            return $query;
        }

        return $query->where('status', $status);
    }
}
