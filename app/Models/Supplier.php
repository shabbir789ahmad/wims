<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Supplier extends Model {

    use HasFactory;

    protected $fillable = [ 'company_name', 'contact_person_name', 'contact_person_phone','branch_id'];

    public function scopeBranch( $query) {

       return $query->where('branch_id',Auth::user()->branch_id);
        
    }

}
