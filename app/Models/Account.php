<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Account extends Model
{
    use HasFactory;
     use SoftDeletes;
    protected $fillable=['account','paying_date','account_type','customer_id','admin_id'];
}
