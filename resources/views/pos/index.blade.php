@extends('pos.master')
@section('content')
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


<!-- //left side -->

<div class="container-fluid">
 <div class="row"  style="overflow:hidden">
  <div class="col-12 col-md-6 col-sm-12">
   <div class="row p-2 bg-dark"><!--top navbar right button-->
    <div class="col-sm-4 col-md-3">
      <button class="btn btn-lg hold-sale2 fg font2" data-id="1" id="cateory_sidebar" >Category</button>
    </div>
    <div class="col-sm-4 col-md-3">
     <button class="btn btn-xl order2 fg2 font2" data-id="2" id="brand" >Brand</button>
    </div>
    <div class="col-sm-4 col-md-3">
      <button class="btn btn-xl payment2 fg3 font2" data-id="3" id="feature">Invoice</button>
    </div>
    <div class="col-md-3">
      <input type="text"  id="tb" class="form-control" placeholder="Barcode scanner code ">
    </div>
   </div><!--end top navbar -->

   <div class="row"><!-- all product with search bar-->
    <div class="col-12 col-md-12 p-0">
      <div class="dropdowns2 hide-mdrop2 d-flex " id="check" tabindex="0">
        <input type="text" placeholder="Search.." class="searchkey2"  id="myInput2" onkeyup="filterFunction2()" data-id="2"><i class="fas fa-times text-light bg-cut p-2 fa-lg" id="search_cut2"></i>
        <div id="myDropdown2" class="dropdown-content d myDropdown2" style="overflow:auto" tabindex="0">
    
         </div>
      </div>
    </div>
   </div>
  </div>

 
    
 </div>
</div>

@endsection