@extends('panel.master')

@section('content')

<form id="_ajaxRequest" action="{{ route('products.storeBulk') }}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-md-3">
							<div class="form-group">
								<label for="">
									Brand <span class="text-danger">*</span>
								</label>
								<select name="brand_id" id="brand_id" class="form-control">
									<option value="">Select Brand</option>
									@foreach($brands as $brand)
									<option value="{{ $brand->id }}" @if($brand->id == $brand_id) selected @endif>{{ $brand->brand_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12 col-md-3">
							<div class="form-group">
								<label for="">
									Category <span class="text-danger">*</span>
								</label>
								<select name="category_id" id="category_id" class="form-control">
									<option value="">Select Category</option>
									@foreach($categories as $category)
									<option value="{{ $category->id }}" @if($category->id == $category_id) selected @endif>{{ $category->category_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12 col-md-3">
							<div class="form-group">
								<label for="">
									Sub Category <span class="text-danger">*</span>
								</label>
								<select name="sub_category_id" id="sub_category_id" class="form-control">
									<option value="">Select Sub Category</option>
									@foreach($sub_categories as $sub_category)
									<option value="{{ $sub_category->id }}" @if($sub_category->id == $sub_category_id) selected @endif>{{ $sub_category->sub_category_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12 col-md-3">
							<div class="form-group">
								<label for="">
									Sell By <span class="text-danger">*</span>
								</label>
								<select name="sell_by" id="sell_by" class="form-control selectpicker border bg-light" multiple>
								<option value="piece" @if($sell_by == "piece") selected @endif>Piece</option>
								<option value="unit" @if($sell_by == "unit") selected @endif>Unit</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-12">
							<button id="create-btn" type="button" class="btn btn-primary">
								Show Form
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@if(isset($brand_id))

	<input type="hidden" name="brand_id" value="{{ $brand_id }}">
	<input type="hidden" name="category_id" value="{{ $category_id }}">
	<input type="hidden" name="sub_category_id" value="{{ $sub_category_id }}">
	<input type="hidden" id="sell_by_param" name="sell_by" value="{{ $sell_by }}">
	<div class="row">
		<div id="product-field" class="col-12">
			<div class="row">
				<div class="col-12">
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
	</div>
	@endif

</form>

@endsection

@section('script')

@parent

<script>

	var sell_by_param = "{{ $sell_by }}";
	var units = @json($units);
	var counter = 0;

	$(document).ready(function() {

		$(window).keydown(function(event){
			if(event.keyCode == 13) {
				event.preventDefault();
				return false;
			}
		});

		(function(){

			createFields();

		})();

		$('#upload-photo').change(function() {

			updateImageSrc(document.getElementById('upload-photo'), document.getElementById('preview'));

		});

		$('#create-btn').click(function() {

			var brand_id = $('#brand_id').val();
			var category_id = $('#category_id').val();
			var sub_category_id = $('#sub_category_id').val();
			var sell_by = $('#sell_by').val();

			if ( (brand_id && category_id && sub_category_id && sell_by) != "" ) {

				window.location.href = baseURL + `products/create-bulk?brand_id=${ brand_id }&category_id=${ category_id }&sub_category_id=${ sub_category_id }&sell_by=${ sell_by }`;

			} else {
				alert('Select All Options');
			}
			

		});

		$(document).on('click', '.product-remove', function() {

			var counter = $(this).data('counter');

			$("body").find(`[data-counter='${counter}']`).closest('.card').remove();

			counter--;

		});

		$(document).on('click', '.create-product-fields', function() {

			$('.create-product-fields').removeClass("btn-primary");
			$('.create-product-fields').addClass("btn-danger");
			$('.create-product-fields').addClass("product-remove");
			$('.create-product-fields').html("<i class='fa fa-fw fa-trash-alt'></i>");
			$('.create-product-fields').removeClass("create-product-fields");

			createFields();

		});
		
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

		function createFields() {
			
			$(fields(sell_by_param)).appendTo('#product-field');

		}

		// <div class="input-group-append">
		// 	<span class="input-group-text" id="basic-addon2">&#189;</span>
		// </div>

		function common(fields) {
			
			return `

				<div class="card">
					<div class="card-body pb-0">
						<div class="row">
							<div class="col-md-auto">
								<div class="form-group">
									<button id="create-product-fields" type="button" class="btn btn-primary create-product-fields" data-counter=${counter++}>
										<i class="fa fa-fw fa-plus"></i>
									</button>
								</div>
							</div>
							<div class="col-12 col-md-3">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon2">&#176;</span>
										</div>
										<input type="text" name="name[]" class="form-control name-field" placeholder="Name">

									</div>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<x-forms.input name="product_code[]" class="product-code-field barcode" autofocus placeholder="Barcode"></x-forms.input>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<x-forms.input name="product_stock[]" type="number" class="product-stock-field" placeholder="Stock"></x-forms.input>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<x-forms.input name="product_purchase_price[]" type="number" class="product-purchase-price-field" placeholder="Purchase Price"></x-forms.input>
								</div>
							</div>
							${fields}
						</div>
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<input type="file" name="image[]" class="image-field">
								</div>
							</div>
						</div>	
					</div>
				</div>

			`;

		}

		function fields(type) {

			var unitDropDown = "";

			for(var i in units) {
				unitDropDown += `<option value='${units[i].id}'>${units[i].unit_name}</option>`;
			}

			if (type === 'piece,unit') {

				var fields = `

				<div class="col-12 col-md-4">
					<div class="form-group">
						<x-forms.input name="product_price_piece[]" class="piece-price-field" placeholder="Piece Price"></x-forms.input>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="form-group">
						<x-forms.input name="product_price_piece_wholesale[]" class="piece-wholesale-price-field" placeholder="Piece Wholesale Price"></x-forms.input>
					</div>
				</div>

				<div class="col-12 col-md-4">
					<div class="form-group">
						<select name="unit_id[]" id="unit_id" class='form-control unit-field'>
							<option value="">Select Unit</option>
							${unitDropDown}
						</select>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="form-group">
						<x-forms.input name="product_price_unit[]" class="unit-price-field" placeholder="Unit Price"></x-forms.input>
					</div>
				</div>
				

				`;

				return common(fields);

			}
			
			else if (type === 'piece') {

				var fields = `
					<div class="col-12 col-md-3">
						<div class="form-group">
							<x-forms.input name="product_price_piece[]" class="piece-price-field" placeholder="Price"></x-forms.input>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<x-forms.input name="product_price_piece_wholesale[]" class="piece-wholesale-price-field" placeholder="Wholesale Price"></x-forms.input>
						</div>
					</div>`;

				return common(fields);
			}

			else if (type === 'unit') {

				var fields = `

					<div class="col-12 col-md-2">
						<div class="form-group">
							<select name="unit_id[]" id="unit_id" class='form-control unit-field'>
								<option value="">Select Unit</option>
								${unitDropDown}
							</select>
						</div>
					</div>
					<div class="col-12 col-md-2">
						<div class="form-group">
							<x-forms.input name="product_price_unit[]" class="piece-price-field" placeholder="Price"></x-forms.input>
						</div>
					</div>
					<div class="col-12 col-md-3">
						<div class="form-group">
							<x-forms.input name="product_price_unit_wholesale[]" class="piece-wholesale-price-field" placeholder="Wholesale Price"></x-forms.input>
						</div>
					</div>`;

				return common(fields);

			}

		}

		// $('#_ajaxRequest').submit(function(e) {

		// 	e.preventDefault();

		// 	$('#loading-container').removeClass('d-none');
		// 	$('#toast-header').removeClass('bg-success');
		// 	$('#toast-header').removeClass('bg-danger');

		// 	var names = [];
		// 	var price_piece = [];
		// 	var price_piece_wholesale = [];
		// 	var unit = [];
		// 	var price_unit = [];
		// 	var price_unit_wholesale = [];
		// 	var product_code = [];
		// 	var product_stock = [];
		// 	var product_purchase_price = [];
		// 	var images = [];

		// 	$.each($('.name-field'), function(index, val) {
				
		// 		names.push(val.value);

		// 	});

		// 	$.each($('.piece-price-field'), function(index, val) {
				
		// 		price_piece.push(val.value);

		// 	});

		// 	$.each($('.piece-wholesale-price-field'), function(index, val) {
				
		// 		price_piece_wholesale.push(val.value);

		// 	});

		// 	$.each($('.unit-field'), function(index, val) {
				
		// 		unit.push(val.value);

		// 	});

		// 	$.each($('.unit-price-field'), function(index, val) {
				
		// 		price_unit.push(val.value);

		// 	});

		// 	$.each($('.unit-wholesale-price-field'), function(index, val) {
				
		// 		price_unit_wholesale.push(val.value);

		// 	});

		// 	$.each($('.product-code-field'), function(index, val) {
				
		// 		product_code.push(val.value);

		// 	});

		// 	$.each($('.product-stock-field'), function(index, val) {
				
		// 		product_stock.push(val.value);

		// 	});

		// 	$.each($('.product-purchase-price-field'), function(index, val) {
				
		// 		product_purchase_price.push(val.value);

		// 	});

		// 	var formData = new FormData();

		// 	formData.append('brand_id', $('#brand_id').val());
		// 	formData.append('category_id', $('#category_id').val());
		// 	formData.append('sub_category_id', $('#sub_category_id').val());
		// 	formData.append('sell_by', $('#sell_by_param').val());

		// 	formData.append('name', JSON.stringify(names));
		// 	formData.append('product_price_piece', JSON.stringify(price_piece));
		// 	formData.append('product_price_piece_wholesale', JSON.stringify(price_piece_wholesale));
		// 	formData.append('product_price_unit', JSON.stringify(unit));
		// 	formData.append('product_price_unit_wholesale', JSON.stringify(price_unit));
		// 	formData.append('product_code', JSON.stringify(product_code));
		// 	formData.append('product_stock', JSON.stringify(product_stock));
		// 	formData.append('product_purchase_price', JSON.stringify(product_purchase_price));
		// 	formData.append('unit', JSON.stringify(unit));

		// 	$.each($('.image-field'), function(index, val) {
				
		// 		formData.append('product_image_' + index, $(this)[0].files[0]);

		// 	});

		// 	formData.append('_token', "{{ csrf_token() }}");

		// 	$.ajax({
		// 		url: baseURL + 'products-bulk-ajax',
		// 		type: 'POST',
		// 		data: formData,
		// 		cache: false,
		// 		processData: false,
		// 		contentType: false,
				
		// 	})
		// 	.done(function(res) {

		// 		$('#toast-header').addClass('bg-success');
		// 		$('#toast-title').html(res.statusText);
		// 		$('#toast-body').html(res.message);
		// 		$('.toast').toast('show');
				
		// 	})
		// 	.fail(function(error) {
				
		// 		$('#toast-header').addClass('bg-danger');
		// 		$('#toast-title').html(error.statusText);
		// 		$('#toast-body').html(error.responseJSON.message);
		// 		$('.toast').toast('show');

		// 	})
		// 	.always(function() {

		// 		$('#loading-container').addClass('d-none');
				
		// 	});
			

		// });


   var barcode="";
    $('.barcode').keydown(function(e) 
    {
        $(this).find('[autofocus]').focus();
            barcode=barcode+String.fromCharCode(code);
            $(this).val(barcode)
        
    });

	});

</script>

@endsection