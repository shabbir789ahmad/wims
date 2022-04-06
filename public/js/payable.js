$(document).ready(function(){

  $('#payable').click(function()
   {
       $('#payable_supplier').modal('show');
       allPayableAmount()
   });

  
  
    // function allPayableAmount()
    // {
    // 	 $('#pay_supplier').DataTable( {
    //    "paging":   false,
    //     "ordering": false,
    //     "info":     false,
    //     'processing':true,
    //     'serverSide':false,
    //     'ajax':"/supplier",
    //        'columns':
    //        [
    //          {"data":"id"},          
    //          {"data":"product_name"},          
    //          {"data":"contact_person_name"},          
    //          {"data":"product_quentity"},          
    //          {"data":"product_amount"},          
    //          {"data":"paying_date"},
    //           {
    //              sortable: false,
    //              "render": function ( data, type, full, meta ) {
               
    //                  return '<a  class="btn btn-info pay_now" disabled>Pay Now</a>';
    //              }
    //          },          
    //        ]    

    	     
    // });

    // }


    $(document).on('click','.pay_now',function()
    {
    	id=$(this).parents('tr').children('td:first-child').text()
    	$(this).prop('disabled',true).css('background', '#C6C6C6');
      $.ajax({

         url:"/pay/now/"+id,
         type:'POST',
         data:{
         	"_token": $('#csrf-token')[0].content ,
         }
      }).done(function(res){
          
           
      });

    });
});