<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = "pro_bacode";

    protected $fillable = [
        "pro_bacode",
        "pro_name",
        "band_id",
        "pro_details",
        "pro_image",
        "pro_price",
        "pro_stock",
    ];

    protected $casts = [
        "pro_bacode" => "string",
    ];

    protected $hidden = ['pro_image'];

    public function bands()
    {
        return $this->belongsTo(Band::class, 'band_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'pro_bacode', 'pro_bacode');
    }
}
