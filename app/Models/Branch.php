<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\CapitalizeCast;
class Branch extends Model {

    use HasFactory;
   protected $casts=[
    'branch_name' => CapitalizeCast::class, 
     ];
    protected $fillable = ['vendor_id', 'branch_name'];


   

}
