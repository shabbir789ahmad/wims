$(document).ready(function(){

  $(document).on('click','#total_recived',function(){
    $('#customer-payment-modal').modal('show')
    getAccount(2);
    $('#partial-order').prop('disabled',true);
  });

  // $(document).keydown(function(e) {
      
  //     if(e.keyCode==65 && (e.shiftKey))
  //     {
  //           getAccount(2)
  //           $('#customer-payment-modal').modal('show');
  //           $('#partial-order').prop('disabled',true);
  //           $(document).keydown(function(e) {
  //             if(e.keyCode==80 && (e.shiftKey))
  //              {

  //                 getAccount(3);
  //                $('#permanant-order').prop('disabled',true);
  //                $('#order-now').prop('disabled',false);
  //                 $('#partial-order').prop('disabled',false);
  //                  $('#form-account').css('display','none')
  //                   $('#partial-account').css('display','none')
  //                   $('#permanant-account').css('display','block')
        
  //              }else if(e.keyCode==65 && (e.shiftKey))
  //              {
                 
  //                 getAccount(2);
  //                $('#permanant-order').prop('disabled',false);
  //                $('#order-now').prop('disabled',false);
  //                 $('#partial-order').prop('disabled',true);
  //                  $('#form-account').css('display','none')
  //                   $('#partial-account').css('display','block')
  //                   $('#permanant-account').css('display','none')
  //              }
  //           });
      
  //     }else if(e.keyCode==88 && (e.shiftKey))
  //     {
  //          $('#customer-payment-modal').modal('hide')
  //     }
      
  // });


  $(document).on('click','#partial-order,#permanant-order',function(){
  
   let id=$(this).data('id');

    if(id==2)
    {
    	getAccount(id);
    	$(this).prop('disabled',true);
    	$('#permanant-order').prop('disabled',false);
    	$('#order-now').prop('disabled',false);

    	$('#form-account').css('display','none')
        $('#partial-account').css('display','block')
        $('#permanant-account').css('display','none')
        
    }else if(id==3)
    {
    	getAccount(id);
    	$(this).prop('disabled',true);
    	$('#partial-order').prop('disabled',false);
    	$('#order-now').prop('disabled',false);

    	$('#form-account').css('display','none')
      $('#partial-account').css('display','none')
      $('#permanant-account').css('display','block')

    }

    

  });


  function getAccount(id)
  {

 
  	$.ajax({
 
       url:'pos/acount-data',
       data:{
       	id:id,
       }

  	})
  	.done(function(res){

         
         let ph = baseURL + "assets/defaults/user.png";
           $('#myDropdown').empty();
           $('#myDropdown3').empty();
          
           $.each(res,function(index,val){

              let data=`
              <a href="#" class="d-flex shadow border customer-tr" style="text-decoration:none;">
               <div class="row w-100 ">
               <div class="col-md-2  pr-0"><img src="${ ph }" class="rounded border " alt="..." style="height:5rem;" loading="lazy"></div>
               <div class="col-md-2 mt-4 font-weight-bold">${val.customer_name}</div>
               <div class="col-md-2 mt-4">RO. ${val.account}</div>
               <div class="col-md-3 mt-4"> ${val.paying_date}</div>
               
               <div class="col-md-3 mt-4"><button class="btn btn-xs btn-info float-right recieve_payment" data-id="${val.id}" >Recieve</button></div>
               </div></a>
    
              `;   
              if(id==2)
              {
                $('#myDropdown').append(data);
              } else if(id==3)
              {
                $('#myDropdown3').append(data);
              }

           });
      $('#myDropdown .customer-tr:first-child').addClass("active").css('color','#ffffff')
  		
  	})
  	.fail(function(){

  	});
  }

  $(document).on('mouseover','.customer-tr', function(e) {
    
  $(this).addClass('active').css('color','#ffffff').siblings().removeClass('active').css('color','#000000');   
});

  $(document).on('click','.recieve_payment',function(e){
    e.preventDefault()
    $(this).prop('disabled',true)
     
    $.ajax({
 
        url:'/recieve/payment/from/customer',
        type:'Post',
        datatype:'json',
        data:{
          "_token": $('#csrf-token')[0].content ,
          id:$(this).data('id'),
        },success:function(res){
        getAccount(2)
        }
 
    });//end ajax

  });





  
});