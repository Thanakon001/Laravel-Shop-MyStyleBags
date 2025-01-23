<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = "order_id";
    
    public $incrementing = false;

    protected $fillable = [
        "order_id",
        "order_date",
        "id",
        "order_name",
        "order_address",
        "order_phone",
        "order_payment",
        "order_total",
        "order_status",
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            $lastOrder = Order::latest()->first();
            $lastId = $lastOrder
                ? (int) substr($lastOrder->order_id, -5)
                : 0;
            $str = "T" . Carbon::now()->format('Ymd') . str_pad($lastId + 1, 5, "0", STR_PAD_LEFT);
            $order->order_id = $str;
        });
    }

    public function orderlist()
    {
        return $this->hasMany(OrderList::class,'order_id');
    }


}
