$(document).ready(function(){
    $(document).on("change", '.sub_q', function(e) { 
    
       e.preventDefault();
       let $this=$(this)
       var $input = $(this).val();
       let update_id=$(this).parents('td').siblings('#cart_id').val();
       let brand_id=$(this).parents('td').siblings('.brand_id').val();
       let product_id=$(this).parents('td').siblings('.order_p_id').val();
       let sell=$(this).parents('td').siblings('.sell_by').find('input').val();
        let pid=$(this).closest('div').parents('td').parents('tr').find('.order_p_id').val();
        let unit_id=$(this).parents('td').parents('tr').find('.unt').val();
        let sub=$(this).parents('td').siblings('.price').find('input').val();
        let total,value;
    
      let v=$input
          
        if(v < 1)
        {
          v=1;
          value=v  * (sub * 10) / 10; 
          total=value.toFixed(2)
        }else
        {

          value=v  * (sub * 10) / 10; 
          total=value.toFixed(3)
        }
       
   
     
      subQuentity();
      sumCount();
      updateOrderajax(update_id,product_id,$input,total,$this,sub,sell,unit_id,brand_id);
    });



function updateOrderajax(id,product_id,q,total,$this,price,sell,unit_id,brand_id)
       {
     
         $.ajax({
         
                    url : "/pos/update/orders/ajax",
                    type : 'POST',
                    data: {
                       "_token": $('#csrf-token')[0].content ,
                        
                        id : id,
                        product_id : product_id,
                        quentity_kg : q,
                        sub_total : total,
                        price: price,
                        sell:sell,
                        unit_id:unit_id,
                        brand_id:brand_id,
                    },
                success: function (res){
                
                 if(res.success)
                {
                  snack(1,res.success)
                }else{
                  snack(0,res.fail)
                }
                 appenProduct(res)
                  $this.val(price);
       $this.parent('td').siblings('.ds').find('.sub_total').val( Math.round( total * 10 ) / 10);
       
                 }
                 });

       }


//update price input field
$(document).on("change", '.new_price', function(e) { 
    
     e.preventDefault();
     $this=$(this);
     var $input = $(this).val();
     let update_id=$(this).parents('.price').siblings('.pid').val();
     let unit_id=$(this).parents('.price').siblings('.unt').val();
     let sell=$(this).parents('.price').siblings('.sell_by').find('input').val();
     let v=$(this).parents('.price').siblings('.q').find('.quentity').val();
     let total;

     total=$input * v;
    

     
     subQuentity();
     sumCount();
     updateOrderajax(update_id,v,total,$this,$input,sell,unit_id);


 });

});