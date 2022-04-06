@extends('panel.master')

@section('content')

<form action="{{ route('suppliers.update', ['id' => $supplier->id]) }}" method="POST">
	@method('PUT')
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
								<x-forms.input name="company_name" value="{{ $supplier->company_name }}"></x-forms.input>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Contact Person Name <span class="text-danger">*</span>
								</label>
								<x-forms.input name="contact_person_name" value="{{ $supplier->contact_person_name }}"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Contact Person Mobile No <span class="text-danger">*</span>
								</label>
								<x-forms.input name="contact_person_phone" value="{{ $supplier->contact_person_phone }}"></x-forms.input>
							</div>
						</div>
					</div>
					<x-btn.update></x-btn.update>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection