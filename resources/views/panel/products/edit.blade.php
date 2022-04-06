@extends('panel.master')

@section('content')

<form action="{{ route('products.update', ['id' => $product->product_id]) }}" method="POST" id="edit">
	@method('PUT')
	@csrf
	<input type="hidden" name="bid" value="{{$product->id}}">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Brand
								</label>
								
								<select name="brand_id" id="brand_id" class="form-control">
									
									@foreach($brands as $brand)
									@if($brand->id == $product->brand_id) 
									<option value="{{ $brand->id }}" selected >{{ $brand->brand_name }}</option>
									@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Category
								</label>
								<select name="category_id" id="category_id" class="form-control">
									<option value="">Select Category</option>
									@foreach($categories as $category)
									<option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>{{ $category->category_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Sub Category
								</label>
								<select name="sub_category_id" id="sub_category_id" class="form-control">
									<option value="">Select Sub Category</option>
									@foreach($sub_categories as $sub_category)
									<option value="{{$sub_category->id }}" @if($sub_category->id == $product->sub_category_id) selected @endif>{{ $sub_category->sub_category_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Product Name
								</label>
								<x-forms.input name="product_name" value="{{ $product->product_name }}"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Barcode
								</label>
								<x-forms.input name="product_code" value="{{ $product->product_code }}" id="bar_code" autofocus></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									VAT%
								</label>
								<x-forms.input name="gst_tax" placeholder="VAT%" value="{{ $product->gst_tax }}"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Sell By
								</label>
								<x-forms.input name="sell_by" value="{{ $product->sell_by }}"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Unit
								</label>
								<select name="unit_id" id="unit_id" class="form-control">
									<option value="">Select Unit</option>
									@foreach($units as $unit)
									<option value="{{ $unit->id }}" @if($unit->id == $product->unit_id) selected @endif>{{ $unit->unit_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Weight
								</label>
								<x-forms.input name="product_weight" value="{{ $product->product_weight }}"></x-forms.input>
							</div>
						</div>
					</div>
					<div class="row">
						@if($product['sell_by']=='piece' || $product['sell_by']=='piece, unit' || $product['sell_by']=='piece,unit'  )
					  <div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Product Price Pack
								</label>
								<x-forms.input name="product_price_piece" value="{{ $stock->product_price_piece }}"></x-forms.input>
							</div>
						</div>
						
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Price Per Pack Wholesale
								</label>
								<x-forms.input name="product_price_piece_wholesale" value="{{ $stock->product_price_piece_wholesale }}"></x-forms.input>
							</div>
						</div>
						@endif
						@if($product['sell_by']=='unit' || $product['sell_by']=='piece,unit' || $product['sell_by']=='piece, unit'  )
					  <div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Product Price Unit
								</label>
								<x-forms.input name="product_price_unit" value="{{ $stock->product_price_unit }}"></x-forms.input>
							</div>
						</div>
						
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Price Per Unit Wholase
								</label>
								<x-forms.input name="product_price_unit_wholesale" value="{{ $stock->product_price_unit_wholesale }}"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Unit Barcode
								</label>
								<x-forms.input name="unit_barcode" value="{{ $product->unit_barcode }}"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Pack Quentity
								</label>
								<x-forms.input name="pack_quentity" value="{{ $product->pack_quentity }}"></x-forms.input>
							</div>
						</div>
						@endif
					</div>
					<div class="row">
						<div class="col-12">
							<button type="button" id="edit_button_submit" class="btn btn-primary">
								Save
							</button>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</form>

@endsection

@section('script')

@parent

<script>

	$(document).ready(function() {
		
		$('#category_id').change(function() {
			
			$.ajax({
				url: baseURL + `categories/${ $(this).val() }/sub-categories`,
			})
			.done(function(res) {

				$('#sub_category_id').empty();
				$('#sub_category_id').append(`<option value="">Select Sub Category</option>`);
				
				$.each(res, function(index, val) {
					
					$('#sub_category_id').append(`

						<option value="${ val.id }">${ val.sub_category_name }</option>

					`);

				});

			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		});
	});


$(document).ready(function() 
{
    var barcode="";
    $('#bar_code').keydown(function(e) 
    {
        $(this).find('[autofocus]').focus();
            barcode=barcode+String.fromCharCode(code);
            $(this).val(barcode)
        
    });
});
$('#edit_button_submit').click(function(){

	$('#edit').submit();
})
</script>

@endsection