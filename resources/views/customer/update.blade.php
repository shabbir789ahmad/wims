@extends('panel.master')

@section('content')

<form action="{{ route('customer.update', ['id' => $customer->id]) }}" method="POST" enctype="multipart/form-data">
	@method('PUT')
	@csrf
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card">
				<div class="card-body">
					
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Customer Name
								</label>
								<x-forms.input name="customer_name" value="{{ $customer->customer_name }}"></x-forms.input>
							</div>
						</div>

						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Customer Group
								</label>
								<x-forms.input name="customer_group" value="{{ $customer->customer_group}}"></x-forms.input>
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Customer Email
								</label>
								<x-forms.input name="customer_email" value="{{ $customer->customer_email}}"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Customer Phone
								</label>
								<x-forms.input name="customer_phone" value="{{ $customer->customer_phone }}"></x-forms.input>
							</div>
						</div>
					</div>
					<div class="row">
						
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Customer Address
								</label>
								<x-forms.input name="customer_address" value="{{ $customer->customer_address }}"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Customer City
								</label>
								<x-forms.input name="customer_city" value="{{ $customer->customer_city }}"></x-forms.input>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Customer Company
								</label>
								<x-forms.input name="customer_company" value="{{ $customer->customer_company}}"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Customer Image
								</label>
								<input type="file" class="form-control" name="image" value="{{ $customer->customer_image }}"></input>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<button type="submit" class="btn btn-primary">
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

</script>

@endsection