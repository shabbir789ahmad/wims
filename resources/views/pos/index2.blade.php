@extends('pos.master')
@section('content')


<div id="snackbar"></div>
<div class="row mt-0 pt-0 printer" id="printer">
    <div class="col-md-12 pt-0 mt-0">
      <div class="d-flex mt-0 pt-0" >
          
           <div class="info mt-0 pt-0"> 
            <p class="heads text-center">اWAHAT AL JAZEERA Rustaq, Souq</p>
             
              <div class="row footer-p" style="display: flex; flex-direction:row;">
              <div class="col-md-6 text-center" style="display: flex; flex-direction:row;width: 50%;" >
               <p >{{ date('d/m/Y h.m.s A') }}</p>
              </div>
              <div class="col-md-6" style="display: flex; flex-direction:column;width: 50%;">
                <div  style="display: flex; flex-direction:row;">
               <p class="ml-1">Invoice Id:#</p>
               <p  class="invoice_id"></p>
               </div>
               <p id="customer_name_print"></p>
               </div>
            </div>
          
            
           </div>
        
          <div class="table-responsive">
            <table class="table ">
              <thead class="table-head">
                <tr class="table-font  " style="display: flex; flex-direction:row; width: 100%;">
                  <th class="col-4" scope="col">PRODUCT</th>
                  <th class="col-2 text-center" scope="col">PRICE</th>
                  <th class="col-2 text-center" scope="col">QTY</th>
                  <th class="col-2 text-center" scope="col">VAT</th>
                  <th class="col-2 text-center" scope="col"> AMOUNT</th>
                  
                </tr>
              </thead>
              
              <tbody id="pos-table2" class="table-font" style="height:20%; ">
              
              </tbody>
            </table>
          </div>
          <div class="table-responsive">
            <table class="table ">
             <tbody id="pos-table3" class="table-font" style="height:20%; ">
              
              </tbody>
            </table>
          </div>
          <div class="card footer">
          <div class="row footer-p" style="display: flex; flex-direction:row;">
              <div class="col-md-6 " style="display: flex; flex-direction:row;width: 50%;" >
               <p class="ml-1">Qty#</p>
               <p class="ml-auto mr-1 font-weight-bold "><span class="items">0</span></p>
              </div>
              <div class="col-md-6" style="display: flex; flex-direction:row;width: 50%;">
               <p class="ml-1">Total VAT RO</p>
               <p class="ml-auto  font-weight-bold g_total3" ></p>
               <!-- <p class=" mr-1 font-weight-bold " >.000</p> -->
               
              </div>
            </div>
            <div class="row footer-p" style="display: flex; flex-direction:row;">
              <div class="col-md-6 " style="display: flex; flex-direction:row;width: 50%;" >
               <p class="ml-1">Total Amount RO</p>
               <p class="ml-auto mr-1 font-weight-bold total_amount g_total2"></p>
              </div>
              <div class="col-md-6" style="display: flex; flex-direction:row;width: 50%;">
               <p class="ml-1">Balance RO</p>
               <p class="ml-auto  font-weight-bold return_amount" >0</p>
               <!-- <p class=" mr-1 font-weight-bold " >.000</p> -->
               
              </div>
            </div>

            <div class="row footer-p" style="display: flex; flex-direction:row;">
               <div class="col-md-6 " style="display: flex; flex-direction:row;width: 50%;" >
               <p class="ml-1 mb-0">Cashier : </p>
               
              
              </div><div class="col-md-6 " style="display: flex; flex-direction:row;width: 50%;" >
               <p class="ml-1 mb-0">{{Auth::user()->name}}</p>
               
              
              </div>
            </div>
            <div class="row footer-p" style="display: flex; flex-direction:row;">
               <div class="col-md-6 " style="display: flex; flex-direction:row;width: 50%;" >
               <p class="ml-1">Time : </p>
               
              
              </div><div class="col-md-6 " style="display: flex; flex-direction:row;width: 50%;" >
              <p class="ml-1">{{ date(' h.m.s A') }}</p>
               
              
              </div>
            </div>


          
          </div>
          <div class="bottom mt-3"style="display: flex; flex-direction:row; justify-content: center;" >
            <h3 class=" footer-total ">Final Total(RO)  :</h3> <h3 class="g_total2 footer-total"></h3>
          </div>

           <div class="footer-print " >

            <p class="text-center mt-2"><strong class="footer-thank">Thanks for Comming</strong> 
              <br>
              <!-- <span>
              <strong class="footer-copy mt-1">Address: گیلن پھا ٹک چیک  9 پتوکی قصور</strong>
            </span> -->
              <span>
              <strong class="footer-copy mt-2">Copyright &copy; {{ date('Y') }} RaqmiTech</strong>
            </span>
            </p>
           
            
          </div>
         </div>

    </div>
  </div>
