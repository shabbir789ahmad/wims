<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Charge extends Model
{
    use HasFactory;
    protected $fillable=[

     'return_charges',
     'return_quentity',
     'order_id',
     'branch_id'
    ];
    public function scopeBranch( $query) {

       return $query->where('branch_id',Auth::user()->branch_id);
        
    }
}
