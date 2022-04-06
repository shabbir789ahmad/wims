$(document).ready(function()
{
  $(document).on('click','#cateory_sidebar',function()
    {   
      $.ajax({
                url: baseURL + 'point-of-sale/sub-categories',
           })
           .done(function(res) 
           {
             let ph;
             $('#sub-categories').empty();
             $.each(res, function(index, val) 
             {
               ph = baseURL + "assets/defaults/zummXD2dvAtI.png";
               $('#sub-categories').append(`
                 <div class="col-3 " id="sub_category_id" data-cat-id="${val.id}">
                  <div class="card pos-gradient">
                    <img src="${ ph }" class="img-thumbnail card-img" alt="..." style="height:5rem; width:100%;" loading="lazy">
                   <div class="card-body text-center p-1" >
                      <p class="mb-0 p1">${ val.sub_category_name }</p>
                   </div>
                  </div>
                </div> `
                );
             });

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
    
    $(document).on('click', '#sub_category_id', function(event) 
    {
       document.getElementById("myNav").style.width = "0%";
       product( id=2, $(this).data('cat-id')); 
    });
  
    
      
    product( id=2 , cid=0);
    function product(id, cid)
    {
     
      $.ajax({
         url:'/pos/products/get/'+cid,
            
              
           })
           .done(function(data)
            {
              let  res=data.products;
              let stock=data.stock;
             
              if(id== '1')
              {
               
               }else
               {
                 $('#myDropdown2').empty();
                  var ph,input_value;
                  let whole= $('#whole').val();
                  let retail= $('#retail').val();
                  whole=parseInt(whole);
                  retail=parseInt(retail);
                  if(whole===1)
                  {
                     input_value=0;
                  }else{
                      input_value=1;
                  }
                  $.each(res, function(index, val)
                  {
                    if (val.product_image === "" || val.product_image === null)
                     {
                       ph = baseURL + "assets/defaults/product_ph.png";
                      } else 
                      {
                       ph = baseURL + "uploads/products/" + val.product_image;
                      }

                    $('#myDropdown2').css({'height':'39.6rem'});
                    var string = 
                    `<a href="#" class="p customer-tr2  border-bottom"  tabIndex="-1">
                    <div class="row r">
                      <div class="col-md-1 px-0"><img src="${ ph }" class="img-thumbnail mr-1 card-img" alt="..."  loading="lazy"></div>
                      <div class="col-md-3 product-font font px-0 ">${val.product_name} </div> 
                      `;
                     
                     var valueArr = val.stock.map(function(item){ return item.product_id });
                     var isDuplicate = valueArr.some(function(item, idx){ 
                       return valueArr.indexOf(item) != idx ;
                     });
                    if(isDuplicate===false)
                   {
                       string=string+`<div class=" col-md-6 brn text-center p-0 o " >`;
                       for(var val2 of val.stock)
                        {
                          let price;
                         for(var st of stock)
                         {
                           if(st.pbrand_id === val2.id)
                          {
 
                            price=sellBy(val.sell_by,whole,st)
                           
                          
                          string = string + `
                       
                            
                              <button class="btn  single_brand text-light text-left mt-2 pos-product p-2 mb-0" data-product-id="${val.id}"  
                            data-sell_by="${val.sell_by}" data-unit="${val.unit_id}" data-brand="${val2.id}" data-barcode="${val.product_code}" data-unitcode="${val.unit_barcode}"
                               style="width:15rem;background-color:">${val2.brand_name.substring(0,25)}<span class="float-right">RO ${price}</span></button>

                              
                                `; }
                         }}
                  
                        
                   
                   }else{
                      string=string+`
                      <div class=" col-md-6 brn text-center p-0 o " >
                      <div class="dropdown mt-2">
                       <button class="btn btn-secondary show_Brands dropdown-toggle btn-info" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:15rem;">
                          Select Brands
                       </button>
                      <div class="dropdown-menu shadow dropdown-menu-center p-0 brand_active" aria-labelledby="dropdownMenuButton" style="background-color:#000000;width:15rem;">`;
                        for(var val3 of val.stock)
                        {
                          
                          let price;
                         for(var br of stock)
                         { 

                           if(br.pbrand_id == val3.id)
                          {

                            price=sellBy(val.sell_by,whole,br)
                          string = string + `
                       
                            
                              <p class="dropdown-item border-bottom text-light pos-product p-1 mb-0" data-product-id="${val.id}"  
                            data-sell_by="${val.sell_by}" data-unit="${val.unit_id}" data-brand="${val3.id}" data-barcode="${val.product_code}" data-unitcode="${val.unit_barcode}"
                            >${val3.brand_name.substring(0,25)}<span class="float-right">RO ${price}</span></p>

                              
                                `; }
                        } } 
                  
                      string=string+`</div></div>`;
                    }
                       string = string + `
    
                      </div><div class="w col-md-2 px-0 "> 
                      <div class="float-right mt-2">
                          <button class="mt-0 btn btn-md mr-2 text-light mb-1 ab" style="background:#5CB85C">R</button>
                       `;
                      
                                       
                           string = string + `
                          
                        
                          </div>
                           <input type="hidden"  id="wholesale_one" value="${input_value}" ></div></div></a>
                        `;
                     $('#myDropdown2').append(string);
        
                        
                    if(whole===0)
                      {
                        $('.ab').text('R');
                        $('.ab').addClass('Retailer_one');
                        $('.Retailer_one').parents('.w').siblings('input').val(1);
                        $('.ab').css('background','#5CB85C');
                      }else if(whole==1)
                        
                      {
                        $('.ab').text('W');
                        $('.whole_sale_one').parents('.w').siblings('input').val(0);
                        $('.ab').addClass('whole_sale_one');
                        $('.ab').css('background','#17A2B8');
                      }
                      });

                 }
       
             $('#myDropdown2 .customer-tr2:first-child').attr("active","1").css({'background':'#3E065F','color':'#ffffff'});
             $('#tb').focus();
             brndtip();
           // $('.dropdown-item:first-child').addClass("active3")
            
          })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        //console.log("complete");
        checkFont();
        //brndtip()
      });
     }


function sellBy(value,whole,br)
{
   if(value=='piece')
    {
      if(whole===0)
      {
       return price=br.product_price_piece;
      }else
      {
      return  price=br.product_price_piece_wholesale;
      }
                             
    }else if(value=='unit')
    {
      if(whole===0)
      {
       return price=br.product_price_unit;
      }else
      {
       return price=br.product_price_unit_wholesale;
      }
                              
    }else
    {
      if(whole===0)
      {
      return  price=br.product_price_piece;
      }else
      {
       return price=br.product_price_piece_wholesale;
      }
                              
    }
}

  function checkFont()
  {
     let count=$('.customer-tr2');
     $.each(count,function(val,l)
     {
       font=$(this).children('.r').find('.font').text();
       if(font.length > 20)
       {
        $(this).children('.r').find('.font').css('margin-top','0%');
       }else
       {
         $(this).children('.r').find('.font').css('margin-top','2%');
       }
     });
  }

  $(document).on('mouseover','.customer-tr2', function(e) 
  {
    $(this).attr('active','1').css({'background-color':'#3E065F','color':'#ffffff'})
    .siblings().removeAttr('active').css({'background-color':'#ffffff','color':'#000000'}); 
    brndtip();  
  });

  $(document).on('click','#brand',function()
  {
    let id=0;
    $.ajax({
                url: baseURL + 'pos/brand/' + id,
          })
        .done(function(res) 
        {
          $('#brand-content').empty();
          let ph;
          $.each(res, function(index, val) 
          {
            if (val.brand_logo == "" || val.brand_logo == null) 
            {
               ph = baseURL + "assets/defaults/product_ph.png";
            } else 
            {
              ph = baseURL + "uploads/brand/" + val.brand_logo;
            }
        
            $('#brand-content').append(
             `
                <div class="col-3 product_by_br" id="sub_category_id" data-brand-id="${val.id}">
                 <div class="card pos-gradient">
                   <img src="${ ph }" class="img-thumbnail card-img" alt="..."  style="height:5rem;width:100%;" loading="lazy">
                   <div class="card-body text-center p-1" >
                     <p class="mb-0 p1">${ val.brand_name }</p>
                   </div>
                 </div>
               </div> `
              );
          });
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

  // $(document).on('click','.show-brand',function()
  // {
  //   let price=$(this).data('product-id')
  //   brandshow(price)
  // });

  // function brandshow(price)
  // {

  //   $.ajax({
  //             url: baseURL + 'pos/brand/' + price,
  //         }).done(function(res)
  //         {
  //           $('#show_brand_modal').modal('show')
  //           $('.brand-data').empty()
  //           let ph;

  //           $.each(res, function(index, val) 
  //           {
  //            if (val.brand_logo == "" || val.brand_logo == null) 
  //             {
  //                 ph = baseURL + "assets/defaults/product_ph.png";
  //             } else
  //              {
  //                 ph = baseURL + "uploads/brand/" + val.brand_logo;
  //               }
        
  //             $('.brand-data').append(
  //              `
  //               <div class="col-4 " id="sub_category_id" data-brand-id="${val.id}">
  //                <div class="card pos-gradient">
  //                  <img src="${ ph }" class="img-thumbnail card-img" alt="..." style="height:5rem;" loading="lazy">
  //                  <div class="card-body  p-1" >
  //                    <p class="mb-0 p1 font-weight-bold text-center">${ val.brand_name }</p>
  //                    <p class="mb-0 p1 font-weight-bold">Purchasing :<span class="font-weight-normal float-right">${ val.purchasing_price }</span></p>
  //                    <p class="mb-0 p1 font-weight-bold">Selling :<span class="font-weight-normal float-right">${ val.product_price_piece }</span></p>
  //                  </div>
  //                </div>
  //              </div> `
  //            );
  //          });

  //        });
  // }
  
  // $(document).keydown(function(e) 
  // {
  //   if(e.keyCode==87 && (e.shiftKey))
  //   { 
  //     product(id=2,cid=0)
  //     $('#whole').prop('checked',true);
  //     $('#whole').val(1);
  //     $('#retail').prop('checked',false);
  //     $('#retail').val(0);
  //     $('#wholesale').prop('disabled',true);
  //     $('#retailer').prop('disabled',false);
  //   }else if(e.keyCode==82 && (e.shiftKey))
  //   {
  //     product(id=2,cid=0)
  //     $('#whole').prop('checked',false);
  //     $('#whole').val(0);
  //     $('#retail').prop('checked',true);
  //     $('#retail').val(1)
  //     $('#retailer').prop('disabled',true);
  //     $('#wholesale').prop('disabled',false);
  //   }
  // });

  //code for retailer and whole sale
  $('#wholesale').click(function()
   {
      product(id=2,cid=0)
      $('#whole').prop('checked',true);
      $('#whole').val(1);
      $('#retail').prop('checked',false);
      $('#retail').val(0);
      $(this).prop('disabled',true);
      $('#retailer').prop('disabled',false);
    });

   $('#retailer').click(function()
   {
      product(id=2,cid=0)
      $('#whole').prop('checked',false);
      $('#whole').val(0);
      $('#retail').prop('checked',true);
      $('#retail').val(1)
      $(this).prop('disabled',true);
      $('#wholesale').prop('disabled',false);
     
    });

  // $(document).keydown(function(e) 
  // {
  //   if(e.keyCode==87)
  //   {  
  //      let count=$('.customer-tr2')
  //      $.each(count,function(val,index)
  //      {
  //        if($(this).attr('active'))
  //        {
  //          //$(this).children('.r').find('.w').children('.ab').css('color','red')
  //          retail($(this).children('.r').find('.w').children('.ab'))
  //         }
  //       });
       
  //  }else if(e.keyCode==82)
  //  {

  //     let count=$('.customer-tr2')
  //     $.each(count,function(val,index){
  //      if($(this).attr('active'))
  //      {
  //        whole($(this).children('.r').find('.w').children('.ab'))
  //      }

  //     });
  //   }
  // });
  $(document).on('click','.whole_sale_one',function()
   {
       $this=$(this)
       whole($this)
   });

   $(document).on('click','.Retailer_one',function()
   {
       $this=$(this)
       retail($this)
   });
   function whole($this)
   {

    $this.parents('.w').find('input').val(1)
    $this.text('R');
    $this.addClass("Retailer_one");
    $this.removeClass("whole_sale_one");
    $this.css('background','#5CB85C');
   }
   function retail($this)
   {
    $this.parents('.w').find('input').val(0)
    $this.text('W');

    $this.addClass("whole_sale_one");
    $this.removeClass("Retailer_one");
    $this.css('background','#17A2B8');
   }
//code for working clock
      
  clockUpdate();
  setInterval(clockUpdate, 1000);


function clockUpdate() {
  var date = new Date();
  
  function addZero(x) {
    if (x < 10) {
      return x = '0' + x;
    } else {
      return x;
    }
  }

  function twelveHour(x) {
    if (x > 12) {
      return x = x - 12;
    } else if (x == 0) {
      return x = 12;
    } else {
      return x;
    }
  }

  var h = addZero(twelveHour(date.getHours()));
  var m = addZero(date.getMinutes());
  var s = addZero(date.getSeconds());

  $('.digital-clock').text(h + ':' + m + ':' + s)
}



});

