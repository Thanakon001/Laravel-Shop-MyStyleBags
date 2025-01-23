<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;
    protected $table = 'order_lists';
    protected $primaryKey = "list_id";
    protected $fillable = [
        "order_id",
        "pro_bacode",
        "pro_price",
        "list_quentity",
        "list_total",
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'pro_bacode');
    }
}