<!--code for open category and brands-->
<div id="myNav" class="overlay ">
  <div class="nav-color text-light g p-3">Choose Category
    <a href="javascript:void(0)" class="closebtn " ><i class="fas fa-times fa-lg"></i></a>
  </div>
  <div class="overlay-content cg row" id="sub-categories">
   
  </div>
</div>

<div id="myNav2" class="overlay2 i">
  <div class="btn-color text-light p-3">Choose Brand
    <a href="javascript:void(0)" class="closebtn2 " ><i class="fas fa-times fa-lg"></i></a>
  </div>
  <div class="overlay-content2 row cg2" id="brand-content">
   
  </div>
</div><!--end code for open category and brands-->


<div id="myNav3" class="overlay3 i">
  <div class="btn-color text-light p-3">Invoice
    <a href="javascript:void(0)" class="closebtn3 " ><i class="fas fa-times fa-lg"></i></a>
  </div>
  <div class="overlay-content3 row cg3" id="return_content">
   
  </div>
</div><!--end code for open category and brands-->


<div class="container-fluid">
 <div class="row"  style="overflow:hidden">
  <div class="col-12 col-md-6 col-sm-12">
   <div class="row p-2 bg-dark"><!--top navbar right button-->
    <div class="col-sm-3 col-md-3">
      <button class="btn btn-lg hold-sale2 fg font2" data-id="1" id="cateory_sidebar" >Category</button>
    </div>
    <div class="col-sm-3 col-md-3">
     <button class="btn btn-xl order2 fg2 font2" data-id="2" id="brand" >Brand</button>
    </div>
    <div class="col-sm-3 col-md-3">
      <button class="btn btn-xl payment2 fg3 font2" data-id="3" id="feature">Invoice</button>
    </div>
    <div class="col-md-3 col-sm-3">
      <input type="text"  id="tb" class="form-control" placeholder="Barcode scanner code ">
    </div>
   </div><!--end top navbar -->

   <div class="row"><!-- all product with search bar-->
    <div class="col-12 col-md-12 p-0">
      <div class="dropdowns2 hide-mdrop2 d-flex " id="check" tabindex="0">
        <input type="text" placeholder="Search.." class="searchkey2"  id="myInput2" onkeyup="filterFunction2()" data-id="2"><i class="fas fa-times text-light bg-cut p-2 fa-lg" id="search_cut2"></i>
        <div id="myDropdown2" class="dropdown-content d myDropdown2 myDropdown2_height" style="overflow:auto; " tabindex="0">
    
         </div>
      </div>
    </div>
   </div>
  </div>

  <!--secon col start here-->
  <div class="col-12 col-md-6 col-sm-12 bg-color border-left">
    
   <div class="row  nav-color"><!--top navbar right button-->
    <div class="col-sm-2 pt-1 pb-1 col-md-2">
      <a class=" text-light  wims" href="#">WIMS</a>
    </div>
    <div class="col-sm-6 col-md-6 d-inline-block">
     <input type="checkbox" name="retail" id="retail" value="1" class="d-none" checked><button class="btn btn-sm btn-info mt-1 mb-1" id="retailer" disabled>Retailer</button>
     <input type="checkbox"  name="wholesale" id="whole" value="0" class="d-none " ><button class="btn btn-sm btn-info py-1 mt-1 mb-1 ml-2" id="wholesale" >Wholesale</button>
    </div>
    <div class="col-sm-2 col-md-2  d-inline-block">
      <a class="btn-sm btn  btn-info mt-1 mb-1" href="{{route('dashboard')}}">Dashboard</a>
    </div>
    <div class="col-sm-2 col-md-2 d-inline-block">
      <div class="dropdown ">
                     <button class="btn pl-0 mr-2 py-1 px-1 text-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img src="{{asset('uploads/brand/'.Auth::user()->admin_image)}}" class="border rounded-circle" width="40rem"> 
                    </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                       <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Account</a>
                       <a class="dropdown-item" href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> LogOut</a>
                       <a class="dropdown-item" href="#">Something else here</a>
                     </div>
                   </div>
    </div><!--endt top navbar -->
   </div>
   <!--daily sale code start here-->
    <div class="row mt-1 sale-bar font-weight-bold">
       <div class="col-md-3 col-3 ">
       Total Sale
       </div>
      <div class="col-3 col-md-3">
        Recived
      </div>
      <div class="col-md-2 col-2 px-1">
       Expences
       </div>
      <div class="col-2 col-md-2 px-1">
        Payment
      </div>
      <div class="col-2 col-md-2 px-1">
        Net Sale
      </div>
    </div>
    <div class="row">
       <div class="col-md-3 col-3 p-1 pl-2">
         <input type="text" class="form-control input-top p-0" id="total_sale" readonly>
       </div>
      <div class="col-3 col-md-3 p-1">
        <input type="text" class="form-control input-top p-0" id="total_recived" readonly>
      </div>
      <div class="col-md-2 col-2 p-1">
      
        <input class="form-control input-top border-right-0 p-0" id="expense" readonly>
      </div>
      <div class="col-2 col-md-2 p-1 pr-2">
         <input type="text" class="form-control input-top p-0" id="payable" readonly>
      </div>
      <div class="col-2 col-md-2 p-1 pr-2">
         <input type="text" class="form-control input-top p-0" id="net-sale" readonly>
      </div>
    </div><!-- daily sale code end here-->
    <div class="row"><!--sale item code here-->
     <div class="col-12 col-md-12 p-1">
      <div class="table-responsive table_height"  style=" overflow-y: auto; width: 100%; ">
          <table class="table w-100" >
            <thead class="table-head">
                <tr class="table-font">
                  <th scope="col">Product</th>
                  <th scope="col">Sell</th>
                  <th scope="col">Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">VAT</th>
                  <th scope="col">Type</th>
                  <th scope="col">Total</th>
                  <th scope="col">Op</th>
                    
                  
                </tr>
            </thead>
              
            <tbody id="pos-table">
              
            </tbody>
            <tbody id="pos-table1">
              
            </tbody>
          </table>
       </div>
       <div class="card">
          <div class="row ">
              <div class="col-md-6 d-flex">
               <p class="ml-1">Item</p>
               <p class="ml-auto mr-1 font-weight-bold "><span class="items"></span><span class="quan">(0)</span></p>
              </div>
              <div class="col-md-6 d-flex">
               <p class="ml-1">Total VAT(RO)</p>
               <p class="ml-auto mr-1 font-weight-bold g_total3"></p>
             
              </div>
            </div>
            <div class="row border-top">
              <div class="col-md-6 d-flex">
               <p class="ml-1" >Expenses <i class="far fa-edit" data-toggle="modal" data-target="#frate-modal"></i></p>
               <p class="ml-auto mr-1 font-weight-bold" id="tax">0</p>
              </div>
              <div class="col-md-6 d-flex">
               <p class="ml-1">Discount <i class="far fa-edit disc-modal"></i></p>
               <p class="ml-auto mr-1 font-weight-bold" id="discount">0</p>
              </div>
            </div>
        </div>
        <div class="bottom  nav-color" ><!-- total code -->
            <h3 class="text-center text-light">Final Total(RO)  :<span class="g_total2" ></span><small>+VAT</small></h3>
            <span class="d-none" id="g_total"></span>
        </div><!-- total code here end-->
        <div class="d-flex flex-direction-row mt-1 justify-content-center" id="payment_button">
            <button type="button" class="btn cancel font" id="cancel">Cancel</button>
            <button type="button" class="btn order partial-payment2 font" data-id="1" disabled>Temporary Account</button>
            <button type="button" class="btn hold-sale partial-payment2 font" data-id="0" disabled>Permanent Account</button>
            <button type="button" class="btn payment font" tabindex="0" id="payment">Payment</button>
            <!-- <button type="button" class="btn payment print" >Print Recipt</button> -->
          </div>
     </div>
    </div><!-- daily item sale code end here-->

  </div>
 </div>
