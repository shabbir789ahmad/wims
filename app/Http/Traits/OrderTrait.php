<?php

namespace App\Http\Traits;


trait OrderTrait
 {

    function gstCalculate($vat,$purchasing_price)
    {  
       $vat=$vat/100;
       $vat=$vat+1;

       $vat_tax=$purchasing_price - ($purchasing_price/$vat);
       $vat_tax=round($vat_tax,2);

       return $vat_tax;
    }
   
   function setPrice($sell_type,$wholesale_one,$stock,$vat)
   {
     $vat_tax=$this->gstCalculate($vat,$stock['purchasing_price']);
    if($sell_type === 'retail' && $wholesale_one==1 || $sell_type === 'whole' && $wholesale_one==1 )
    {
      $price=$stock['product_price_piece'] ;
      $price2=$stock['product_price_piece'] ;
      $sell_type='retail';
                
    }else if($sell_type === 'retail' && $wholesale_one==0 || $sell_type === 'whole' && $wholesale_one==0)
    {
                
      $price=$stock['product_price_piece_wholesale'] ;
      $price2=$stock['product_price_piece_wholesale'] ;
      $sell_type='whole';
                 
    } 

    return ['price'=>$price,'price2'=>$price2,'sell_type'=>$sell_type,'vat_tax'=>$vat_tax];
  } 



  //second function

    function setPrice2($sell_type,$wholesale_one,$stock,$vat,$quentity,$pack_quentity)
  {
               $vat_tax=$this->gstCalculate($vat,$stock['purchasing_price']);
                $vat_tax=$vat_tax/$pack_quentity;
                 $vat_tax=$vat_tax * $quentity;
           
    if($sell_type === 'retail' && $wholesale_one==1 || $sell_type === 'whole' && $wholesale_one==1 )
            {
                $price=$stock['product_price_unit'] ;
                $price2=$stock['product_price_unit']*$quentity ;
                $sell_type='retail';
               
            }else if($sell_type === 'retail' && $wholesale_one==0 || $sell_type === 'whole' && $wholesale_one==0)
            {
                
                $price=$stock['product_price_unit_wholesale'] ;
                $price2=$stock['product_price_unit_wholesale']*$quentity ;
                $sell_type='whole';
               
            } 
            return ['price'=>$price,'price2'=>$price2,'sell_type'=>$sell_type,'vat_tax'=>$vat_tax];
  }



  //function for 
  //weight of the product
 function productWeight($arr)
  {    
       $arr=str_split($arr) ;
     
       $kgs='';
       $grams='';

        $kg=array_slice($arr, 7, 2);
        for($i = 0; $i < count($kg); $i++)
        {
          $kgs .=  $kg[$i];
        }
          
          $kg=$kgs*1000;
         
        $gram=array_slice($arr, 9, 3);
        for($i = 0; $i < count($gram); $i++)
        {
          $grams .=  $gram[$i];
        }
        
          $k=$kg + $grams;
          $new_kg=$kgs.'.'.$grams;
             //$new_kg= round($new_kg,3);
          return ['k'=>$k,'new_kg'=>$new_kg];
  } 
}
?>