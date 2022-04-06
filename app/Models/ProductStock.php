<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class ProductStock extends Model {

    use HasFactory;

    protected $fillable = [
        'pbrand_id', 
        'stock',
        'purchasing_price',
        'product_price_piece',
        'product_price_piece_wholesale',
        'product_price_unit',
        'product_price_unit_wholesale',
         'active',
         'branch_id',
     ];

     public function scopeBranch( $query) {

       return $query->where('branch_id',Auth::user()->branch_id);
        
    }
}
