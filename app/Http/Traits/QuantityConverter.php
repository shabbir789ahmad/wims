<?php

namespace App\Http\Traits;

trait QuantityConverter
 {

    function quentity($quantity)
    {
      $count=$quantity/1000;
      for($i=0; $i<floor($count); $i++)
      {
        $v=$quantity - 1000;
      }

      return $v;
    }


    


    function quentityKg($quantity,$pack_quentity)
    { 
      $count=$quantity/$pack_quentity;
      for($i=0; $i<floor($count); $i++)
      {
        $quantity=$quantity - $pack_quentity;
      }
       $v=$quantity;
      return abs($v);
    }
   
    function kg($quantity,$pack_quentity)
    {
      $count=$quantity/$pack_quentity;
      return floor($count);
    }

    function quentityFit($quantity,$pack_quentity)
    { 
      $count=$quantity/$pack_quentity;
      for($i=0; $i<floor($count); $i++)
      {
        $quantity=$quantity - $pack_quentity;
      }
       $v=$quantity;
      return abs($v);
    }
    function fit($quantity,$pack_quentity)
    {
      $count=$quantity/$pack_quentity;
      return floor($count);
    }


    function fruitquentity($quantity)
    {
      $count=$quantity/1000;
      return floor($count);
    }

    function fruitquentity2($quantity)
    { 
      $count=$quantity/1000;
      for($i=0; $i<floor($count); $i++)
      {
        $quantity=$quantity - 1000;
      }
       $v=$quantity;
      return abs($v);
    }
 }


?>