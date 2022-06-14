<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use App\Casts\CapitalizeCast;
use Auth;
class Brand extends Model {

    use HasFactory;
    protected $casts=[
    'brand_name' => CapitalizeCast::class, 
     ];
    protected $fillable = [ 'brand_logo', 'brand_name','branch_id'];

   

    public function scopeBranch( $query) {

       return $query->where('branch_id',Auth::user()->branch_id);
        
    }

    public static function brands()
    {
      return Brand::Branch()->get();
    }

}