</div>


<!--expense for product Modal -->
<div class="modal fade" id="expense-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Today Expenses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="" method="POST">
      <div class="modal-body">
        <label class="font-weight-bold">Expense Type</label>
        <div class="d-flex">
          
               <select class="form-control" id="e_type" focuse>
                </select>
                <i class="fas fa-plus-square text-info fa-2x text-center px-2" id="expense_type">f</i>
              </div>
        <label class="font-weight-bold">Expense</label>
        <input type="number" class="form-control" id="expense_price"  >
        <label class="font-weight-bold">Name</label>
        <input type="text" class="form-control" id="e_name"  >  
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" id="expense-button">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>



<!--discount for product Modal -->
<x-discount-component />
<!--tax for product Modal -->
<x-tax-component />
<!--payment  Modal -->
<!--partial payment  Modal -->
<x-full-payment-component />
<x-payment-component />

<!--customer payment payment  Modal -->
<div class="modal fade bd-example-modal-lg" id="customer-payment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">All Recievable Amounts</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="row mt-2">
      <div class="col-md-11 mx-auto d-flex">
        
        <button type="button" class="btn orders w-100" data-id="2" id="partial-order">Temporary Account </button>
       <button type="button" class="btn hold-sale  w-100" data-id="3" id="permanant-order">Permanant Account </button>
       </div>
     </div>
     
    
    <div class="partial-accout" id="partial-account" >
      
      <div class="row mt-1 mb-1">
       <div class="col-md-11 mx-auto d-flex pt-0">
        <div class="dropdowns hide-mdrop ">
          <input type="text" placeholder="Search.."  class="mt-2"  id="myInput" onkeyup="filterFunction()" data-id="1">
         <div id="myDropdown" class="dropdown-conte mt-3" style="">
    
          </div>
        </div>
       </div>
      </div>
      
    </div>
    <div class="partial-accout" id="permanant-account" style="display:none">
     
      <div class="row mt-1 mb-1">
       <div class="col-md-11 mx-auto d-flex pt-0">
         <div class="dropdowns3 hide-mdrop ">
          <input type="text" placeholder="Search.." class="mt-2"  id="myInput3" onkeyup="filterFunction3()" data-id="2">
         <div id="myDropdown3" class="dropdown-conte mt-3" style=" ">
    
          </div>
        </div>
       </div>
      </div>

       
    </div>
    </div>
  </div>
