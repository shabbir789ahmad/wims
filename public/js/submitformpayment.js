$(document).ready(function(e)
{
  $('#print').click(function(){

           let customer_name=$('#customer_name').val()
         
              $('#customer_name_print').text(customer_name)
          
        $.ajax({
         
                url : "/order/order/printer",
                type : 'POST',
                datatype:'json',
                data:{
                    
                     "_token": $('#csrf-token')[0].content ,
                        biller_name : $('#biller_name').val(),
                        admin_id : $('#admin_id').val(),
                        customer_name : $('#customer_name').val(),
                        paying_by : $('#paying_by').val(),
                        paying_amount : $('#paying_amount').val(),
                        payable_amount : $('#payable_amount').val(),
                        
                        

                },
                 
               }).done(function(res)
               {
               
                  let data=res.cart_data;  
                  let success=res.success; 

                 $('#pos-table2').empty()
                 $.each(data,function(key,item){
                  $('.invoice_id').text(item.payment_id)
                  let sub=item.sub_total;
                  
               sub_total=Number.parseFloat(item.sub_total).toFixed(3)
                 let apend2=`
                  <tr  class="border-bottom printer-tr" style="display: flex;flex-direction:row; width:100%;">
                   
                   <td class=" col-4">${item.product_name.substring(0,12).toUpperCase()} </td>
                   
                   <td class="price col-2 text-center">${item.sub_total}</td>
                   <td class="print-q col-2 text-center">${item.quentity}"</td>
                   <td class=" col-2 text-center">${item.tax}"</td>
                   <td class="print-subt col-2 text-center">${sub_total}</td>
                  </tr>
                  `;

                 $('#pos-table2').append(apend2);
                 
                  
                 });
                 
                  window.print();
                 
                  $('#payment-modal').modal('hide');
                  $('#pos-table1').empty()
                  $('#pos-table').empty()
                 
                 $('.g_total2').text('')
                 $('.quan').text('')
                 $('.items').text('')
                 $('#check').focus();
                snack(1,success)  
                 getSale()
              });
      });

  getSale()

  function getSale()
  {

 
      $.ajax({
 
        url:'pos/sale-data',
       })
         .done(function(res){

            $('#total_sale').val('RO. '+ Number.parseFloat(res.sale).toFixed(3) )
          $('#total_recived').val('RO. '+ Number.parseFloat(res.recieve).toFixed(3) )
          $('#net-sale').val('RO. '+  Number.parseFloat(res.netsale).toFixed(3))
            $('#expense').val('RO. '+  Number.parseFloat(res.exp).toFixed(3) )

        })
         .fail(function(){
           
          });
   }

});