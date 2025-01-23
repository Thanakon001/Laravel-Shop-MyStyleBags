<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    use HasFactory;

    protected $primaryKey = "band_id";
    protected $fillable = [
        "band_id",
        "band_name",
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'band_id');
    }
}
