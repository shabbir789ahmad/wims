<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable=[
     'customer_group',
     'customer_name',
     'customer_address',
     'customer_company',
     'customer_city',
     'customer_email',
     'customer_phone',
    ];
}
