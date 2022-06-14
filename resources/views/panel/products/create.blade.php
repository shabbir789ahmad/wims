@extends('panel.master')
@section('content')

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="create_edit">
	@csrf
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Brand <span class="text-danger">*</span>
								</label>
								<select name="brand_id" id="brand_id" class="form-control ">
									<option selected disabled >Select Brand</option>
									@foreach($brands as $brand)
									<option value="{{ $brand->id }}" {{ old('brand_id')== $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
									@endforeach
								</select>
								<span class="text-danger small">@error ('brand_id') <i class="fa fa-times-circle"></i>{{$message}} @enderror</span>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Category <span class="text-danger">*</span>
								</label>
								<select name="category_id" id="category_id" class="form-control">
									<option selected disabled >Select Category</option>
									@foreach($categories as $category)
									<option value="{{ $category->id }}" {{ old('category_id')== $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
									@endforeach
								</select>
								<span class="text-danger small">@error ('category_id') <i class="fa fa-times-circle"></i>{{$message}} @enderror</span>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Sub Category <span class="text-danger">*</span>
								</label>
								<select name="sub_category_id" id="sub_category_id" class="form-control">
									<option selected disabled hidden>Select Sub Category</option>
								</select>
								<span class="text-danger small">@error ('sub_category_id') <i class="fa fa-times-circle"></i>{{$message}} @enderror</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Product Name <span class="text-danger">*</span>
								</label>
								<x-forms.input name="product_name"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">Barcode
									<span class="text-danger">*</span>
									
								</label>
								<x-forms.input name="product_code" id="barcode" tabindex="0" autocomplete="off" autofocus></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Sell By <span class="text-danger">*</span>
								</label>
								<select name="sell_by[]" id="sell_by" class="form-control selectpicker border bg-light" multiple >
									<option value="piece" >Pack</option>
									<option value="unit" >Unit</option>
									<option value="fruit" >Fruit + Veg</option>
								</select>
                            <span class="text-danger small">@error ('sell_by') <i class="fa fa-times-circle"></i>{{$message}} @enderror</span>
							
							</div>
						</div>
						
						
					</div>
					
					<div id="by-fruit" class="row d-none">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Selling Price  <span class="text-danger">*</span>
								</label>
								<x-forms.input name="selling_price" placeholder="Selling Price "></x-forms.input>
							</div>
						</div>
						
					</div>

					<div id="by-piece" class="row d-none">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Price Per Pack <span class="text-danger">*</span>
								</label>
								<x-forms.input name="product_price_piece" placeholder="Product price pack"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Wholesale Price Per Pack <span class="text-danger">*</span>
								</label>
								<x-forms.input name="product_price_piece_wholesale" placeholder="Product price pack wholesale"></x-forms.input>
							</div>
						</div>
					</div>
					<div id="by-unit" class="row d-none">
						<div class="col-12 col-md-3">
							<div class="form-group">
								<label for="">
									Unit <span class="text-danger">*</span>
								</label>
								<select name="unit_id" id="unit_id" class="form-control">
									<option value="">Select Unit</option>
									@foreach($units as $unit)
									<option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12 col-md-2">
							<div class="form-group">
								<label for="">
									Price Per Unit <span class="text-danger">*</span>
								</label>
								<x-forms.input name="product_price_unit"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-2">
							<div class="form-group">
								<label for="">
									WholseSale Price  Unit <span class="text-danger">*</span>
								</label>
								<x-forms.input name="product_price_unit_wholesale"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-2">
							<div class="form-group">
								<label for="">
									Quentity Per Pack 
								</label>
								<x-forms.input name="quentity_per_pack"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-3">
							<div class="form-group">
								<label for="">
									Unit Barcode
								</label>
								<x-forms.input name="unit_barcode" autocomplete="off"></x-forms.input>
							</div>
						</div>
					</div>
					<div class="row">
						
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Stock<span class="text-danger">*</span>
								</label>
								<x-forms.input name="stock"></x-forms.input>
							</div>
						</div>
						
						<div class="col-12 col-md-4">
							<div class="form-group">
								<label for="">
									Purchasing Price
								</label>
								<x-forms.input name="purchasing_price"></x-forms.input>
							</div>
						</div>

						<div class="col-12 col-md-4">
						  <div class="form-group">
							<label for="">VAT% </label>
							<x-forms.input name="vat " placeholder="VAT%" autofocus></x-forms.input>
						 </div>
						</div>
						<!-- <div class="col-12 col-md-3">
							<div class="form-group">
								<label for="">
									Weight
								</label>
								<x-forms.input name="product_weight"></x-forms.input>
							</div>
						</div> -->
					</div>
					<div class="col-12 col-md-2">
							<div class="form-group">
								<label for="">Image</label>
								<input type="file" name="image" id="upload-photo">
								<span class="text-danger small">@error ('image') <i class="fa fa-times-circle"></i>{{$message}} @enderror</span>
							</div>
							<img id="preview" src="{{ asset('assets/defaults/ph.png') }}" class="img-fluid img-thumbnail" alt="">
						</div>
					
					<div class="row">
						<div class="col-12">
							<button type="button" id="create_button_submit" class="btn btn-primary">
								Save
							</button>
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

		$('#upload-photo').change(function() {

			updateImageSrc(document.getElementById('upload-photo'), document.getElementById('preview'));

		});

		$('#sell_by').change(function() {
           
			var selected = $(this).val();

			if (selected.includes("piece") && selected.includes("unit")) {
				$('#by-piece').removeClass('d-none');
				$('#by-unit').removeClass('d-none');
				$('#by-fruit').addClass('d-none');
			}
			else if (selected.includes("piece")) {
				$('#by-piece').removeClass('d-none');
				$('#by-unit').addClass('d-none');
				$('#by-fruit').addClass('d-none');
            }
		    else if (selected.includes("fruit")) {
				$('#by-fruit').removeClass('d-none');
				$('#by-piece').addClass('d-none');
				$('#by-unit').addClass('d-none');		
			} else if (selected.includes("unit")) {
				$('#by-piece').addClass('d-none');
				$('#by-unit').removeClass('d-none');
				$('#by-fruit').addClass('d-none');
			}

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
	});


$('.my-select').selectpicker();

$(document).ready(function() 
{
    var barcode="";
    $('#barcode').keydown(function(e) 
    {
        $(this).find('[autofocus]').focus();
            barcode=barcode+String.fromCharCode(code);
            $(this).val(barcode)
        
    });
});
$('#create_button_submit').click(function(){

	$('#create_edit').submit();
})
</script>

@endsection