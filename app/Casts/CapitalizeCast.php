<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CapitalizeCast implements CastsAttributes
{
   
    public function get($model, string $key, $value, array $attributes)
    {
      return ucwords($value);
    }

    
    public function set($model, string $key, $value, array $attributes)
    {
       return ucwords($value);
    }
}