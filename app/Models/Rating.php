<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $primaryKey = 'rating_id';

    protected $fillable = [
        'id',
        'comment',
        'rating_point',
        'pro_bacode',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
