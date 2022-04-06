$(document).ready(function(){

	 $('#expense').click(function(){
      
       expenseType()
       $('#expense-modal').modal('show');

    });

$('#expense_type').click(function(e){

  e.preventDefault()
  $('#expenseModal').modal('show')
})

  //    $(document).keydown(function(e) {
      
  //      if(e.keyCode==69 )
  //     {
  //           expenseType()
  //           $('#expense-modal').modal('show');
      
  //     }
  //     //for open expense type modal
  //     if(e.keyCode==84 && (e.altKey))
  //     {
  //          $('#expenseModal').modal('show')
      
  //     }else if(e.keyCode==88  && (e.ctrlKey))
  //     {
  //          $('#expenseModal').modal('hide')
  //     }
      
  // });
 
   $('#expense-button').click(function(e){
      
    e.preventDefault()
     $('#expense-modal').modal('hide')
    $.ajax({
         
         url : "/add-expense",
         type : 'POST',
         dataType : 'json',
         data: {
            "_token": $('#csrf-token')[0].content ,
            
             e_type: $('#e_type').val(),
             e_name:$('#e_name').val(),
             expense_price:$('#expense_price').val(),
             
         }
      })
        .done(function(res){

            $('#expense').val(res)
        })
 
   })
 



  $(document).on('click','#add_expense_type',function(){

  $.ajax({

     url: '/expense/create',
     type: 'POST',
     datatype: 'json',
     data:{
         "_token": $('#csrf-token')[0].content ,
     	'expence_type' : $('#expence_type').val()
     },
  })
  .done(function(){

     expenseType()
    $('#expenseModal').modal('hide')
  	
  });//ajax end

  });


  function expenseType()
  {
  
  	 $.ajax({

       url:'/get/expense/type'

  	  }).done(function(res){
        
        $('#e_type').empty()
  	  	$.each(res,function(index,val){
            
           $('#e_type').append(`
            
             <option value="${val.id}">${val.expence_type}</option>

           	`);

  	  	});



  	  });


  }

});