</div>



<!--select unit type for product Modal -->
<div class="modal fade" id="select_unit_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Type of Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" id="kedown2" tabindex="0">
        <div class="d-flex">
          <button class="btn btn-xl w-50 btn-color " id="piece" data-piece="piece">Pack</button>
          <button class="btn hold-sale w-50 btn-xl" id="unit" data-unit="unit">Unit</button>
        </div>
         <div class=" mt-2 " id="unit_qu" style="display: none;" >
          
           <label id="unit_label" class="font-weight-bold"></label><br>
           <input type="number" class="form-control" id="select_quentity_kg2" autofocus>
         </div>

      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" id="apply_unit">Apply Unit</button>
        
      </div>
    </div>
  </div>
</div>
<!--select unit quentity for product Modal -->
<div class="modal fade" id="select_quentity_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Sell By Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body "  id="kedown">
        <div class="row">
          <div class="col-md-12 col-12">
           <label id="unit_quen" class="font-weight-bold"></label>
           <input type="number" class="form-control " id="select_quentity_kg" autofocus>
          </div>
          
        </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" id="apply_quentity">Apply Unit</button>
      </div>
    </div>
  </div>
</div>

<!--show brand for product Modal -->
<div class="modal fade" id="show_brand_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Sell By Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body " >
        <div class="row brand-data">
         
          
        </div>
      </div>
      <div class="modal-footer">
        
        
      </div>
    </div>
  </div>
</div>

<!-- add cusomer modal -->
  <x-customer-add  />
<x-expense-component  />
<x-frate-component  />
<x-payable-amount-component  />

@endsection
@section('script')
@parent
 <script>

