<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'product_id',
        'brand_id',
      ];

       public  function stocks()
    {
       return $this->hasMany(ProductStock::class,'pbrand_id')->select('stock', 'stock_sold','pbrand_id');
    }
}
