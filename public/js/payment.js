$(document).ready(function()
 {
   //payment modal open
   $('#payment').click(function()
   {

     if( $('#pos-table').children().length ==0)
       {
          alert ('Please Select Prodcut')
       }else
       {
         $('#payment-modal').modal('show')
         $('#paying_amount').select();
       }
    }); 
   //pay with enter key
   // $(document).on('keydown','#payment-modal',function(e)
   // {
   //   if(e.keyCode==13 )
   //    {
   //       $('#full_payment').submit();
   //       $('#check').focus();
        
   //   }
   // });

  
       
    
   
  //  $(document).keydown(function(e) 
  //  {
  //    if(e.keyCode==36)
  //     {
  //       if( $('#pos-table').children().length ==0)
  //        {
  //           alert ('Please Select Prodcut')
  //        }else
  //        {
  //          $('#payment-modal').modal('show')
  //        }
  //      }

  //   if(e.keyCode==80 && (e.shiftKey) )
  //   {
  //       date=$('.paying_date').val()
  //       checkDate(date)
  //       customer()
  //       changeTextModal(0)
  //       if( $('#pos-table').children().length ==0)
  //        {
  //           alert ('Please Select Prodcut')
  //        }else
  //        {
  //          $('#payment-partial-modal').modal('show');
  //        }
        
  //       $('#account_type').val(1)
  //       $('#payment-partial-modal').on('shown.bs.modal', function() 
  //       {
  //         $(this).find('[autofocus]').focus();
  //       });
  //   }else if(e.keyCode==84 && (e.shiftKey))
  //   {
  //       date=$('.paying_date').val()
  //       checkDate(date)
  //       customer()
  //       changeTextModal(1)
  //       if( $('#pos-table').children().length ==0)
  //        {
  //           alert ('Please Select Prodcut')
  //        }else
  //        {
  //          $('#payment-partial-modal').modal('show');
  //        }
        
  //       $('#account_type').val(0)
  //       $('#payment-partial-modal').on('shown.bs.modal', function() 
  //       {
  //          $(this).find('[autofocus]').focus();
  //       });
  //   }

  
  //   if(e.keyCode==88 && (e.ctrlKey) )
  //   {
  //       $('#payment-partial-modal').modal('hide')
  //       $('#payment-modal').modal('hide')
  //       $('#select_unit_type').modal('hide')
  //   }

      
  // });

$('#paying_amount').change(function(){

  let amount=$(this).val();
  let payable=$('#payable_amount').val();

  let re= (payable * 10 - amount * 10) / 10;
  re=Number.parseFloat(re).toFixed(2)
 
  $('#remaining').text(re)
  $('#remaining').css('color','red')
  $('.total_amount').text(amount)
  $('.return_amount').text(Math.abs(re))
  
  


});

  //partial payment  modal open
  $(document).on('click','.partial-payment2',function()
  {
     date=$('.paying_date').val()
     checkDate(date)
     customer()
     $('#payment-partial-modal').modal('show')
     let id=$(this).data('id')
     changeTextModal(id);
   });

   $(document).on('click','.pbs',function()
  {
     date=$('.paying_date').val()
     checkDate(date)
     customer()
     $('#payment-partial-modal').modal('show')
     let id=$(this).data('id')
     changeTextModal(id);
   });
  function changeTextModal(id)
  {
    if(id==1)
    {
      $('#Partial').text('Temporary Account')
      $('#account_type').val(0)
    }else if(id==0)
    {
       $('#Partial').text('Permanant Account')
       $('#account_type').val(1)
    }

      $('#payment-modal').modal('hide') 
  }
    
  $('.paying_date').change(function()
  {
      let date=$('.paying_date').val();
      checkDate(date)
  });

   function checkDate(date)
   {
     if(date=='' || $('#pos-table').children().length ==0)
      {
         $('#save-button').prop('disabled',true)

      }else
      {
        $('#save-button').prop('disabled',false)
      }
   }

  //for partial payment functions
  $('.as').change(function()
  {
     let v=$(this).val();
     $('#total_paying2').text(v)
     let total=$('.grand_total').val()
     let new_total=total - v;
     if(new_total < 0)
     {
        $('#remaining2').css('color','red');
        $('#change').text('Change');
        $('#change').css('color','red');
        $('#remaining2').text(Math.abs(new_total));
    }else
    {
            
        $('#change').text('Remaining');
        $('#change').css('color','#212529');
        $('#remaining2').css('color','#3E065F');
        ('#remaining2').text(new_total);
    }
  });

 // function add2(v)
 // {

 //    let price=$('#amount2').val()
 //    let amount=parseInt(price)+ parseInt(v)
 //     $('#amount2').val(amount)
 //     $('#total_paying2').text(amount)

 //     let total=$('.grand_total').val()
 //     if(amount > total)
 //     {
 //        alert ('Amount axceeds')
 //       $('#amount2').val(total)
 //        $('#total_paying2').text(total)
 //     }else
 //     {
 //       let new_total=total - amount;
   
 //     if(new_total<=0)
 //     {
 //        $('#remaining2').text(0)
 //     }else{
 //        $('#remaining2').text(new_total)
 //     }

 //     }
     
     
 // }

  
   $(document).on('click','.discount',function()
   {
     $('.dis').css('display','block')
   });
  
  $(document).on('change','#paying_amount',function()
  {
     let amount=$(this).val();
     let payable=$('#payable_amount').val();
     if(amount < payable)
     {
        $('#pay-button').prop('disabled',true)
     }else
     {
        $('#pay-button').prop('disabled',false)
     }
  });

  $('#clear2').click(function()
  {
     $('#amount2').val(0)
     $('#total_paying2').text(0)
     $('#remaining2').text(0)
  });

  //customer ajax call
  function customer()
  {
    $.ajax({
              url: baseURL + 'pos/customer',
          })
           .done(function(res) 
           {
              $('#customer_id').empty();
              $.each(res, function(index, val) 
              {
                 $('#customer_id').append(`
                        
                     <option value="${ val.id }">${ val.customer_name }</option>
                        
                    `);
              });

            })
            .fail(function()
             {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
   } 



   $('.customer_submit').click(function(e)
   {
     $('#customerModal').modal('hide')
     e.preventDefault()
     $.ajax({
         
         url : "/add-customer",
         type : 'POST',
         dataType : 'json',
         data: {
                "_token": $('#csrf-token')[0].content ,
                customer_group:$('#c_group').val(),
                customer_name:$('#customer_name').val(),
                customer_company:$('#customer_company').val(),
                customer_address:$('#customer_address').val(),
                customer_city:$('#customer_city').val(),
                customer_email:$('#customer_email').val(),
                customer_phone:$('#customer_phone').val(),
              },
              error:function(data)
             {
               customer()
               $('#form_id').trigger("reset");         
             }
      });
   });

  // //get all payment
  // getPayment()
  // function getPayment()
  // {
  //   $.ajax
  //   ({
  //        url:'/get/payment/installment',
  //        type:"GET",
  //        datatype : 'json'
  //     })
  //      .done(function(res)
  //      {
  //        $('#payment_recievable').empty();
  //        $.each(res, function(index,val)
  //        {
  //           $('#payment_recievable').append(`
           
                
  //            `);
  //        });
  //       })
  //       .fail(function(){ });
  // }//payment function endd

});