function snack(i,message) {

  var x = document.getElementById("snackbar");
  x.className = "show";
  if(i==0)
  {
    x.innerHTML=message;
    x.style.backgroundColor ="red"
  }else{
     x.innerHTML=message;
     x.style.backgroundColor ="green"
  }
  
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>

<script>

   
function filterFunction() {

  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");

  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;

    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
function filterFunction2() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown2");
  d = document.getElementById("prd");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

function filterFunction3() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput3");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown3");

  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

</script>
<script>
  
$(document).ready(function()
 {
  $(function() {
   $('#tb').focus();
  
  });
  $(document).on('keydown','#check',function(e) 
   {
     switch (e.which) {
        case 40:
        case 99:
            if($(".customer-tr2[active]").length == 0) 
                $(".customer-tr2:first()")
                .attr('active','1')
                .css({'background-color':'#3E065F','color':'#ffffff'});
         
            else
                $(".customer-tr2[active]")
                .removeAttr('active')
                .css({'background-color':'#ffffff','color':'#000000'})
                .next()
                .attr('active','1')
                .css({'background-color':'#3E065F','color':'#ffffff'});
                
                brndtip();
                //travel();
        break;
        case 38:
        case 105:
            if($(".customer-tr2[active]").length==0)
                $(".customer-tr2:last()")
                .attr('active','1')
                .css({'background-color':'#3E065F','color':'#ffffff'});
              
            else
                $('.customer-tr2[active]')
                .removeAttr('active')
                .css({'background-color':'#ffffff','color':'#000000'})
                .prev()
                .attr('active','1')
                .css({'background-color':'#3E065F','color':'#ffffff'})  
                brndtip();
                //travel();
         break;
      }


  });


  $(document).on('keydown','#check',function(e) 
   {
     switch (e.which) 
     {
        case 39:
           $.each($('.brand_active'),function(index,val)
           {
             if($(this).attr('active2')==1)
             {
                if($(this).find(".pos-product[active]").length ===0)
                {
                   $(this).find('.pos-product:first()')
                   .attr('active','1')
                   .css({'background-color':'#5CB85C','color':'#3E065F'});
                }else
                {
                  $(this).find('.pos-product[active]')
                  .removeAttr('active')
                  .css('background-color','#000000')
                  .next()
                  .attr('active','1')
                  .css({'background-color':'#5CB85C','color':'#3E065F'});
               }

             }else
              {
                 $(this).find(".pos-product[active]")
                 .removeAttr('active')
                 .css('background-color','#000000');
              }
            });
        break;
        case 37:
            $.each($('.brand_active'),function(index,val)
            {
             if($(this).attr('active2')==1)
             {
                if($(this).find(".pos-product[active]").length ===0)
                {
                   $(this).find('.pos-product:last()')
                   .attr('active','1')
                   .css({'background-color':'#5CB85C','color':'#3E065F'});
                }else
                {
                  $(this).find('.pos-product[active]')
                  .removeAttr('active')
                  .css('background-color','#000000')
                  .prev()
                  .attr('active','1')
                  .css({'background-color':'#5CB85C','color':'#3E065F'});
               }

             }else
              {
                 $(this).find(".pos-product[active]")
                 .removeAttr('active')
                 .css('background-color','#000000');
              }
            });

        break;
      }
   });



 $(document).on('keydown','#check',function(e) 
  {
    if(e.which==13)
     {
      $.each($('.customer-tr2'),function(val,index)
       { 
        if($(this).attr('active')=='1')
        {
          let mult_brand=$(this).children('.r').find('.brn').find('.dropdown');
          let sing_brand=$(this).children('.r').find('.brn').find('.single_brand')
          if(mult_brand.length)
          {
            $.each($('.brand_active'),function(val,ind)
            {
              if($(this).attr( "active2" )==1)
              {
                $.each($(this).find(".pos-product"),function(s,d)
                {
                 if($(this).attr('active')==1)
                  {
                    $this=$(this);
                    alldata($this);
                  }
                });
              }else
              {
                //alert ('please select a brand')
              }
            });
          }else if(sing_brand.length)
         {
           if(sing_brand.attr('active')==1)
          {
              
              $this=sing_brand;
              alldata($this);
          }

         }
      
       }else
      {
         //FGDGKFG
      }
     });
    }
  });


  
   $(document).on('click', '.pos-product', function(event)
    {
    
      alldata($(this));
         
    });
   function alldata($this)
   {
         $('#piece').prop('disabled', false);
         $('#unit').prop('disabled', false);
         let id=$this.data('product-id');
         let sell=$this.data('sell_by');
         let unit=$this.data('unit');
         let product_code=$this.data('barcode');
         let unit_code=$this.data('unitcode');
         let brand_id=$this.data('brand');
         let pid=$(".order_p_id").val()
         let whole= $('#whole').val();
         let retail= $('#retail').val();
         let wholesale_one=$this.parents('.brn').siblings('.w').find('input').val()
         
         saleProduct(id,sell,unit,brand_id,pid,whole,retail,wholesale_one,product_code,unit_code);
   }

 function saleProduct(id,sell,unit,brand_id,pid,whole,retail,wholesale_one,product_code,unit_code)
  {
    // alert(wholesale_one)
    let price='';
    let price2='';
    let type='';
    let quentity='';
    if(whole==1){ type="whole"; } else { type="retail";}
    
    if(sell=='piece' || sell=='fruit')
    {  
   
       $('#check').focus();
       let barcode=product_code;
        getorders(id,quentity,unit,sell,brand_id,type,wholesale_one,barcode);
    
    }else if(sell == 'unit')
    { 
      
           
          $('#select_quentity_modal').modal('show')
          $('#select_quentity_modal').on('shown.bs.modal', function()
           {
              $(this).find('[autofocus]').focus();
              
            });
          //enter to add product to cart with sell by unit
          $('#check').blur();
          $('#kedown').off().on('keydown',function(e)
          {
              if(e.which==13) 
               {
                 $('#apply_quentity').trigger('click');
                 e.stopPropagation();
               }
          });
          //Click to add product to cart with sell by unit
          $('#apply_quentity').off().on('click', function()
          {
                let barcode=unit_code;
                quentity=$('#select_quentity_kg').val();
                getorders(id,quentity,unit,sell,brand_id,type,wholesale_one,barcode);
                $('#select_quentity_modal').modal('hide')
                document.getElementById("select_quentity_kg").value = '';
          });

    //if product sell by piece unit both
    }else if(sell=='piece, unit' || sell=='piece,unit')
    {
        $('#select_unit_type').modal('show');
        $('#select_unit_type').on('shown.bs.modal', function() 
        {
             $(this).find('[autofocus]').focus();
        });

        //kedown event code
        $('#select_unit_type').off().on('keydown',function(e)
        { 
           let p=$('#piece').is(':disabled')
           let u=$('#unit').is(':disabled')
           //enter if piece button is not dissabled
           if(e.which==13 && p==false)
           {
              $('#piece').trigger('click');
              e.stopPropagation();
          
           //enter if unit button is not dissabled
           }else if(e.which==13 && u==false)
           { 
                let q_kg=$('#apply_unit')
                .parents('.modal-footer')
                .siblings('.modal-body')
                .children('#unit_qu')
                .children('#select_quentity_kg2')
                .val();
              
               
                getorders(id,q_kg,unit,sell,brand_id,type,wholesale_one);
                $('#select_unit_type').modal('hide');
                $('#unit_qu').css('display','none');
                $('#select_quentity_kg2').val('');
            } 
           //disable piece button with right arrow keys
           if(e.which== 39 )
           {
                $('#unit').css('background-color', '#5CB85C');
                $('#piece').css('background-color', '#17A2B8');
                $('#piece').prop('disabled', true);
                $('#unit').prop('disabled', false);
                $('#unit_qu').css('display','block')
            }
            //disable unit button with left arrow key 
            if(e.which==37)
            {
                $('#unit').prop('disabled', true);
                $('#unit').css('background-color', '#3E065F');
                $('#piece').css('background-color', '#5CB85C');
                $('#piece').prop('disabled', false);
                $('#unit_qu').css('display','none')
                $('#apply_unit').find('[autofocus]').focus();
            }
           
        });

        //click event code for piece unit
        $('#piece').off().on('click', function()
        {
            $(this).prop('disabled', true);
            let quentity='';
       
           barcode=product_code;
            getorders(id,quentity,unit,sell,brand_id,type,wholesale_one,barcode);
            $('#select_unit_type').modal('hide');
        });

        //unit click for sell by piece and unit
        $('#unit').click(function()
        {
          if(unit==4)
          {
              $('#unit_label').text('Product Quentity In Kg')
              $('#select_quentity_kg2').attr("placeholder", " Type 1 for 1 kg")
          
          }else if(unit== 2)
          {
              $('#unit_label').text('Product Quentity In Fit')
              $('#select_quentity_kg2').attr("placeholder", "Type 1 for 1 Fit")
          }

            $(this).prop('disabled', true);
            $('#piece').prop('disabled', false);
            $('#unit_qu').css('display','block');
                  
            $('#apply_unit').off().on('click', function() 
            {
              let q_kg=$(this)
              .parents('.modal-footer')
              .siblings('.modal-body')
              .children('#unit_qu')
              .children('#select_quentity_kg2')
              .val();
              barcode=unit_code;
              
              getorders(id,q_kg,unit,sell,brand_id,type,wholesale_one,barcode);
              $('#select_unit_type').modal('hide');
              $('#unit_qu').css('display','none');
              $('#select_quentity_kg2').val('');
            
            });
        });
      }
  }


var barcode="";
    $('#tb').change(function(e) 
    {
        let str=$(this).val()
             $.ajax({
                cache:false,
                url : "/order/scanner",
                type : 'GET',
                data:
                   {
                 
                      id : str,
                    
                    }  
              }).done(function(res)
              {
                if(typeof(res)=== "string")
                {
                   alert(res);
                   $('#tb').find('[autofocus]').focus();
                $('#tb').val('');
                }else{

                $('#tb').find('[autofocus]').focus();
                $('#tb').val('');
                let id=res.product_id;
                let quentity=1;
                let unit=res.unit_id;
                
                let barcode=str;
                
 
                let brand_id=res.id;
                let sell=res.sell_by;
                let whole= $('#whole').val();
               let retail= $('#retail').val();
               let wholesale_one=1;
               if(whole==1){ type="whole"; } else { type="retail";}
                getorders(id,quentity,unit,sell,brand_id,type,wholesale_one,barcode);
              }
              });


        
    });


  function getorders(id,quentity,unit,sell,brand_id,sell_type,wholesale_one,barcode)
    {
 
      if(quentity==''){ quentity=1; }
      $.ajax({
                cache:false,
                url : "/order/session",
                type : 'POST',
                data:
                   {
                      "_token": $('#csrf-token')[0].content ,
                      id : id,
                      quentity_kg :quentity ,
                      sell_by :sell ,
                      unit:unit,
                      brand_id :brand_id ,
                      sell_type : sell_type ,
                      wholesale_one:wholesale_one,
                      barcode:barcode,
                    
                    }  
              }).done(function(res)
              {
                
                if(res.success)
                {
                  snack(1,res.success)
                }else{
                  snack(0,res.fail)
                }
                
                appenProduct(res) 

              }).fail(function(res)
              {
                 appenProduct(res)
                 alert ('could not complete order');

              }).always(function() 
              {
                console.log("complete");
                checkFont2()
             });
    }


function checkFont2()
{
   let count=$('.table-product ')
   $.each(count,function(val,l)
   {
      font=$(this).children('.product_name').find('.name').text()
      if(font.length > 25)
      {
        $(this).children('.product_name').find('.name').css('margin-top','4%')
     }else
     {
      $(this).children('.product_name').find('.name').css({'margin-top':'1%','margin-left':'2%','padding-top':'5%'})
     }
   });
}

});  
</script>


<script type="text/javascript">

 $('#brand_search').change(function(e)
   {
      e.preventDefault();
      var values = [];
      $.each($("#sub_category_id option:selected"), function()
      {            
         values.push($(this).val());
      });

      $('#sub_category').val(values)
    
      let idc=$('#category_id').val()
      $('#category').val(idc)

      let id=$(this).val()
      $('#brand_se').val(id)
      $('#sub_category_form').submit()
  });


 function subQuentity()
 {
    var q=0;
    $('.sub_q').each(function()
    {
       if(!isNaN(this.value) && this.value.length!=0) 
        {
          q += parseFloat(this.value);            
        }

    });

    $('.quan').text('('+q+')')
  }

  
  
function brndtip()
{
    let count=$('.customer-tr2')
    $.each(count,function(val,index)
    { 
     if($(this).attr('active')=='1')
      {
        let mult_brand=$(this).children('.r').find('.brn').find('.dropdown')
        let sing_brand=$(this).children('.r').find('.brn').find('.single_brand')
        
        if(mult_brand.length)
        {
          mult_brand.find('.dropdown-menu').css('display','block')
          mult_brand.find('.dropdown-menu').attr('active2','1')
        
        }else if(sing_brand.length)
        {
           sing_brand.css('background-color','#5CB85C')
           sing_brand.attr('active','1')
        }
        
      }else
      {

        let mult_brand=$(this).children('.r').find('.brn').find('.dropdown')
        let sing_brand=$(this).children('.r').find('.brn').find('.single_brand')
        
        if(mult_brand.length)
        {
           mult_brand.find('.dropdown-menu').css('display','none')
           mult_brand.find('.dropdown-menu').attr('active2','0')

        }else if(sing_brand.length)
        {
           sing_brand.css('background-color','#17A2B8')
           sing_brand.attr('active','0')
        }
      }

     $.each($('.dropdown-menu'),function(val,index)
        {
         if($(this).attr('active2')==1)
         {
          $(this).find('.dropdown-item:first()').attr('active','1').css('background-color','#5CB85C');
         }
        });
   });

}
//this quentityCount function is called at line number 556,534 and 670 ,
 function quentityCount()
  {
   let number='';
    $("#pos-table").each(function() 
    { 
       number=$('#pos-table').children().length
    });
           
       $('.items').text(number)
       $('.quan').text('('+number+')')
  }

//this sumCount function is called at line number 569 and 536
 function sumCount()
 {
   let sum = 0;        
   $(".sub_total").each(function() 
   {         
     if(!isNaN($(this).val()) && $(this).val().length!=0) 
      {
        sum += parseFloat($(this).val());    
      }         
   });
  
   let sum2 = 0;        
   $(".vat").each(function() 
   {         
     if(!isNaN($(this).val()) && $(this).val().length!=0) 
      {
       sum2 += parseFloat($(this).val());    
      }         
   });
 
       sum2=Number.parseFloat(sum2).toFixed(2)   
        $('.g_total3').text(sum2)
        // sum=parseFloat(sum) + parseFloat(sum2) ; 
        //sum= Number.parseFloat(sum).toFixed(2)

    let d=$('#discount').text()
    let tax=$('#tax').text()
    if(parseFloat(d)!==0)
    {
 
      sum=sum-d;
     
      sum=Number.parseFloat(sum).toFixed(2)
      $('.grand_total').val(sum)
      $('#g_total').text(sum)
      $('.g_total2').text(sum)
    
    }
    
     sum=Number.parseFloat(sum).toFixed(2)
      $('#g_total').text(sum)
      $('.g_total2').text(sum)
    

    if(tax)
    {
      sum=sum+ parseInt(tax);
      $('.grand_total').val(sum)
      $('#g_total').text(sum)
      $('.g_total2').text(sum)
    }
 }

             


function appenProduct(res)
{ 

  let name='';
  $('#pos-table').empty()
  $.each(res.data,function(key,item)
  {   
     
    let sub=item.sub_total;
    let gst_tax=item.gst;
    sub_total=Number.parseFloat(sub).toFixed(3)
    gst_tax=Number.parseFloat(gst_tax).toFixed(3)
    let apend=`
      <tr class="border-bottom table-product" style="height:1rem;">
          <input type="hidden" class="form-control unt" value="${item.unit_id}" readonly>
          <input type="hidden" class="form-control brand_id" value="${item.brand_table_id}" readonly>
          <input type="hidden" class="form-control order_p_id" value="${item.pid}" readonly> 
          <input type="hidden" class="form-control pid"  id="cart_id" value="${item.id}" >
         <td class=" p-0 col-3 product_name" id="product_name" style="width:30%; word-wrap: break-word;" >
           <p class="name">${item.name} </p>
         </td>
         <td class="p pt-2 col-1  p-0 sell_by" style="width:3%;" >
           <input type="text" value="${item.sell_by.charAt(0).toUpperCase() }" class="form-control sel mt-1" readonly>
         </td>
         <td class="price col-2 pt-2 p-0">
           <input type="number" class="w-100 mt-1 ml-1 form-control new_price" onfocus=" let value = this.value; this.value = null; this.value=value" value="${item.price}" readonly>
         </td>
         <td class="p-0 q col-1 pt-2 ">
            <input type="text"  value="${item.quantity}" class="w-75 mt-1 ml-3 quentity sub_q form-control">
         </td>
         <td class="pt-2 p-0 col-2">
            <input type="text" value="${gst_tax}" class="form-control vat mr-2 mt-1 w-100" readonly>
         </td>
         <td class="pt-2 p-1 col-1">
            <input type="text" value="${item.sell_type.charAt(0).toUpperCase()}" class="form-control text-center p-0 mt-1 w-100" readonly>
         </td>
         <td class="p-0 pt-2 ds col-2" style="width:14%">
            <input type="txt" id="sub_total" value="${sub_total}" class=" form-control sub_total mt-1 w-100 " readonly></td>
         <td  class="rm col-1"><i class="fas fa-trash-alt text-danger border p-2 rounded bg-dark delete" ></i>
         </td>
      </tr> `;
     
     $('#pos-table').append(apend);
     quentityCount();
     sumCount();
  
            
  });
               
  $("#td").focus()
               
}



     
      
</script>

@endsection