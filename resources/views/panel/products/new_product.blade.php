@extends('panel.master')
@section('content')

<form action="{{ route('products.copyBulk') }}"  method="POST" enctype="multipart/form-data">
	@csrf

<div class="card" >
	<div class="card-body">
   <div class="row">
  	<div class="col-12 col-md-4">
				<div class="form-group">
					<label for="">
						Change Product Brand<span class="text-danger">*</span>
					</label>
					<select class="form-control " id="brand"  name="brand_id">
						@foreach($brands as $brand)
						<option value="{{$brand['id']}}">{{$brand['brand_name']}}</option>
						@endforeach
					</select>
					
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label for="">
						Product Category <span class="text-danger">*</span>
					</label>
					<select class="form-control " name="category_id[]">
						@forelse($categories as $category)
						@foreach($products as $product)
						@if($product['category_id']==$category['id'])
						@if($loop->first)
						<option value="{{$category['id']}}">{{$category['category_name']}}</option>
            @endif
            @endif
						@endforeach
						@empty

						@endforelse
					</select>
				</div>
			</div>
      <div class="col-12 col-md-4">
				<div class="form-group">
					<label for="">
						Product Sub category<span class="text-danger">*</span>
					</label>
					<select class="form-control sub_cat_form" >
						@forelse($sub_categories as $sub_category)
						@foreach($products as $product)
						@if($product['sub_category_id']==$sub_category['id'])

						<option value="{{$sub_category['id']}}" >{{$sub_category['sub_category_name']}}</option>
						
						@endif
						@endforeach
						@empty

						@endforelse
					</select>
				</div>
			</div>
		
    </div>
	</div>
</div>
<div id="product-field" class="col-12">
  <div class="row">
	  <div class="col-12 ">
		  <div class="card">
			  <div class="card-body pb-0">
				  <div class="form-group">
					  <x-btn.save type="submit"></x-btn.save>
				  </div>
			  </div>
		  </div>
	  </div>
  </div>
</div>
<!--product-->
 <div class="row">
  <div class="col">
   @if($products)
   @foreach($products as $product)
   <div class="card mt-5">
	 <div class="card-body">
	 	<div class="row d-none">
	 		<div class="col-12 col-md-4">
				<div class="form-group">
					<input type="text" class="" name="product_id[]" value="{{$product['id']}}">
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					
				</div>
			</div>
		
		 </div>
	   <div class="row">
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label for="">
						Product Name <span class="text-danger">*</span>
					</label>
					<x-forms.input name="name[]" value="{{$product['product_name']}}"></x-forms.input>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label for="">
						Product BarCode
					</label>
					<x-forms.input name="product_code[]" value="{{$product['product_code']}}"></x-forms.input>
				</div>
			</div>
			 
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label for="">
						Product Stock<span class="text-danger">*</span>
					</label>
				
					
					
           <input type="text" name="stock[]" value=" {{\App\Models\ProductStock::where(['pbrand_id' => $product->brand->id])->pluck('stock')->first()}} " class="form-control">
					
				
				</div>
			</div>
			
		 </div>
		
		<div class="row">
			<div class="col-12 col-md-3 @if($product['sell_by']=='piece' || $product['sell_by'] == 'piece,unit' || $product['sell_by'] == 'piece, unit') d-block @else d-none @endif">
				<div class="form-group">
					<label for="">
						Product Price Pack <span class="text-danger">*</span>
					</label>
					@if($product->brand)
					<x-forms.input name="product_price_piece[]" value="{{\App\Models\ProductStock::where(['pbrand_id' => $product->brand->id])->pluck('product_price_piece')->first()}}"></x-forms.input>
					@else
           <x-forms.input name="product_price_piece[]" value=""></x-forms.input>
					@endif
				</div>
			</div>
     <div class="col-12 col-md-3 @if($product['sell_by']=='piece' || $product['sell_by'] == 'piece,unit' || $product['sell_by'] == 'piece, unit') d-block @else d-none @endif">
				<div class="form-group">
					<label for="">
						Product Price Pack Wholesale <span class="text-danger">*</span>
					</label>
					@if($product->brand)
					<x-forms.input name="product_price_piece_wholesale[]" value="{{\App\Models\ProductStock::where(['pbrand_id' => $product->brand->id])->pluck('product_price_piece_wholesale')->first()}}"></x-forms.input>
					@else
           <x-forms.input name="product_price_piece_wholesale[]" value=""></x-forms.input>
					@endif
				</div>
			</div>
		
			
			<div class="col-12 col-md-3 @if($product['sell_by']=='unit' || $product['sell_by'] == 'piece,unit' || $product['sell_by'] == 'piece, unit') d-block @else d-none @endif">
				<div class="form-group">
					<label for="">
						Product Price Unit <span class="text-danger">*</span>
					</label>
					@if($product->brand)
					<input type="text" name="product_price_unit[]" value="{{\App\Models\ProductStock::where(['pbrand_id' => $product->brand->id])->pluck('product_price_unit')->first()}}" class="form-control">
					@else
           <input type="text" name="product_price_unit[]" value="" class="form-control">
					@endif 
				</div>
			</div>
			<div class="col-12 col-md-3 @if($product['sell_by']=='unit' || $product['sell_by'] == 'piece,unit' || $product['sell_by'] == 'piece, unit') d-block @else d-none @endif ">
				<div class="form-group">
					<label for="">
						Product Price Unit Wholesale<span class="text-danger">*</span>
					</label>
					@if($product->brand)
					<input type="text" name="product_price_unit_wholesale[]" value="{{\App\Models\ProductStock::where(['pbrand_id' => $product->brand->id])->pluck('product_price_unit_wholesale')->first()}}" class="form-control">
					@else

           <input type="text" name="product_price_unit_wholesale[]" value="" class="form-control">
					@endif 
				</div>
			</div>
			
			<div class="col-12 col-md-3">
				<div class="form-group">
					<label for="">
						Purchasing Price<span class="text-danger">*</span>
					</label>
					@if($product->brand)
					<input type="text" name="purchasing_price[]" value="{{\App\Models\ProductStock::where(['pbrand_id' => $product->brand->id])->pluck('purchasing_price')->first()}}" class="form-control">
					@else
           <input type="text" name="purchasing_price[]" value="" class="form-control">

					@endif
				</div>
			</div>

		</div>
	 </div>
	</div>
	@endforeach
	@endif
	</div>
  </div>
</form>


@endsection
@section('script')

@parent

<script type="text/javascript">
	
	$('#brand').change(function(){
   
    let brand=$(this).val()
    let text=$("#brand option:selected").text();
    $('#b_id').val(brand)
    $('#b').val(text)
   
	});
</script>
<!-- <script type="text/javascript">


	$('#upload-photo').change(function() {

	   updateImageSrc(document.getElementById('upload-photo'), document.getElementById('preview'));
      });

	$('.sell_by_change').change(function(){
 
    alert ('dfdf')

	});

</script> -->
<!-- <script type="text/javascript">
	$('#category_id').change(function(e){
		e.preventDefault()
      
		let value=$(this).val();
		let product=$("#category_id option:selected").text();

        $('.cat_form').empty();
	    $('.cat_form').append('<option value="'+ value+'">'+ product+'</option>');
	});

	$('#sub_category_id').change(function(e){
		e.preventDefault()
      
		let value=$(this).val();
		let product=$("#sub_category_id option:selected").text();
        //alert ('df')
        $('.sub_cat_form').empty();
	    $('.sub_cat_form').append('<option value="'+ value+'">'+ product+'</option>');
	});
</script> -->

@endsection