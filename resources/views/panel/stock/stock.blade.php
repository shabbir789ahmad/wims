@extends('panel.master')
@section('content') 


<section class="mb-5 shadow bg-light pt-4">

  <div class="row">
    <div class="col-md-4 mb-4 mb-md-0">

      <div id="mdb-lightbox-ui"></div>

      <div class="mdb-lightbox">

        <div class="row product-gallery mx-1">

          <div class="col-12 mb-0">
            <figure class="view overlay rounded z-depth-1 main-img border">
           
              <img src="{{ asset('uploads/products/' . $products->product_image)}}" width="100%">
              
            </figure>
          </div>
         
        </div>

      </div>

    </div>
    <div class="col-md-8">
      <h5>{{$products['product_name']}}<span class="float-right"><button class="btn btn-info btn-sm mr-3" disabled  data-toggle="modal" data-target="#exampleModal">Update Product</button></span></h5>
           <p class="mb-2 text-muted text-uppercase small">{{$products['product_code']}}</p>
    
           <p class="pt-1">{{$stock}}</p>
           <hr>
      <div class="row">
        <div class="col-md-8">
          
            <div class="table-responsive">
             <table class="table table-sm table-borderless mb-0">
              <tbody>
               <tr>
                <th class="pl-0 w-25" scope="row"><strong>Category</strong></th>
                
                 <td>{{$categories['category_name']}}</td>
              
               </tr>
              <tr>
              <th class="pl-0 w-25" scope="row"><strong>Sub Category</strong></th>
              
              <td>{{$sub_categories['sub_category_name']}}</td>
             
            </tr>
            <tr>
              <th class="pl-0 w-25" scope="row"><strong>Brand</strong></th>
          
              <td  class="mb-5">{{$pbrand['brand_name']}}</td>
              
            </tr>

            <tr>
              
            </tr>
         </tbody>
        </table>
      </div>
        </div>
        
      </div>   
    </div>
  </div>
</section>

<div class="d-flex">
<h3 type="button" class="  mr-1 mb-2" >All Stock </h3>

<button type="button" class="btn btn-primary btn-md add-stock mr-1 mb-2 ml-auto" >Add Stock</button>

</div>




<?php $count=1 ?>
<div class="row">

@foreach($brand_stock as $stock)
 <div class="col-12 col-md-6">
  <div class="card shadow">
   <div class="card-body">
     <h4 class="font-weight-bold">Stock <?php echo $count++ ?>
     
      <span class="float-right">
        <input type="checkbox" data-id="{{$stock['id']}}" name="stock_active" class="js-switchu"  {{ $stock->active == 1 ? 'checked' : '' }} >
        <button class="btn btn-sm btn-info update-stock" data-id="{{$stock['id']}}" data-stock="{{$stock['stock']}}" data-pricepiece="{{$stock['product_price_piece']}}" data-pricepiecew="{{$stock['product_price_piece_wholesale']}}" data-priceunit="{{$stock['product_price_unit']}}"data-priceunitw="{{$stock['product_price_unit_wholesale']}}">Update
        </button>
        <form action="{{ route('stock.delete', ['id' => $stock->id]) }}" method="POST" class="d-inline" onsubmit="return confirmDelete()">
         @method('DELETE')
          @csrf
         <button type="submit" class="btn btn-sm btn-danger"> Delete</button>
        </form>
      </span>
     </h4><br>
     
    
       <p>Pack Stock <span class="float-right">{{$stock['stock']}}</span></p>
       <p>Unit Stock <span class="float-right">{{$stock['stock_sold_kg']}}</span></p>
       <p>Price Per Pack
        @if($stock['product_price_piece'])
        <span class="float-right">{{$stock['product_price_piece']}}</span>
        @else
        <span class="float-right">N/A</span>
        @endif
      </p>
       <p>WholeSale Price Per Pack
        @if($stock['product_price_piece_wholesale'])
        <span class="float-right">{{$stock['product_price_piece_wholesale']}}</span>
      @else
      <span class="float-right">N/A</span>
      @endif
    </p>
    <p>Product price Unit @if($stock['product_price_unit'])
        <span class="float-right">{{$stock['product_price_unit']}}</span>
      @else
      <span class="float-right">N/A</span>
      @endif</p>
      <p>Product price Unit WholeSale @if($stock['product_price_unit_wholesale'])
        <span class="float-right">{{$stock['product_price_unit_wholesale']}}</span>
      @else
      <span class="float-right">N/A</span>
      @endif</p>

       <p>Purchasing Price <span class="float-right">{{$stock['purchasing_price']}}</span></p>
       <p>Creation Date <span class="float-right">{{date('d/m/Y h:m:s A',strtotime($stock['created_at']))}}</span></p>
   </div>
  </div>   
 </div>
 @endforeach

</div>




