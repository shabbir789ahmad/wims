$(document).ready(function(){
    // $(document).keydown(function(e){
 
    //  if(e.keyCode==68 && (e.shiftKey))
    //  {
    //   discountmodal();

    //  }
    //  if(e.keyCode== 83 && (e.shiftKey))
    //  {
    //     discount();
    //  }

    // });
	$('.disc-modal').click(function(){

       discountmodal();
     });

   $('#discount-button').click(function(){
      discount();
    });
  function discountmodal()
  {
    if( $('#pos-table').children().length ==0)
       {
         alert ('Please Select At Least One Prodcut');
         $('#discount-modal').modal('hide')
       }else
       {
         $('#discount-modal').modal('show')
         $('#discount-modal').on('shown.bs.modal', function() {
          
           $(this).find('[autofocus]').focus();
          
          });
       }

  }
  function discount()
  {
 
        let text_value=$('#discount-input').val()
        let grand_total=$('#g_total').text()
        let discount= $('#discount').text()
        let tax=$('#tax').text();
       
        let t=grand_total+parseInt(tax)-text_value
         t=Number.parseFloat(t).toFixed(2)
        let check=$('#pos-table1').children('.table-product').find('#discount_td');
        let check2=$('#pos-table3').children('.printer-tr').find('#discount_td2');
        if(check.length===0)
        {
          $('#pos-table1:last-child').append(`<tr class="table-product"><td class="col-6">Discount</td><td></td><td></td><td></td><td></td><td></td><td></td><td class="float-right col-6 font-weight-bold mr-3" id="discount_td">`+text_value+`</td</tr>`);  
        }else{
            $('#pos-table1').children('.table-product').find('#discount_td').text(text_value)
        }
        if(check2.length===0)
        {
          $('#pos-table3:last-child').append(`<tr class="printer-tr border-bottom" style="display: flex;flex-direction:row; width:100%;"><td class="col-10">Discount</td><td class="ml-auto col-2 font-weight-bold" id="discount_td2">`+text_value+`</td</tr>`);  
        }else{
            $('#pos-table3').children('.printer-tr').find('#discount_td2').text(text_value)
        }
        $('.grand_total').val(t)
        $('.g_total2').text(t)
        $('#discount').text(text_value)
        $('.discount2').val(text_value)
        
        $('#discount-modal').modal('hide')

  }

   $('#tax-button').click(function(){

     let text_value=$('#tax-input').val()
     const grand_total=$('.grand_total').val()

     let t;
     if(text_value==0)
     {
       
     }else{
       t=parseInt(text_value)/100 * parseInt(grand_total) 
       t=Math.floor(t)
       let g=$('.grand_total').val()
       tex=parseInt(g)+parseInt(t)
     $('.grand_total').val(tex)
     $('#g_total').text(tex)
     $('.g_total2').text(tex)
     }
     
     

       let tax= $('#tax').text()
        tax=parseInt(text_value)  + parseInt(tax);
        $('#tax').text(tax +'%')
        
        $('.tax3').text(tax +'%')

    $('#tax-modal').modal('hide')

	});

   //hide search bar in pos search option

   $('#search_cut').click(function(){

  $('#myDropdown').html('');
   });

   $(document).click(function(e){
    var container = $(".hide-mdrop");
    if(!container.is(e.target) && container.has(e.target).length === 0){
        $('#myDropdown').html('');
    }

});

//  $(document).click(function(e){
//     var container = $(".hide-mdrop2");
//     if(!container.is(e.target) && container.has(e.target).length === 0){
//         $('#myDropdown2').html('');
//     }

// });

   //code for close sidebar when click outside div

  $(document).click(function(e){
    var container = $(".fg");
    if(!container.is(e.target) && container.has(e.target).length === 0){
        $('#myNav').css('width','0%')
    }
    

  var container = $(".fg2");
    if(!container.is(e.target) && container.has(e.target).length === 0){

        $('#myNav2').css('width','0%')
    }
    var container = $(".fg3");
    if(!container.is(e.target) && container.has(e.target).length === 0){

        $('#myNav3').css('width','0%')
    }

});
   $(document).on('click','.fg,.fg2,.fg3',function() {

    if($(this).data('id')=='1')
    {
      $('#myNav').css('width','50%')

    }else if($(this).data('id')=='2'){
       $('#myNav2').css('width','50%')
    }else if($(this).data('id')=='3'){
       $('#myNav3').css('width','50%')
    }
     
     });

   $(document).on('click','.closebtn,.closebtn2',function() {
     
    if($(this).data('id')=='1')
    {
        alert ($(this).data('id'))
      $('#myNav').css('width','0%')

    }else if($(this).data('id')=='2'){
       $('#myNav2').css('width','0%')
    }
     
    });
  
  $('#other_expenses').off().click(function(e)
  {

    e.preventDefault();
    let Frate=$('#Frate').val();
    let Laborer=$('#Laborer').val();
    let other=$('#other').val();
    const grand_total=$('#g_total').text()
     let discount=$('#discount').text()
    if(!Frate){Frate=0}
    if(!Laborer){Laborer=0}
    if(!other){other=0}
    

    let total1=parseInt(Frate)+parseInt(Laborer)+parseInt(other);
   let check= $('#pos-table1').children('.table-product').find('#expense_tr');
   let check2= $('#pos-table3').children('.printer-tr').find('#expense_tr2');
    if(check.length==0)
    { 
        $('#pos-table1:last-child').append(`<tr class="table-product"><td class="col-6">Expenses</td><td></td><td></td><td></td><td></td><td></td><td></td><td class="float-right col-6 mr-3 font-weight-bold" id="expense_tr">`+total1+`</td</tr>`);
    }else
    {  
      $('#pos-table1').children('.table-product').find('#expense_tr').text(total1)
    }

    if(check2.length==0)
    { 
        $('#pos-table3:last-child').append(`<tr class="printer-tr border-bottom" style="display: flex;flex-direction:row; width:100%;"><td class="col-10">Expenses</td><td class="ml-auto col-2 font-weight-bold" id="expense_tr2">`+total1+`</td</tr>`);
    }else
    {  
      $('#pos-table3').children('.printer-tr').find('#expense_tr2').text(total1)
    }    
    
    let total=parseFloat(total1)+parseFloat(grand_total)-parseFloat(discount);
    total=Number.parseFloat(total).toFixed(2)
    $('.grand_total').val(total)
    $('.g_total2').text(total)
    $('#tax').text(total1)
    
    $('#frate-modal').modal('hide');
  });

});