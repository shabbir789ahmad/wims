$(document).ready(function(){

 $(document).on('click','.rm',function(){

   $(this).parents('tr').remove();

     quentityCount();//function decleare at 716

     let remove_product_id=$(this).parents('tr').find('.pid').val();
   
    //alert (remove_product_id)
     removeajax(remove_product_id)
    
       
       
      // let v=$(this).parents('tr').children('td').find('.sub_total').val();
      // let vat=$(this).parents('tr').children('td').find('.vat').val();
      //     v=parseFloat(v)+ parseFloat(vat);
      //    let t=$('.grand_total').val();
       // let  sum= (t * 10 - v * 10) / 10;
       //  alert(vat)
       //   sum=Number.parseFloat(sum).toFixed(3)
       //    $('.grand_total').val(sum)
       //    $('#g_total').text(sum)
       //    $('.g_total2').text(sum)
       //    $('.g_total3').text(vat)
        subQuentity();
        sumCount();

  });



 function removeajax(id)
 { 
      
      if(confirm('Are you sure to delete'))
    {
     
      $.ajax({
            url: "delete/", 
               
                method: "delete",
                data: {
                    "_token": $('#csrf-token')[0].content ,
                    id:id,
                },
                success: function ()
                {
                      $('#tb').focus();
                        $('#tb').val('');
                 }
            });
     }
           
  }



   $('#cancel').click(function()
   {
      cancel();
    });

   function cancel()
   {
    if(confirm("Are You Sure!"))
     {
       $.ajax({
                url : "/cancel-order",
              
              }).done(function(res)
               {
                 
                 $('#pos-table').empty()
                 // sumQuentity()
                 // subQuentity()
                 // quentityCount()
                  subQuentity();
                  sumCount();
                 // $('.g_total2').text('')
                 // $('.quan').text('')
                 // $('.items').text('')
                 // $('#tb').focus();
                 //        $('#tb').val('');
               })
               .fail(function(){

                alert ('Can Not Cancel Order ')
               });
      }
   }

//get all invoices



  $(document).on('click','#feature',function()
  {
    
    $.ajax({
                url: baseURL + 'invoice/data',
          })
        .done(function(res) 
        {
          $('#return_content').empty();
          let ph;
          // $.each(res, function(index, val) 
          // {
           
        
            $('#return_content').append(
             `
               <p class="ml-5">conning soon</p> `
               );
          
        })
          .fail(function()
           {
             console.log("error");
            })
            .always(function() 
            {
             console.log("complete");
            });
  });
  

});