<!-- Modal -->
<div class="modal fade" id="modal-stock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('stock.add')}}" method="POST">
          @csrf
          <input type="hidden" name="stock_id" value="{{$brands->id}}">
          <label for="">
             New Stock <span class="text-danger">*</span>
          </label>
          <x-forms.input name="stock"></x-forms.input>
          @if($products['sell_by']=='piece' ||$products['sell_by']=='piece,unit'||$products['sell_by']=='piece, unit')
           <label for="">
             Price Per Pack <span class="text-danger">*</span>
           </label>
           <x-forms.input name="product_price_piece"></x-forms.input>
             <label for="">
              Wholesale Price per Pack <span class="text-danger">*</span>
           </label>
           <x-forms.input name="product_price_piece_wholesale"></x-forms.input>
          @endif
          @if($products['sell_by']=='unit'||$products['sell_by']=='piece,unit'||$products['sell_by']=='piece, unit')
          <label for="">
           Price per unit <span class="text-danger">*</span>
          </label>
          <x-forms.input name="product_price_unit"></x-forms.input>
          <label for="">
            Wholesale Price per Unit
            <span class="text-danger">*</span>
          </label>
          <x-forms.input name="product_price_unit_wholesale"></x-forms.input>
         @endif
          <label for="">
             Purchasing Price <span class="text-danger">*</span>
          </label>
          <x-forms.input name="purchasing_price"></x-forms.input>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="stock-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('all.stock')}}" method="POST">
          @csrf
          <input type="hidden" name="id" id="id">
          <label for="">
                  Add More Stock <span class="text-danger">*</span>
                </label>
                <input type="text" name="stock" id="st" class="form-control">
                          @if($products['sell_by']=='piece' ||$products['sell_by']=='piece,unit'||$products['sell_by']=='piece, unit')
           <label for="">
             Price Per Piece <span class="text-danger">*</span>
           </label>
           <x-forms.input name="product_price_piece" id="pricep"></x-forms.input>
             <label for="">
              Wholesale Price per Pack <span class="text-danger">*</span>
           </label>
           <x-forms.input name="product_price_piece_wholesale" id="pricepw"></x-forms.input>
          @endif
          @if($products['sell_by']=='unit'||$products['sell_by']=='piece,unit'||$products['sell_by']=='piece, unit')
          <label for="">
           Price per unit <span class="text-danger">*</span>
          </label>
          <x-forms.input name="product_price_unit" id="priceu"></x-forms.input>
          <label for="">
            Wholesale Price per Unit
            <span class="text-danger">*</span>
          </label>
          <x-forms.input name="product_price_unit_wholesale" id="priceuw"></x-forms.input>
         @endif
         
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('products.update',['id'=>$products->id])}}" method="POST">
          @method('PUT')
          @csrf
          <input type="hidden" name="brand_id" value="{{$products->brand_id}}">
          <input type="hidden" name="category_id" value="{{$products->category_id}}">
          <input type="hidden" name="sub_category_id" value="{{$products->sub_category_id}}">
          <label for="">
                  Product Name<span class="text-danger">*</span>
                </label>
                <x-forms.input name="product_name" value="{{$products->product_name}}"></x-forms.input>
                <label for="">
                  Product Code <span class="text-danger">*</span>
                </label>
                <x-forms.input name="product_code" value="{{$products->product_code}}"></x-forms.input>
                <label for="">
                  Price Per Piece <span class="text-danger">*</span>
                </label>
                <x-forms.input name="product_price_piece" value="{{$products->product_price_piece}}"></x-forms.input>
                 <label for="">
                  Wholesale Price per Piece <span class="text-danger">*</span>
                </label>
                <x-forms.input name="product_price_piece_wholesale" value="{{$products->product_price_piece_wholesale}}"></x-forms.input>
                 
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
         </form>
      </div>
    </div>
  </div>
</div> -->
@endsection

@section('script')
@parent
<script type="text/javascript">
  let elems2 = Array.prototype.slice.call(document.querySelectorAll('.js-switchu'));

elems2.forEach(function(html) {
    let switchery = new Switchery(html,  { size: ' small' });
});
</script>
<script type="text/javascript">
  $('.add-stock').click(function(){
 
  $('#modal-stock').modal('show')
 
  });

   $('.update-stock').click(function(){
 
  $('#stock-update').modal('show')
   let id=$(this).data('id')
   let pricepp=$(this).data('pricepiece')
   let priceppw=$(this).data('pricepiecew')
   let priceuu=$(this).data('priceunit')
   let priceuuw=$(this).data('priceunitw')
   let stock=$(this).data('stock')
 
   $('#pricep').val(pricepp)
   $('#pricepw').val(priceppw)
   $('#priceu').val(priceuu)
   $('#priceuw').val(priceuuw)
   
   
   $('#id').val(id)
   $('#st').val(stock)

  });
</script>
<script type="text/javascript">
 
  $(document).on('change','.js-switchu',function()
  {
   let active=$(this).prop('checked')===true? 1:0;
    $.ajax({
        
        type:'GET',
        url:"/active/stock",
        data:{'id':$(this).data('id'),'active':active},

    }).done(function(res){
     
    }).fail(function(){

    });

  });
</script>

@endsection