<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\CapitalizeCast;
use Auth;
class SubCategory extends Model {

    use HasFactory;
    protected $casts=[
    'sub_category_name' => CapitalizeCast::class, 
     ];
    protected $fillable = ['category_id', 'sub_category_name','branch_id'];

    public function scopeBranch( $query) {

       return $query->where('branch_id',Auth::user()->branch_id);
        
    }
    
}
