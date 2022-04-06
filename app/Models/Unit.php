<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Unit extends Model {

    use HasFactory;

    protected $fillable = ['unit_code', 'unit_name','branch_id'];
   
    public function scopeBranch( $query) {

       return $query->where('branch_id',Auth::user()->branch_id);
        
    }
}
