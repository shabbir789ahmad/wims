<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Installment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[ 
          'installment',
           'account_id',
           'price_per_installment', 
           'start_date', 
       ];
}
