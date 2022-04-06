@extends('panel.master')

@section('content')

<form action="{{ route('suppliers.store') }}" method="POST">
	@csrf
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="">
									Company Name <span class="text-danger">*</span>
								</label>
								<x-forms.input name="company_name"></x-forms.input>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Contact Person Name <span class="text-danger">*</span>
								</label>
								<x-forms.input name="contact_person_name"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Contact Person Mobile No <span class="text-danger">*</span>
								</label>
								<x-forms.input name="contact_person_phone"></x-forms.input>
							</div>
						</div>
					</div>
					<x-btn.save></x-btn.save>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection