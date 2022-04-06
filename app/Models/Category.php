<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\CapitalizeCast;
use Auth;
class Category extends Model {

    use HasFactory;
     protected $casts=[
    'category_name' => CapitalizeCast::class, 
     ];
    protected $fillable = [ 'category_name','branch_id'];
   
   public function scopeBranch( $query) {

       return $query->where('branch_id',Auth::user()->branch_id);
        
    }
}
