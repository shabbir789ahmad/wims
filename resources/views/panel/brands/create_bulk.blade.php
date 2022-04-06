@extends('panel.master')

@section('content')

<form id="form" action="{{ route('brands.store') }}" method="POST">
	@csrf
	<div class="form-group">
		<x-btn.save type="submit"></x-btn.save>
	</div>
	<div id="form-fields"></div>
</form>

@endsection

@section('script')
@parent

<script>

	var counter = 0;
	
	$(document).ready(function() {

		(function(){

			createFields();

		})();

		$(document).on('click', '.create-brand-fields', function() {

			$('.create-brand-fields').removeClass("btn-primary");
			$('.create-brand-fields').addClass("btn-danger");
			$('.create-brand-fields').addClass("brand-remove");
			$('.create-brand-fields').html("<i class='fa fa-fw fa-trash-alt'></i>");
			$('.create-brand-fields').removeClass("create-brand-fields");

			createFields();

		});

		$(document).on('click', '.brand-remove', function() {

			var counter = $(this).data('counter');

			$("body").find(`[data-counter='${counter}']`).closest('.card').remove();

			counter--;

		});
		
		function createFields() {
			
			$('#form-fields').append(`

				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-auto">
										<div class="form-group">
											<label htmlFor="">&nbsp;</label>
											<br>
											<button id="create-brand-fields" type="button" class="btn btn-primary create-brand-fields" data-counter=${counter++}>
												<i class="fa fa-fw fa-plus"></i>
											</button>
										</div>
									</div>
									<div class="col-md">
										<div class="form-group">
											<label for="">
												Brand Name <span class="text-danger">*</span>
											</label>
											<x-forms.input name="brand_name[]" class="brand-name-field" placeholder="Brand Name"></x-forms.input>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			`);

		}

		$('#form').submit(function(e) {

			e.preventDefault();

			var formData = new FormData();
			var brands = [];

			$.each($('.brand-name-field'), function(index, val) {
				
				brands.push($(this).val());

			});

			formData.append('brand_name', JSON.stringify(brands));
			formData.append('_token', "{{ csrf_token() }}");

			$.ajax({
				url: baseURL + 'brands-ajax',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
			})
			.done(function(res) {


				$('#toast-header').addClass('bg-success');
				$('#toast-title').html(res.statusText);
				$('#toast-body').html(res.message);
				$('.toast').toast('show');
				
			})
			.fail(function(error) {
				
				$('#toast-header').addClass('bg-danger');
				$('#toast-title').html(error.statusText);
				$('#toast-body').html(error.responseJSON[0]);
				$('.toast').toast('show');

			})
			.always(function() {

				$('#loading-container').addClass('d-none');
				
			});

		});

	});

</script>

@endsection