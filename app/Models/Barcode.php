<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Barcode extends Model
{
    use HasFactory;
    protected $fillable=['barcode','name','price','branch_id'];
    
     public function scopeBranch( $query) {

       return $query->where('branch_id',Auth::user()->branch_id);
        
    }
}
