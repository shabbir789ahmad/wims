@extends('panel.master')
@section('content')

<div class="row">
 <div class="col-md-4">
     <x-same-code  :categories="$categories" />
 </div>
 <div class="col-12 col-md-4">
   <div class="form-group">
    <label for="">Search by Sub Category <span class="text-danger">*</span>
    </label>
    <select name="sub_category_id[]" id="sub_category_id" class="form-control sub_category_id " multiple>
        @if(request()->query('sub_category'))

        @foreach($sub_categories as $subcategory)
        <option value="{{$subcategory['id']}}" @if(request()->query('sub_category')==$subcategory->id) selected @endif>{{$subcategory['sub_category_name']}}</option>
        @endforeach
        @endif
    </select>
   </div>
  </div>
  <div class="col-md-4">
    <x-same-code2  :brands="$brands"/>
  </div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">

			<form action="{{route('products.get') }}" method="Get">
			<button class="btn btn-primary mt-2 ml-4 create-new-product"  style="width:10%">
					Create New
			</button>
			<div class="card-body pb-0">
				@if(count($products) > 0)
               
                 <x-same-code3  :products="$products" :brands="$brands" :stocks="$stocks" /> 

				@else
				<x-alert.resource-empty resource="products" new="products.create-bulk"></x-alert.resource-empty>
				@endif			
			</div>
		</div>
	</div>
</div>
<form id="sub_category_form">
	<input type="hidden" name="sub_category" id="sub_category">
	<input type="hidden" name="brand_se" id="brand_se">
	<input type="hidden" name="category" id="category">
</form>


@endsection
@section('script')

@parent

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        "paging":   false,
        "ordering": false,
        "info":     false
    } );
} );

 $("#select_all").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
       $('.create-new-product').prop('disabled',false);
});

 $('.create-new-product').click(function(){

    var checked = $("input[type=checkbox]:checked").length;

    if(checked)
    {
    	$('.create-new-product').prop('disabled',false);
    }
    else{
    	 $('.product_checkbox').click(function(){
     if($(this).is(':checked'))
     {
     	$('.create-new-product').prop('disabled',false);
     } else{
        alert ('please Check at Least One product')
        $('.create-new-product').prop('disabled',true);
     }
    	
    });
    	alert ('please Check at Least One product')
      $(this).prop('disabled',true);
    }

$('.my-select').selectpicker();

        
 });

  
  $('#brand_search').change(function(e){
  	e.preventDefault();

  	 var values = [];
        $.each($("#sub_category_id option:selected"), function(){            
            values.push($(this).val());
        });

    //alert (values)
  	 $('#sub_category').val(values)
    
    let idc=$('#category_id').val()
  	$('#category').val(idc)

  	let id=$(this).val()
  	$('#brand_se').val(id)
  	$('#sub_category_form').submit()
  });





</script>
@endsection