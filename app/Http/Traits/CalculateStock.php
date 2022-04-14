<?php

namespace App\Http\Traits;


trait CalculateStock
 {
   

  


    function calculatestock($pack_quentity,$quentity_kg,$id)
    {
          $piece_stock_check=0;
            $unit_stock_check=0;
             $cart=session()->get('cart');
            
            if($cart)
            {
             foreach($cart as $c)
             {
                if($c['pid']==$id && $c['sell_by']== 'piece')
                {
                 
                 $piece_stock_check += $c['quantity'];

                }
                if($c['pid']==$id && $c['sell_by']== 'unit')
                {
                 
                 $unit_stock_check += $c['quantity'];

                }
             }
           }
            $quentity_in_kg= $piece_stock_check * 
             $pack_quentity;
             
            $quentity_in_kg =$quentity_in_kg +$unit_stock_check;
           
         
            return $quentity_in_kg;
    }



    function totalQuentityLeft($pack_quentity,$stock,$stock_sold)
    {
        
        $order_quentity =($stock * $pack_quentity) + ($pack_quentity - $stock_sold);
    
        return $order_quentity;
    }

}


?>